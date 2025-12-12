<?php
require_once 'Models/Teacher.php';
require_once 'Models/Profile.php';
require_once 'Models/WithDraw.php';
require_once 'Models/Dashboard.php';
require_once "./Models/Course.php";
class TeacherController
{
    private $teacherModel;
    private $profileModel;
    private $withDrawModel;
    private $dashboardModel;
    private $_courseModel;

    public function __construct()
    {
        $this->teacherModel = new Teacher();
        $this->profileModel = new Profile();
        $this->withDrawModel = new WithDraw();
        $this->dashboardModel = new Dashboard();
        $this->_courseModel = new Course();
    }

    public function index()
    {
        $userId = isset($_SESSION["client"]["id"]) ? $_SESSION["client"]["id"] : "";

        if (!empty($userId)) {
            $courseApproved = $this->_courseModel->getTeacherCourses($userId, 1);
            $courseEditing = $this->_courseModel->getTeacherCourses($userId, 2);
            $coursePending = $this->_courseModel->getTeacherCourses($userId, 0);
            $courseDisabled = $this->_courseModel->getTeacherCourses($userId, 3);
            $courseReject = $this->_courseModel->getTeacherCourses($userId, 4);

            $countCourseObj = $this->_courseModel->countTeacherCourseByStatus($userId);

            include 'Views/Client/Pages/Teacher/teacher.php';
        } else {
            header("location: index.php");
            exit;
        }
    }

    public function viewDetail()
    {
        include 'Views/Client/Pages/Teacher/courseDetail.php';
    }

    public function statistic()
    {
        $userId = $_SESSION['client']['id'] ?? null;
        $totalCourses = $this->dashboardModel->getTotalCoursesByTeacher(1, $userId);
        $totalStudents = $this->dashboardModel->getTotalStudentByTeacher($userId);
        $newCourses30Day = $this->dashboardModel->getTotalNewCoursesIn30Days($userId, 1);
        $newStudents30Day = $this->dashboardModel->getTotalNewStudentIn30Days($userId);
        $totalRevenue = $this->dashboardModel->getTotalRevenueByTeacher($userId);
        $totalRevenueIn30Days = $this->dashboardModel->getTotalRevenueByTeacherIn30Days($userId);

        // chart data
        $revenueStats = $this->dashboardModel->getRevenueInYear($userId, null);

        $labels = array_column($revenueStats, 'month');
        $data = array_column($revenueStats, 'Total_revenue');

        $months = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
        $finalData = [];
        foreach ($months as $m) {
            $index = array_search($m, $labels);
            $finalData[] = $index !== false ? $data[$index] : 0;
        }

        include 'Views/Client/Pages/Teacher/statistic.php';
    }

    public function profile()
    {
        $userId = $_SESSION['client']['id'] ?? null;
        $teacher = null;
        if ($userId) {
            $teacher = $this->teacherModel->getById($userId);
            $teacher['courses'] = $this->teacherModel->countCoursesByTeacher($userId);
            $teacher['students'] = $this->teacherModel->countStudentsByTeacher($userId);
            $teacher['rating'] = $this->teacherModel->calRatingByCourse($userId);
        }
        include 'Views/Client/Pages/Teacher/profile.php';
    }
    public function editProfile()
    {
        $userId = $_SESSION['client']['id'] ?? null;
        $teacher = null;
        if ($userId) {
            $teacher = $this->teacherModel->getById($userId);
        }

        // Provide any validation errors and old input to the view (set by updateProfile)
        $errors = [];
        if (isset($_SESSION['error']) && is_array($_SESSION['error'])) {
            $errors = $_SESSION['error'];
            unset($_SESSION['error']);
        }

        $old = [];
        if (isset($_SESSION['old']) && is_array($_SESSION['old'])) {
            $old = $_SESSION['old'];
            unset($_SESSION['old']);
        }

        include 'Views/Client/Pages/Teacher/editProfile.php';
    }

