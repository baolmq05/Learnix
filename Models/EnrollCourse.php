<?php
require_once "./Models/Database.php";
class EnrollCourse
{
    private $_connect;

    public function __construct()
    {
        $db = new Database();
        $this->_connect = $db->getConnect();
    }

    public function updateStatusById($status, $id)
    {
        try {
            $sql = "UPDATE enroll_courses SET status=:status WHERE id=:id";
            $stmt = $this->_connect->prepare($sql);

            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":id", $id);
            $result = $stmt->execute();

            return $result;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi lúc: " . date("H:i:s") . ". Lỗi là: " . $e->getMessage();
            file_put_contents("./Logs/EnrollCourseLesson.log", $errorMessage, FILE_APPEND);
        }
    }
}
