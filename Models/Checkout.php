<?php
require_once "Models/Database.php";

class Checkout
{
    private $_connection;

    public function __construct()
    {
        $db = new Database();
        $this->_connection = $db->getConnect();
    }

    /**
     * Xử lý thanh toán: kiểm tra balance, trừ tiền, lưu vào transactions
     * Đồng thời enroll user vào courses và chia tiền cho giảng viên + admin
     * @param int $userId - ID người dùng
     * @param float $totalAmount - Tổng tiền cần thanh toán
     * @param array $cartItems - Danh sách khóa học (chứa course_id, price)
     * @return array - Kết quả xử lý ['success' => bool, 'message' => string, 'balance' => float|null]
     */
    public function processCheckout($userId, $totalAmount, $cartItems = [])
    {
        try {
            // 1. Lấy thông tin người dùng (balance hiện tại)
            $stmt = $this->_connection->prepare("SELECT balance FROM users WHERE id = :user_id");
            $stmt->execute(['user_id' => $userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                return [
                    'success' => false,
                    'message' => 'Người dùng không tồn tại',
                    'balance' => null
                ];
            }

            $currentBalance = (float)$user['balance'];

            // 2. Kiểm tra balance có đủ không
            if ($currentBalance < $totalAmount) {
                return [
                    'success' => false,
                    'message' => 'Số dư không đủ. Vui lòng nạp tiền',
                    'balance' => $currentBalance,
                    'needed' => $totalAmount - $currentBalance,
                    'redirect_to_recharge' => true
                ];
            }

            // 3. Bắt đầu transaction DB
            $this->_connection->beginTransaction();

            // 4. Kiểm tra lại balance với SELECT ... FOR UPDATE (khóa dòng)
            $stmt = $this->_connection->prepare("SELECT balance FROM users WHERE id = :user_id FOR UPDATE");
            $stmt->execute(['user_id' => $userId]);
            $userLock = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$userLock) {
                $this->_connection->rollBack();
                return [
                    'success' => false,
                    'message' => 'Lỗi lấy dữ liệu người dùng',
                    'balance' => null
                ];
            }

            $currentBalance = (float)$userLock['balance'];

            // Kiểm tra lại sau khóa
            if ($currentBalance < $totalAmount) {
                $this->_connection->rollBack();
                return [
                    'success' => false,
                    'message' => 'Số dư không đủ. Vui lòng nạp tiền',
                    'balance' => $currentBalance,
                    'needed' => $totalAmount - $currentBalance,
                    'redirect_to_recharge' => true
                ];
            }

            // 5. Tính balance mới
            $newBalance = $currentBalance - $totalAmount;

            // 6. Lưu vào transactions table
            $stmt = $this->_connection->prepare(
                "INSERT INTO transactions (user_id, current_balance, amount, status, type, transaction_code)
                 VALUES (:user_id, :current_balance, :amount, :status, :type, :transaction_code)"
            );

            $transactionCode = 'TXN-' . $userId . '-' . time();
            $stmt->execute([
                'user_id' => $userId,
                'current_balance' => $currentBalance,
                'amount' => $totalAmount,
                'status' => 1, 
                'type' => 2, 
                'transaction_code' => $transactionCode
            ]);

            // 7. Cập nhật balance của user
            $stmt = $this->_connection->prepare("UPDATE users SET balance = :balance WHERE id = :user_id");
            $stmt->execute([
                'balance' => $newBalance,
                'user_id' => $userId
            ]);

            // 8. Enroll user vào các khóa học và chia tiền cho giảng viên + admin
            // Log để debug
            file_put_contents("./Logs/Checkout.log", "CartItems: " . json_encode($cartItems) . "\n", FILE_APPEND);
            
            if (!empty($cartItems)) {
                foreach ($cartItems as $item) {
                    $courseId = (int)($item['course_id'] ?? 0);
                    $coursePrice = (float)($item['price'] ?? 0);

                    // Log từng course
                    file_put_contents("./Logs/Checkout.log", "Processing course_id: $courseId, price: $coursePrice\n", FILE_APPEND);

                    if ($courseId <= 0) {
                        file_put_contents("./Logs/Checkout.log", "Skip course_id <= 0\n", FILE_APPEND);
                        continue;
                    }

                    // 8a. Enroll user vào khóa học
                    $enrollCourseId = null;
                    try {
                        $stmt = $this->_connection->prepare(
                            "INSERT INTO enroll_courses (user_id, course_id, price, created_at)
                             VALUES (:user_id, :course_id, :price, NOW())"
                        );
                        $stmt->execute([
                            'user_id' => $userId,
                            'course_id' => $courseId,
                            'price' => $coursePrice
                        ]);
                        $enrollCourseId = $this->_connection->lastInsertId();
                        file_put_contents("./Logs/Checkout.log", "Enrolled user $userId into course $courseId (enroll_course_id: $enrollCourseId)\n", FILE_APPEND);
                    } catch (PDOException $e) {
                        file_put_contents("./Logs/Checkout.log", "Enroll error: " . $e->getMessage() . "\n", FILE_APPEND);
                        throw $e; // Rollback transaction
                    }

                    // 8a.5. Auto-enroll tất cả lessons của course vào enroll_course_lessons
                    try {
                        // Lấy tất cả lesson_id của course này (từ sections → lessons)
                        $stmt = $this->_connection->prepare(
                            "SELECT l.id FROM lessons l
                             INNER JOIN sections s ON l.section_id = s.id
                             WHERE s.course_id = :course_id"
                        );
                        $stmt->execute(['course_id' => $courseId]);
                        $lessons = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        if (!empty($lessons)) {
                            $insertLessonStmt = $this->_connection->prepare(
                                "INSERT INTO enroll_course_lessons (enroll_course_id, lesson_id)
                                 VALUES (:enroll_course_id, :lesson_id)"
                            );
                            
                            foreach ($lessons as $lesson) {
                                $lessonId = (int)$lesson['id'];
                                $insertLessonStmt->execute([
                                    'enroll_course_id' => $enrollCourseId,
                                    'lesson_id' => $lessonId
                                ]);
                            }
                            file_put_contents("./Logs/Checkout.log", "Enrolled $userId into " . count($lessons) . " lessons of enroll_course_id $enrollCourseId\n", FILE_APPEND);
                        }
                    } catch (PDOException $e) {
                        file_put_contents("./Logs/Checkout.log", "Enroll lessons error: " . $e->getMessage() . "\n", FILE_APPEND);
                        throw $e;
                    }

                    // 8b. Lấy teacher_id của khóa học
                    $stmt = $this->_connection->prepare("SELECT teacher_id FROM courses WHERE id = :course_id");
                    $stmt->execute(['course_id' => $courseId]);
                    $courseData = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($courseData) {
                        $teacherId = (int)$courseData['teacher_id'];
                        file_put_contents("./Logs/Checkout.log", "Teacher ID: $teacherId\n", FILE_APPEND);

                        // Tính tiền: giảng viên nhận 90%, admin nhận 10%
                        $teacherAmount = $coursePrice * 0.9;
                        $adminAmount = $coursePrice * 0.1;
                        $adminId = 89; // Admin ID

                        // 8c. Cộng tiền cho giảng viên
                        if ($teacherId > 0) {
                            $stmt = $this->_connection->prepare(
                                "UPDATE users SET balance = balance + :amount WHERE id = :user_id"
                            );
                            $stmt->execute([
                                'amount' => $teacherAmount,
                                'user_id' => $teacherId
                            ]);
                            file_put_contents("./Logs/Checkout.log", "Added $teacherAmount to teacher $teacherId\n", FILE_APPEND);
                        }

                        // 8d. Cộng tiền cho admin
                        $stmt = $this->_connection->prepare(
                            "UPDATE users SET balance = balance + :amount WHERE id = :user_id"
                        );
                        $stmt->execute([
                            'amount' => $adminAmount,
                            'user_id' => $adminId
                        ]);
                        file_put_contents("./Logs/Checkout.log", "Added $adminAmount to admin $adminId\n", FILE_APPEND);
                    } else {
                        file_put_contents("./Logs/Checkout.log", "Course $courseId not found\n", FILE_APPEND);
                    }
                }
            } else {
                file_put_contents("./Logs/Checkout.log", "CartItems is EMPTY!\n", FILE_APPEND);
            }

            // 9. Xóa chỉ những khóa học đã thanh toán khỏi giỏ hàng
            if (!empty($cartItems)) {
                $courseIds = array_column($cartItems, 'course_id');
                if (!empty($courseIds)) {
                    $placeholders = implode(',', array_fill(0, count($courseIds), '?'));
                    $stmt = $this->_connection->prepare(
                        "DELETE FROM carts WHERE user_id = ? AND course_id IN ($placeholders)"
                    );
                    $params = array_merge([$userId], $courseIds);
                    $stmt->execute($params);
                    file_put_contents("./Logs/Checkout.log", "Deleted courses from cart: " . implode(', ', $courseIds) . "\n", FILE_APPEND);
                }
            }

            // 10. Commit transaction
            $this->_connection->commit();

            return [
                'success' => true,
                'message' => 'Thanh toán thành công',
                'balance' => $newBalance,
                'transaction_code' => $transactionCode
            ];

        } catch (PDOException $e) {
            // Rollback nếu có lỗi
            if ($this->_connection->inTransaction()) {
                $this->_connection->rollBack();
            }

            // Log lỗi
            $errorMessage = "Lỗi lúc " . date("h:i:sa") . ": " . $e->getMessage();
            file_put_contents("./Logs/Checkout.log", $errorMessage . "\n", FILE_APPEND);

            return [
                'success' => false,
                'message' => 'Lỗi xử lý thanh toán',
                'balance' => null
            ];
        }
    }
}
?>