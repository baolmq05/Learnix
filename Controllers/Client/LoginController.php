<?php
require_once 'Models/Login.php';
class LoginController
{
    public function viewLogin()
    {
        include './Views/Client/Pages/login.php';
    }

    public function handleLogin()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $error = [];

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'Vui lòng nhập email hợp lệ!';
        }
        if (empty($password)) {
            $error['password'] = 'Vui lòng nhập mật khẩu!';
        }

        if (!empty($error)) {
            $_SESSION['error'] = $error;
            header('Location: ?page=login');
            exit;
        }

        $userModel = new Login();
        $user = $userModel->checkLogin($email, $password);

        if ($user === 'locked') {
            $_SESSION['loginError'] = 'Tài khoản đã bị khóa!';
            header('Location: ?page=login');
            exit;
        } elseif ($user === false) {
            $_SESSION['error']['loginError'] = 'Đăng nhập thất bại!';
            $_SESSION['error']['message'] = 'Email hoặc mật khẩu không đúng!';
            header('Location: ?page=login');
            exit;
        } else {
            $_SESSION['client'] = $user;
            if (isset($user['role']) && $user['role'] === 2) {
                if (!isset($_SESSION['client']['information']) || !isset($_SESSION['client']['bank_name']) || !isset($_SESSION['client']['bank_number'])) {
                    $_SESSION['login_success'] ='Đăng nhập thành công' ;
                    header('Location: index.php?page=teacher&action=editProfile');
                    exit;
                }
                $_SESSION['login_success'] ='Đăng nhập thành công' ;
                header('Location: index.php?page=teacher&action=index');
            } else {
                $_SESSION['login_success'] ='Đăng nhập thành công' ;
                header('Location: index.php?login=success');
            }
            exit;
        }

    }
}