<?php
require_once 'Database.php';
class User
{
    private $_table_users = 'users';
    protected $_connection;

    public function __construct()
    {
        $database = new Database();
        $this->_connection = $database->getConnect();
    }

    // Lấy danh sách người dùng
    public function getAllUsers()
    {
        $stmt = $this->_connection->prepare("SELECT * FROM " . $this->_table_users);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Tạo người dùng mới
    public function createUser($name, $email, $bank_name, $bank_number, $role, $password)
    {
        try {
            $stmt = $this->_connection->prepare("INSERT INTO " . $this->_table_users . " (name, email, bank_name, bank_number, role, password) VALUES (:name, :email, :bank_name, :bank_number, :role, :password)");
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $data = [
                ':name' => $name,
                ':email' => $email,
                ':bank_name' => $bank_name,
                ':bank_number' => $bank_number,
                ':role' => $role,
                ':password' => $passwordHash
            ];
            $user = $stmt->execute($data);
            if ($user) {
                return $this->_connection->lastInsertId();
            }
        } catch (PDOException $e) {
            file_put_contents(
                __DIR__ . './Logs/User.log',
                date('Y-m-d H:i:s') . "Lỗi khi thêm user" . " - " . $e->getMessage() . PHP_EOL,
                FILE_APPEND
            );
            return false;
        }
    }
    // Lấy người dùng theo email
    public function getByEmail($email)
    {
        $stmt = $this->_connection->prepare("SELECT * FROM " . $this->_table_users . " WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            return $user;
        }
        return null;
    }

    public function getById($id)
    {
        $stmt = $this->_connection->prepare("SELECT * FROM " . $this->_table_users . " WHERE id = :id LIMIT 1");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            return $user;
        }
        return null;
    }

    public function updateUser($id, $data)
    {
        try {
        $sql = "UPDATE " . $this->_table_users . " 
            SET status = :status, lock_reason = :lock_reason
            WHERE id = :id";

        $stmt = $this->_connection->prepare($sql);
        return $stmt->execute([
            ':status' => $data['status'],
            ':lock_reason' => $data['lock_reason'],
            ':id' => $id
        ]);
        } catch (PDOException $e) {
            file_put_contents(
                __DIR__ . '/Logs/User.log',
                date('Y-m-d H:i:s') . "Lỗi khi cập nhật user" . " - " . $e->getMessage() . PHP_EOL,
                FILE_APPEND
            );
            return false;
        }
    }
}
