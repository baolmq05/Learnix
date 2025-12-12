<?php
require_once "Models/Checkout.php";
require_once "Models/Cart.php";
require_once "Models/Course.php";

class CheckoutController
{
    private $checkoutModel;
    private $cartModel;
    private $courseModel;
    
    public function __construct()
    {
        $this->checkoutModel = new Checkout();
        $this->cartModel = new Cart();
        $this->courseModel = new Course();
    }

    // Thêm các phương thức liên quan đến quá trình thanh toán ở đây

    public function viewCheckout()
    {
        $user_id = $_SESSION['client']['id'] ?? null;
        if(!$user_id){
                $error['loginError'] = 'Vui lòng đăng nhập!';
                $_SESSION['error'] = $error;
                header('Location: index.php?page=login');
                exit();
            }
        $cartItems = [];
        $subTotal = 0;
        $shipping = 0;
        $grandTotal = 0;

        // Trường hợp 1: Thanh toán toàn bộ giỏ hàng (POST['cart'])
        if (isset($_POST['cart']) && $user_id) {
            
            $cartData = $this->cartModel->getAllCart($user_id);
            
            foreach ($cartData as $course) {
                $price = isset($course['sale_price']) && $course['sale_price'] > 0 
                    ? (float)$course['sale_price'] 
                    : (float)$course['regular_price'];
                
                $cartItems[] = [
                    'name' => $course['course_name'] ?? 'Khóa học',
                    'price' => $price,
                    'quantity' => 1,
                    'image' => $course['image'],
                    'course_id' => $course['id'] ?? null,
                    'instructor' => $course['instructor'] ?? '',
                    'rating' => $course['rating'] ?? 0,
                    'total_lesson' => $course['total_lesson'] ?? 0,
                ];
                
                $subTotal += $price;
            }
        }
        // Trường hợp 2: Mua ngay 1 khóa học (POST['course_id'])
        elseif (isset($_POST['course_id'])) {
            $courseId = (int)$_POST['course_id'];
            $course = $this->courseModel->getCourseById($courseId);
            
            if ($course) {
                $price = isset($course['sale_price']) && $course['sale_price'] > 0 
                    ? (float)$course['sale_price'] 
                    : (float)$course['regular_price'];
                
                $cartItems[] = [
                    'name' => $course['course_name'] ?? 'Khóa học',
                    'price' => $price,
                    'quantity' => 1,
                    'image' => $course['image'],
                    'course_id' => $course['id'] ?? null,
                    'instructor' => '', // getCourseById không trả instructor, có thể join thêm nếu cần
                    'rating' => 0,
                    'total_lesson' => 0,
                ];
                
                $subTotal += $price;
            }
        }
        
        $grandTotal = $subTotal;
        
        // Helper function cho view
        if (!function_exists('formatCurrency')) {
            function formatCurrency($amount) {
                return number_format($amount, 0, ',', '.') . ' ₫';
            }
        }
        
        require_once 'Views/Client/Pages/checkout.php';
    }

    public function checkoutReturn()
    {
        // Hiển thị trang thành công
        require_once 'Views/Client/Pages/checkoutReturn.php';
    }

    public function handleCheckout()
    {
        $user_id = $_SESSION['client']['id'] ?? null;
        
        if (!$user_id) {
            header('Location: index.php?page=login');
            exit();
        }

        // Lấy total amount từ POST
        $totalAmount = isset($_POST['total_amount']) ? (float)$_POST['total_amount'] : 0;

        if ($totalAmount <= 0) {
            header('Location: index.php?page=checkout');
            exit();
        }

        // Lấy cartItems: ưu tiên từ POST (mua ngay), fallback sang cart DB
        $cartItems = [];
        
        // Trường hợp 1: Mua ngay (có course_id trong POST)
        if (isset($_POST['course_id'])) {
            $courseId = (int)$_POST['course_id'];
            file_put_contents("./Logs/Checkout.log", "Buy Now - Course ID: $courseId\n", FILE_APPEND);
            
            if ($courseId > 0) {
                $course = $this->courseModel->getCourseById($courseId);
                if ($course) {
                    $price = isset($course['sale_price']) && $course['sale_price'] > 0 
                        ? (float)$course['sale_price'] 
                        : (float)$course['regular_price'];
                    
                    $cartItems[] = [
                        'course_id' => $course['id'] ?? null,
                        'price' => $price,
                    ];
                }
            }
        }
        // Trường hợp 2: Thanh toán từ giỏ hàng
        else {
            $cartData = $this->cartModel->getAllCart($user_id);
            file_put_contents("./Logs/Checkout.log", "Cart Checkout - User ID: $user_id, Cart count: " . count($cartData) . "\n", FILE_APPEND);
            
            foreach ($cartData as $course) {
                $price = isset($course['sale_price']) && $course['sale_price'] > 0 
                    ? (float)$course['sale_price'] 
                    : (float)$course['regular_price'];
                
                $cartItems[] = [
                    'course_id' => $course['id'] ?? null,
                    'price' => $price,
                ];
            }
        }
        
        file_put_contents("./Logs/Checkout.log", "Final cartItems: " . json_encode($cartItems) . "\n", FILE_APPEND);
        
        // Nếu giỏ hàng trống, báo lỗi
        if (empty($cartItems)) {
            $_SESSION['checkout_error'] = 'Không có khóa học để thanh toán.';
            header('Location: index.php?page=cart');
            exit();
        }

        // Gọi model xử lý thanh toán (truyền $cartItems để enroll + chia tiền)
        $result = $this->checkoutModel->processCheckout($user_id, $totalAmount, $cartItems);

        if ($result['success']) {
            // Thanh toán thành công
            $_SESSION['client']['balance'] = $result['balance'];
            
            // Chuyển hướng đến trang thành công
            header('Location: index.php?page=checkout&action=checkoutReturn&txn=' . $result['transaction_code']);
            exit();
        } else {
            // Thanh toán thất bại
            if (!empty($result['redirect_to_recharge'])) {
                // Balance không đủ, chuyển sang trang nạp tiền
                $_SESSION['checkout_error'] = $result['message'];
                $_SESSION['needed_amount'] = $result['needed'] ?? 0;
                header('Location: index.php?page=recharge');
                exit();
            } else {
                // Lỗi khác
                $_SESSION['checkout_error'] = $result['message'];
                header('Location: index.php?page=checkout');
                exit();
            }
        }
    }


}



?>