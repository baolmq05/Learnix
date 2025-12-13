<?php
require_once "../../../Models/Database.php";
class EnrollCourseLessonAjax
{
    private $_connect;

    public function __construct()
    {
        $db = new Database();
        $this->_connect = $db->getConnect();
    }

    public function insertByEnrollId($enrollCourseId, $lessonId)
    {
        try {
            $status = 0;

            $sql = "INSERT INTO enroll_course_lessons (status, enroll_course_id, lesson_id) VALUES (:status, :enroll_course_id, :lesson_id)";
            $stmt = $this->_connect->prepare($sql);

            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":enroll_course_id", $enrollCourseId);
            $stmt->bindParam(":lesson_id", $lessonId);
            $result = $stmt->execute();

            return $result;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi lúc: " . date("H:i:s") . ". Lỗi là: " . $e->getMessage();
            file_put_contents("./Logs/EnrollCourseLesson.log", $errorMessage, FILE_APPEND);
        }
    }

    public function deleteByEnrollLessonId($lessonId)
    {
        try {
            $sql = "DELETE FROM enroll_course_lessons WHERE lesson_id = :lesson_id";
            $stmt = $this->_connect->prepare($sql);

            $stmt->bindParam(":lesson_id", $lessonId);
            $result = $stmt->execute();

            return $result;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi lúc: " . date("H:i:s") . ". Lỗi là: " . $e->getMessage();
            file_put_contents("./Logs/EnrollCourseLesson.log", $errorMessage, FILE_APPEND);
        }
    }
}
