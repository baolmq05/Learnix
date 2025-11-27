<?php
require_once 'Models/Login.php';
class LoginController
{
    public function viewLoginAdmin()
    {
        include 'Views/Admin/Pages/Login/index.php';
    }

    public function handleLoginAdmin()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $error = [];

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'Email không hợp lệ!';
        }
        if (empty($password)) {
            $error['password'] = 'Mật khẩu không được để trống!';
        }

        $loginModel = new Login();
        $admin = $loginModel->checkLoginAdmin($email, $password);
        if ($admin === 'locked') {
            $error['message'] = 'Tài khoản đã bị khóa!';
        } elseif ($admin === false) {
            $error['message'] = 'Email hoặc mật khẩu không đúng!';
        } else {
            $_SESSION['admin'] = $admin;
        }

        if (!empty($error)) {
            $_SESSION['error'] = $error;
            $_SESSION['old'] = $_POST;
            header('Location: admin.php?page=login');
            exit;
        }
        header('Location: admin.php');
        exit;
    }
}
?>