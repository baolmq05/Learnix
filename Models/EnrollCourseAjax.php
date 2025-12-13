<?php
require_once "../../../Models/Database.php";
class EnrollCourseAjax
{
    private $_connect;

    public function __construct()
    {
        $db = new Database();
        $this->_connect = $db->getConnect();
    }

    // Hàm ajax
    public function getAllByCourseId($courseId)
    {
        try {
            $sql = "SELECT * FROM enroll_courses WHERE course_id=:course_id";
            $stmt = $this->_connect->prepare($sql);

            $stmt->bindParam(":course_id", $courseId);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi lúc: " . date("H:i:s") . ". Lỗi là: " . $e->getMessage();
            file_put_contents("./Logs/EnrollCourseLesson.log", $errorMessage, FILE_APPEND);
        }
    }
}
