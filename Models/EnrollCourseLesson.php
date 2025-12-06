<?php
require_once "./Models/Database.php";
class EnrollCourseLesson
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
            $sql = "SELECT l.*, el.status AS enroll_lesson_status, el.enroll_course_id, el.lesson_id FROM `enroll_course_lessons` el INNER JOIN enroll_courses ec ON ec.id = el.enroll_course_id INNER JOIN lessons l ON l.id = el.lesson_id WHERE ec.course_id = :course_id";
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

    public function updateStatusByLessonId($lessonId, $status)
    {
        try {
            $sql = "UPDATE enroll_course_lessons SET status=:status WHERE lesson_id=:lesson_id";
            $stmt = $this->_connect->prepare($sql);

            $stmt->bindParam(":lesson_id", $lessonId);
            $stmt->bindParam(":status", $status);
            $result = $stmt->execute();
            
            return $result;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi lúc: " . date("H:i:s") . ". Lỗi là: " . $e->getMessage();
            file_put_contents("./Logs/EnrollCourseLesson.log", $errorMessage, FILE_APPEND);
        }
    }
}
