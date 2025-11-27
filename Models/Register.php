<?php
require_once 'Models/Database.php';

class Register
{
    private $_connection;
    private $_lastError = null;

    public function __construct()
    {
        $db = new Database();
        $this->_connection = $db->getConnect();
    }

    public function createUser($name, $email, $password)
    {
        try {
            $stmt = $this->_connection->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $hashedPassword
            ]);
            return $stmt;
        } catch (PDOException $e) {
            error_log("Error in createTeacher: " . $e->getMessage());
            return false;
        }

    }


    public function isEmailExists($email)
    {
        $stmt = $this->_connection->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->rowCount() > 0;
    }
}
?>