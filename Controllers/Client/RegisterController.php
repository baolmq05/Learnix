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
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $error = [];

        if (empty($name)) {
            $error['name'] = 'Tên không được để trống!';
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'Email không hợp lệ!';
        }
        if (empty($password)) {
            $error['password'] = 'Mật khẩu không được để trống!';
        }

        $registerModel = new Register();
        if ($registerModel->isEmailExists($email)) {
            $error['email'] = 'Email đã tồn tại!';
        }
        if (strlen($password) < 6) {
            $error['password'] = 'Mật khẩu phải có ít nhất 6 ký tự!';
        }


        if (!empty($error)) {
            $_SESSION['error'] = $error;
            $_SESSION['old'] = $_POST;
            header('Location: ?page=register');
            exit;
        }
        $userId = $registerModel->createUser($name, $email, $password);
        if ($userId) {
            header('Location: ?page=login&register=success');
            exit;
        } else {
            $_SESSION['error']['general'] = 'Đăng ký thất bại, vui lòng thử lại!';
            header('Location: ?page=register');
            exit;
        }
       
    }

}