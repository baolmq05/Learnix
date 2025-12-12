<?php
require_once 'Models/Register.php';

class RegisterController
{
    public function viewRegister()
    {
        include './Views/Client/Pages/register.php';
    }

    public function handleRegister()
    {
        $registerModel = new Register();

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        $error = [];


        if (empty($name)) {
            $error['name'] = 'Tên không được để trống!';
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'Email không hợp lệ!';
        } elseif ($registerModel->isEmailExists($email)) {
            $error['email'] = 'Email đã tồn tại!';
        }
        if (empty($password)) {
            $error['password'] = 'Mật khẩu không được để trống!';
        } elseif (strlen($password) < 6) {
            $error['password'] = 'Mật khẩu phải có ít nhất 6 ký tự!';
        }
        if (empty($confirm_password)) {
            $error['confirm_password'] = 'Vui lòng xác nhận mật khẩu!';
        } elseif (!empty($password) && !empty($confirm_password) && $password !== $confirm_password) {
            $error['confirm_password'] = 'Mật khẩu xác nhận không khớp!';
        }
        if (!empty($error)) {
            $_SESSION['error'] = $error;
            $_SESSION['old'] = $_POST;
            header('Location: ?page=register');
            exit;
        }
        $userId = $registerModel->createUser($name, $email, $password);
        if ($userId) {
            $_SESSION['register_success'] = 'Đăng ký thành công!';
            header('Location: ?page=login');
            exit;
        } else {
            $_SESSION['error']['general'] = 'Đăng ký thất bại!';
            header('Location: ?page=register');
            exit;
        }
    }
}
