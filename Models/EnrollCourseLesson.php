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

    public function getByCourseId($courseId, $userId)
    {
        try {
            $sql = "SELECT l.*, el.status AS enroll_lesson_status, el.enroll_course_id, el.lesson_id FROM `enroll_course_lessons` el INNER JOIN enroll_courses ec ON ec.id = el.enroll_course_id INNER JOIN lessons l ON l.id = el.lesson_id WHERE ec.course_id = :course_id AND ec.user_id = :user_id
                GROUP BY el.lesson_id";
            $stmt = $this->_connect->prepare($sql);

            $stmt->bindParam(":course_id", $courseId);
            $stmt->bindParam(":user_id", $userId);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi lúc: " . date("H:i:s") . ". Lỗi là: " . $e->getMessage();
            file_put_contents("./Logs/EnrollCourseLesson.log", $errorMessage, FILE_APPEND);
        }
    }

    public function getTotalCountByUserId($userId){
        try {
            $sql = "SELECT COUNT(id) AS course_quantity FROM `enroll_courses` WHERE user_id = :user_id";
            $stmt = $this->_connect->prepare($sql);

            $stmt->bindParam(":user_id", $userId);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi lúc: " . date("H:i:s") . ". Lỗi là: " . $e->getMessage();
            file_put_contents("./Logs/EnrollCourseLesson.log", $errorMessage, FILE_APPEND);
        }
    }

    public function getCountByStatusUserId($userId, $status){
        try {
            $sql = "SELECT COUNT(id) AS course_quantity FROM `enroll_courses` WHERE user_id = :user_id AND status = :status";
            $stmt = $this->_connect->prepare($sql);

            $stmt->bindParam(":user_id", $userId);
            $stmt->bindParam(":status", $status);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi lúc: " . date("H:i:s") . ". Lỗi là: " . $e->getMessage();
            file_put_contents("./Logs/EnrollCourseLesson.log", $errorMessage, FILE_APPEND);
        }
    }

    public function getEnrollCourseByUserId($userId, $status) {
        try {
            $sql = "SELECT 
    ec.id AS enroll_course_id,
    ec.course_id,
    c.course_name AS course_name,
    c.image AS course_image,
    u.name AS teacher_name,
    COALESCE(ROUND(AVG(r.rating), 1), 0) AS course_rating,

    -- Tính phần trăm bài học hoàn thành
    COALESCE(
        ROUND(
            (SUM(CASE WHEN ecl.status = 1 THEN 1 ELSE 0 END) / COUNT(ecl.id)) * 100
        , 0)
    , 0) AS progress_percent

FROM enroll_courses ec
INNER JOIN courses c ON c.id = ec.course_id
INNER JOIN users u ON u.id = c.teacher_id
LEFT JOIN reviews r ON r.course_id = c.id
LEFT JOIN enroll_course_lessons ecl ON ecl.enroll_course_id = ec.id

WHERE ec.user_id = :user_id AND ec.status = :status
GROUP BY ec.id;";
            $stmt = $this->_connect->prepare($sql);

            $stmt->bindParam(":user_id", $userId);
            $stmt->bindParam(":status", $status);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi lúc: " . date("H:i:s") . ". Lỗi là: " . $e->getMessage() . PHP_EOL;
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
