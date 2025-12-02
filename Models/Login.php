<?php
require_once 'Models/Database.php';
class Login
{

    private $_connection;

    public function __construct()
    {
        $db = new Database();
        $this->_connection = $db->getConnect();
    }
    public function checkLogin($email, $password)
    {
        $stmt = $this->_connection->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            if ($user['status'] === 1) {
                return $user; // tài khoản hợp lệ và đang hoạt động
            }
            return 'locked'; // tài khoản bị khóa
        }

        return false; // sai tài khoản hoặc mật khẩu
    }

    public function checkLoginAdmin($email, $password)
    {
        $stmt = $this->_connection->prepare("SELECT * FROM users WHERE email = :email AND role = 0");
        $stmt->execute([':email' => $email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($password, $admin['password'])) {
            if ($admin['status'] !== 1) {
                return 'locked'; // tài khoản bị khóa
            }
            return $admin; // tài khoản quản trị viên hợp lệ
        }

        return false; // sai tài khoản hoặc mật khẩu
    }
}
