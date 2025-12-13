<?php
require_once "../../../Models/Database.php";
class CourseAjax
{
    private $_connect;

    public function __construct()
    {
        $db = new Database();
        $this->_connect = $db->getConnect();
    }

    public function updateTimeUpdate($courseId)
    {
        try {
            $sql = "UPDATE courses SET updated_at = NOW() WHERE id = :course_id";
            $stmt = $this->_connect->prepare($sql);

            $stmt->bindParam(":course_id", $courseId);
            $result = $stmt->execute();

            return $result;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi lúc: " . date("H:i:s") . ". Lỗi là: " . $e->getMessage();
            file_put_contents("../Logs/Course.log", $errorMessage, FILE_APPEND);
        }
    }
}
