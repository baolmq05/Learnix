<?php
require_once 'Models/Auth.php';

class AuthController
{
    private $_AuthModel;

    public function __construct()
    {
        $this->_AuthModel = new Auth();
    }

    // HIỂN THỊ FORM QUÊN MẬT KHẨU
    public function forgotPassword()
    {
        include 'Views/Client/Pages/forgotPassword.php';
    }

    // XỬ LÝ QUÊN MẬT KHẨU
    public function handleForgotPassword()
    {
        if (!isset($_POST['forgot_password'])) {
            header('location: ?page=forgot_password&&action=index');
            exit;
        }

        $email = trim($_POST['email'] ?? '');
        $errors = [];

        // Validate email
        if ($email === '') {
            $errors['email'] = 'Email không được để trống';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email không đúng định dạng';
        }

        // Kiểm tra email tồn tại
        if (empty($errors)) {
            $user = $this->_AuthModel->getInfoByEmail($email);

            if (!$user) {
                $errors['email'] = 'Email không tồn tại trong hệ thống.';
            }
        }

        // Nếu có lỗi → quay lại
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_data'] = $_POST;
            header('location: ?page=forgot_password&&action=index');
            exit;
        }

        // Gửi reset token
        $result = $this->_AuthModel->resetToken($email);

        if ($result) {
            $_SESSION['success'] = 'Mã xác nhận đã được gửi đến email của bạn.';
            $_SESSION['email_reset'] = $email;      // Lưu email để bước nhập token

            header('location: ?page=change_password');
            exit;
        }
        header('location: ?page=forgot_password&&action=index');
        exit;
    }

    // XỬ LÝ KIỂM TRA TOKEN
    public function handleInputToken()
    {
        if (!isset($_POST['verify-token'])) {
            header('location: ?page=forgot_password&&action=index');
            exit;
        }

        $email = $_SESSION['email_reset'] ?? '';
        $token = trim($_POST['token'] ?? '');
        $errors = [];

        if ($token === '') {
            $errors['token'] = 'Mã xác nhận không được để trống.';
        }

        if (empty($errors)) {
            $tokenInfo = $this->_AuthModel->getTokenInfo($email, $token);

            if (!$tokenInfo) {
                $errors['token'] = 'Mã xác nhận không chính xác.';
            } else {
                // Kiểm tra thời gian hết hạn
                if (strtotime($tokenInfo['reset_token_expiry']) < time()) {
                    $errors['token'] = 'Mã xác nhận đã hết hạn.';
                }
            }
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('location: ?page=forgot_password&&action=index');
            exit;
        }
        header('location: ?page=change_password');
        exit;
    }

    // HIỂN THỊ FORM ĐỔI MẬT KHẨU
    public function changePassword()
    {
        include 'Views/Client/Pages/changePassword.php';
    }

    // XỬ LÝ ĐỔI MẬT KHẨU
    public function handleChangePassword()
    {
        if (!isset($_POST['change_password'])) {
            header('location: ?page=change_password');
            exit;
        }
        $token = trim($_POST['reset_token'] ?? '');
        $email = $_SESSION['email_reset'] ?? '';
        $password = trim($_POST['password'] ?? '');
        $confirm = trim($_POST['confirm'] ?? '');
        $errors = [];

        if ($password === '') {
            $errors['password'] = "Mật khẩu không được để trống";
        }else if (strlen($password) < 6) {
            $errors['password'] = "Mật khẩu phải có ít nhất 6 ký tự";
        }

        if ($token === '') {
            $errors['token'] = "Mã xác thực không được để trống";
        } else {
            // Kiểm tra token
            $tokenInfo = $this->_AuthModel->getTokenInfo($email, $token);

            if (!$tokenInfo) {
                $errors['token'] = 'Mã xác thực không chính xác';
            } else {
                // Kiểm tra thời gian hết hạn
                if (strtotime($tokenInfo['reset_token_expiry']) < time()) {
                    $errors['token'] = 'Mã xác thực đã hết hạn';
                }
            }
        }

        if ($confirm === '' || $confirm !== $password) {
            $errors['confirm'] = "Xác nhận mật khẩu không đúng.";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_data'] = [
                'reset_token' => $token,
            ];

            header('location: ?page=change_password');
            exit;
        }


        // Reset mật khẩu
        $this->_AuthModel->resetPassword($email, $password);

        // Xóa các session liên quan
        unset($_SESSION['email_reset'], $_SESSION['show_token']);

        $_SESSION['register_success'] = 'Đổi thành công';
        header('location: ?page=login');
        exit;
    }
}

