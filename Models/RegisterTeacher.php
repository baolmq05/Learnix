<?php
require_once 'Models/Database.php';

class RegisterTeacher
{
    private $_connection;

    public function __construct()
    {
        $db = new Database();
        $this->_connection = $db->getConnect();
        $this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function createTeacher($userId)
    {
        try {
            $stmt = $this->_connection->prepare("UPDATE users SET role = 2 WHERE id = :userId");
            $stmt->execute([':userId' => $userId]);
            return $stmt;
        } catch (PDOException $e) {
            error_log("Error in createTeacher: " . $e->getMessage());
            return false;
        }
    }
    
}
?>