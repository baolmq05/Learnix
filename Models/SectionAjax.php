<?php
require_once "../../../Models/Database.php";
class SectionAjax
{
    private $_connect;

    public function __construct()
    {
        $db = new Database();
        $this->_connect = $db->getConnect();
    }

    public function getByCourseId($courseId)
    {
        try {
            $sql = "SELECT * FROM sections WHERE course_id = :course_id";
            $stmt = $this->_connect->prepare($sql);

            $stmt->bindParam(":course_id", $courseId);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi khi " . date("H:i:s") . ". Lỗi là: " . $e->getMessage();
            file_put_contents("../Logs/Section.log", $errorMessage, FILE_APPEND);
        }
    }

    public function getAll() {}

    public function getById($section_id)
    {
        try {
            $sql = "SELECT * FROM sections WHERE id = :id";
            $stmt = $this->_connect->prepare($sql);

            $stmt->bindParam(":id", $section_id);

            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi khi " . date("H:i:s") . ". Lỗi là: " . $e->getMessage();
            file_put_contents("../../Logs/section.log", $errorMessage, FILE_APPEND);
        }
    }

    public function insert($sectionName, $courseId)
    {
        try {
            $sql = "INSERT INTO sections (section_name, course_id) VALUES (:section_name, :course_id)";
            $stmt = $this->_connect->prepare($sql);
            $stmt->bindParam(":section_name", $sectionName);
            $stmt->bindParam(":course_id", $courseId);

            $result = $stmt->execute();
            $lastId = $this->_connect->lastInsertId($result);
            return $lastId;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi khi " . date("H:i:s") . ". Lỗi là: " . $e->getMessage();
            file_put_contents("/Logs/section.log", $errorMessage, FILE_APPEND);
        }
    }

    public function deleteById($sectionId) {
        try {
            $sql = "DELETE FROM sections WHERE id = :section_id";
            $stmt = $this->_connect->prepare($sql);

            $stmt->bindParam(":section_id", $sectionId);

            $result = $stmt->execute();
            return $result;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi khi " . date("H:i:s") . ". Lỗi là: " . $e->getMessage();
            file_put_contents("../../Logs/Section.log", $errorMessage, FILE_APPEND);
        }
    }

    public function update($sectionId, $sectionName)
    {
        try {
            $sql = "UPDATE sections SET section_name = :section_name WHERE id = :section_id";
            $stmt = $this->_connect->prepare($sql);

            $stmt->bindParam(":section_id", $sectionId);
            $stmt->bindParam(":section_name", $sectionName);

            $result = $stmt->execute();
            return $result;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi khi " . date("H:i:s") . ". Lỗi là: " . $e->getMessage();
            file_put_contents("../../Logs/Section.log", $errorMessage, FILE_APPEND);
        }
    }
}
