<?php
require_once "./Models/Database.php";
class Lesson {
    private $_connect;

    public function __construct()
    {
        $db = new Database();
        $this->_connect = $db->getConnect();
    }

    public function getAll() {
        try {
            $sql = "SELECT * FROM lessons";
            $stmt = $this->_connect->prepare($sql);
            
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e) {
            $errorMessage = "Lỗi lúc: " . date("H:i:s") . ". Lỗi là: " . $e->getMessage();
            file_put_contents("./Logs/Lesson.log", $errorMessage, FILE_APPEND);
        }
    }

    public function getAllBySectionId($sectionId) {
        try {
            $sql = "SELECT * FROM lessons WHERE section_id = :section_id";
            $stmt = $this->_connect->prepare($sql);
            
            $stmt->bindParam(":section_id", $sectionId);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e) {
            $errorMessage = "Lỗi lúc: " . date("H:i:s") . ". Lỗi là: " . $e->getMessage();
            file_put_contents("./Logs/Lesson.log", $errorMessage, FILE_APPEND);
        }
    }

    public function insert() {

    }

    public function update() {
        
    }

    public function delete() {

    }
}