    public function updateProfile()
    {
        $userId = $_SESSION['client']['id'];
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $information = $_POST['information'] ?? '';
        $bankName = $_POST['bank_name'] ?? '';
        $bankNumber = $_POST['bank_number'] ?? '';
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        $error = [];
        if (empty($name)) {
            $error['name'] = 'Tên không được để trống!';
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'Email không hợp lệ!';
        }
        if ($this->profileModel->isEmailExistsForOtherUser($email, $userId)) {
            $error['email'] = 'Email đã tồn tại!';
        }
        $avatarName = null;
        $oldAvatar = null;
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
            $avatar = $_FILES['avatar'];

            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!in_array($avatar['type'], $allowedTypes)) {
                $error['avatar'] = 'Chỉ chấp nhận file JPG, PNG, GIF!';
            }

            if ($avatar['size'] > 2 * 1024 * 1024) {
                $error['avatar'] = 'File ảnh quá lớn! Tối đa 2MB.';
            }

            if (empty($error)) {
                $uploadDir = 'Uploads/Avatar/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $extension = pathinfo($avatar['name'], PATHINFO_EXTENSION);
                $avatarName = 'avatar_' . $userId . '_' . time() . '.' . $extension;
                $uploadPath = $uploadDir . $avatarName;

                // Move uploaded file
                if (!move_uploaded_file($avatar['tmp_name'], $uploadPath)) {
                    $error['avatar'] = 'Lỗi khi upload ảnh!';
                }
            }
        }
        // If user requested a password change (filled new password), validate it now
        $wantChangePassword = strlen(trim($newPassword)) > 0;
        if ($wantChangePassword) {
            if (empty($currentPassword)) {
                $error['current_password'] = 'Vui lòng nhập mật khẩu hiện tại để thay đổi mật khẩu.';
            }
            if (strlen($newPassword) < 6) {
                $error['new_password'] = 'Mật khẩu mới phải có ít nhất 6 ký tự.';
            }
            if ($newPassword !== $confirmPassword) {
                $error['confirm_password'] = 'Mật khẩu xác nhận không khớp.';
            }

            // Verify current password matches stored hash
            if (empty($error)) {
                $existingUser = $this->profileModel->getUserById($userId);
                $storedHash = $existingUser['password'] ?? null;
                if (!$storedHash || !password_verify($currentPassword, $storedHash)) {
                    $error['current_password'] = 'Mật khẩu hiện tại không đúng.';
                }
            }
        }

        if (!empty($error)) {
            $_SESSION['error'] = $error;
            // preserve old input so the form can be re-populated if needed
            $_SESSION['old'] = $_POST;
            header('Location: ?page=teacher&action=editProfile');
            exit;
        }

        // if a new avatar was uploaded, fetch the existing avatar name so we can delete it after success
        if ($avatarName) {
            $existing = $this->teacherModel->getById($userId);
            $oldAvatar = $existing['avatar'] ?? null;
        }

        $isUpdated = $this->teacherModel->updateTeacherProfile($userId, $name, $email, $information, $avatarName, $bankName, $bankNumber);
        if ($isUpdated) {
            $_SESSION['client']['name'] = $name;
            $_SESSION['client']['email'] = $email;
            $_SESSION['client']['information'] = $information;
            $_SESSION['client']['bank_name'] = $bankName;
            $_SESSION['client']['bank_number'] = $bankNumber;
            if ($avatarName) {
                // update session avatar
                $_SESSION['client']['avatar'] = $avatarName;
                // delete old avatar file if exists and is different
                if (!empty($oldAvatar) && $oldAvatar !== $avatarName) {
                    $oldPath = 'Uploads/Avatar/' . $oldAvatar;
                    if (is_file($oldPath)) {
                        @unlink($oldPath);
                    }
                }
            }
            // If user requested password change, attempt to update it now
            if (!empty($newPassword)) {
                $hashed = password_hash($newPassword, PASSWORD_BCRYPT);
                $pwdUpdated = $this->profileModel->updateUserPassword($userId, $hashed);
                if (!$pwdUpdated) {
                    // rollback new avatar file if it was uploaded
                    if ($avatarName) {
                        $newPath = 'Uploads/Avatar/' . $avatarName;
                        if (is_file($newPath)) {
                            @unlink($newPath);
                        }
                        // restore session avatar to old value if existed
                        if (!empty($oldAvatar)) {
                            $_SESSION['client']['avatar'] = $oldAvatar;
                        } else {
                            unset($_SESSION['client']['avatar']);
                        }
                    }
                    $_SESSION['error']['general'] = 'Cập nhật mật khẩu thất bại, vui lòng thử lại!';
                    header('Location: ?page=teacher&action=editProfile');
                    exit;
                }
            }
            $_SESSION['update_success'] = 'Cập nhật thông tin thành công!';
            header('Location: ?page=teacher&action=profile');
            exit;
        } else {
            // cleanup uploaded file if update failed
            if ($avatarName) {
                $newPath = 'Uploads/Avatar/' . $avatarName;
                if (is_file($newPath)) {
                    @unlink($newPath);
                }
            }
            $_SESSION['error']['general'] = 'Cập nhật thông tin thất bại, vui lòng thử lại!';
            header('Location: ?page=teacher&action=editProfile');
            exit;
        }
    }
    public function viewStudents()
    {
        include 'Views/Client/Pages/Teacher/students.php';
    }
    ///////// Bắc WithDraw ////////////////////////////////////////////////////////////////////
    // lấy thông tin rút tiền của user để dô client
    public function getUserWithdraw()
    {
        $userId = $_SESSION['client']['id'] ?? null;
        $userIdRoll = $_SESSION['client']['role'] ?? null;
        if ($userIdRoll != 2) {
            header("location: index.php");
            exit();
        }
        $withDraw = $this->withDrawModel->getUserWithdraw($userId);
        include 'Views/Client/Pages/Teacher/withDraw.php';
    }
    // tạo yêu cầu rút tiền và bắt lỗi
    public function withDrawRequest()
    {
        $userId = $_SESSION['client']['id'] ?? null;
        $userIdRoll = $_SESSION['client']['role'] ?? null;
        if ($userIdRoll != 2) {
            header("location: index.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("location: index.php?page=teacher&action=withdraw");
            exit();
        }
        $amount = $_POST['amount'] ?? '';
        $error = false;
        $_SESSION['error'] = [];

        // kieem tra số dư hiện tại
        $withDraw = $this->withDrawModel->getUserWithdraw($userId);
        $currentBalance = $withDraw['balance'] ?? 0;

        if (empty($withDraw['bank_name']) || empty($withDraw['bank_number']) || empty($withDraw['account_name'])) {
            $_SESSION['updateUser_error'] = 'Vui lòng cập nhật thông tin ngân hàng trên trang cá nhân trước khi rút tiền';
            header("location: index.php?page=teacher&action=profile");
            exit();
        }

        // kiểm tra giảng viên đã có khóa học được duyệt chưa
        $approvedCoursesCount = $this->withDrawModel->countApprovedCourses( $userId);
        if($approvedCoursesCount == 0) {
            $_SESSION['withdraw_error'] = 'Cần ít nhất 1 khóa học được duyệt';
            header("location: index.php?page=teacher&action=withdraw");
            exit();
        }
        // Kiểm tra đã có yêu cầu đang chờ duyệt chưa
        if (method_exists($this->withDrawModel, 'hasPendingRequest')) {
            $hasPending = $this->withDrawModel->hasPendingRequest($userId);
            if ($hasPending) {
                $_SESSION['withdraw_error'] = 'Bạn đã có yêu cầu rút tiền đang chờ duyệt. Vui lòng chờ duyệt trước khi gửi yêu cầu mới.';
                header("location: index.php?page=teacher&action=withdraw");
                exit();
            }
        }

        if ($amount == '') {
            $_SESSION['error']['amount'] = 'Vui lòng nhập số tiền muốn rút';
            $error = true;
        } else if (!is_numeric($amount) || $amount < 10000) {
            $_SESSION['error']['amount'] = 'Số tiền không hợp lệ và không nhỏ hơn 10.000 VNĐ';
            $error = true;
        } else {

            if ($amount > $currentBalance) {
                $_SESSION['error']['amount'] = 'Số dư không đủ để rút';
                $error = true;
            }
        }

        if ($error) {
            header("location: index.php?page=teacher&action=withdraw");
            exit();
        }
        $data = [
            'user_id' => $userId,
            'current_balance' => $currentBalance,
            'amount' => $amount,
        ];
        $result = $this->withDrawModel->createWithdrawRequest($data);
        if ($result) {
            $_SESSION['withdraw_success'] = 'Yêu cầu rút tiền đã được gửi thành công';
        } else {
            $_SESSION['withdraw_error'] = 'Tạo yêu cầu rút tiền thất bại, vui lòng thử lại!';
        }
        header("location: index.php?page=teacher&action=withdraw");
        exit();
    }
}