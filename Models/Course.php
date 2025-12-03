<?php
require_once "Database.php";
class Course
{
    private $_connect;
    private $_table = 'courses';
    public function __construct()
    {
        $db = new Database();
        $this->_connect = $db->getConnect();
    }
    public function getAllCourse()
    {
        $sql = "SELECT 
    c.*,
    u.name AS instructor,
    COALESCE(ROUND(AVG(r.rating), 1), 0) AS rating,
    (
        SELECT ROUND(SUM(TIME_TO_SEC(l.lesson_length)) / 3600,1)
        FROM sections s
        LEFT JOIN lessons l ON l.section_id = s.id
        WHERE s.course_id = c.id
    ) AS total_length
    FROM $this->_table AS c
    INNER JOIN users AS u ON c.teacher_id = u.id
    LEFT JOIN reviews r ON r.course_id = c.id
    WHERE c.status = 1
    GROUP BY c.id;";
        $stmt = $this->_connect->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getCourseByCategory($categoryId)
    {
        $sql = "SELECT 
    c.*,
    u.name AS instructor,
    COALESCE(ROUND(AVG(r.rating), 1), 0) AS rating,
    (
        SELECT ROUND(SUM(TIME_TO_SEC(l.lesson_length)) / 3600,1)
        FROM sections s
        LEFT JOIN lessons l ON l.section_id = s.id
        WHERE s.course_id = c.id
    ) AS total_length
    FROM $this->_table AS c
    INNER JOIN users AS u ON c.teacher_id = u.id
    LEFT JOIN reviews r ON r.course_id = c.id
    WHERE c.status = 1 AND c.category_id = :category_id
    GROUP BY c.id;
";
        $stmt = $this->_connect->prepare($sql);
        $stmt->bindParam(':category_id', $categoryId);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getOneCourse($courseId)
    {
        $sql = "SELECT 
    c.*,
    u.name AS instructor,u.avatar AS avatar, u.information AS teacher_information,
    COALESCE(ROUND(AVG(r.rating), 1), 0) AS rating,
        (
        SELECT COUNT(*) FROM reviews r WHERE r.course_id = :courseId
    ) AS total_review,
    (
        SELECT COUNT(*) FROM enroll_courses e WHERE e.course_id = :courseId 
    ) AS total_enroll,
    (
        SELECT COUNT(*) FROM sections s WHERE s.course_id = :courseId
    ) AS total_section,
        (
        SELECT COUNT(*)
        FROM sections s
        LEFT JOIN lessons l ON l.section_id = s.id
        WHERE s.course_id = c.id
    ) AS total_lesson,
    (
        SELECT ROUND(SUM(TIME_TO_SEC(l.lesson_length)) / 3600,1)
        FROM sections s
        LEFT JOIN lessons l ON l.section_id = s.id
        WHERE s.course_id = c.id
    ) AS total_length
    FROM $this->_table AS c
    INNER JOIN users AS u ON c.teacher_id = u.id
    LEFT JOIN reviews r ON r.course_id = c.id
    WHERE c.status = 1 AND c.id = :courseId
    GROUP BY c.id;";
        $stmt = $this->_connect->prepare($sql);
        $stmt->bindParam(':courseId', $courseId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getSectionByCourseId($courseId)
    {
        $sql = "SELECT *, COUNT(l.id) AS total_lesson, ROUND(SUM(TIME_TO_SEC(l.lesson_length)) / 3600,2) AS total_length FROM `sections` s LEFT JOIN lessons l ON s.id = l.section_id WHERE course_id = :courseId GROUP BY s.id";
        $stmt = $this->_connect->prepare($sql);
        $stmt->bindParam(':courseId', $courseId);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAllLessonByCourseId($courseId)
    {
        $sql = "SELECT * FROM `lessons` l INNER JOIN sections s ON l.section_id = s.id WHERE s.course_id = :courseId";
        $stmt = $this->_connect->prepare($sql);
        $stmt->bindParam(':courseId', $courseId);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getRelatedCourses($categoryId, $excludeCourseId, $limit = 4)
    {
        $sql = "SELECT 
    c.*,
    u.name AS instructor,
    COALESCE(ROUND(AVG(r.rating), 1), 0) AS rating,
        (
        SELECT COUNT(*) FROM enroll_courses e WHERE e.course_id = c.id 
    ) AS total_enroll,
    (
        SELECT ROUND(SUM(TIME_TO_SEC(l.lesson_length)) / 3600,1)
        FROM sections s
        LEFT JOIN lessons l ON l.section_id = s.id
        WHERE s.course_id = c.id
    ) AS total_length
    FROM $this->_table AS c
    INNER JOIN users AS u ON c.teacher_id = u.id
    LEFT JOIN reviews r ON r.course_id = c.id
    WHERE c.status = 1 AND c.category_id = :category_id AND c.id != :excludeCourseId
    GROUP BY c.id LIMIT :limit;
";
        $stmt = $this->_connect->prepare($sql);
        $stmt->bindParam(':category_id', $categoryId);
        $stmt->bindParam(':excludeCourseId', $excludeCourseId);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getCountCoursesByTeacher($teacherId)
    {
        $sql = "SELECT COUNT(*) AS course_count FROM $this->_table WHERE teacher_id = :teacher_id";
        $stmt = $this->_connect->prepare($sql);
        $stmt->bindParam(':teacher_id', $teacherId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAvgRating($courseId)
    {
        $sql = "SELECT ROUND(AVG(rating), 1) AS avg_rating FROM reviews WHERE course_id = :course_id";
        $stmt = $this->_connect->prepare($sql);
        $stmt->bindParam(':course_id', $courseId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['avg_rating'] ?? 0;
    }
    
    public function getCoursesByTeacherId($teacherId, $excludeCourseId, $limit = 4)
    {
        $sql = "SELECT 
    c.*,
    u.name AS instructor,
    COALESCE(ROUND(AVG(r.rating), 1), 0) AS rating,
        (
        SELECT COUNT(*) FROM enroll_courses e WHERE e.course_id = c.id 
    ) AS total_enroll,
    (
        SELECT ROUND(SUM(TIME_TO_SEC(l.lesson_length)) / 3600,1)
        FROM sections s
        LEFT JOIN lessons l ON l.section_id = s.id
        WHERE s.course_id = c.id
    ) AS total_length
    FROM $this->_table AS c
    INNER JOIN users AS u ON c.teacher_id = u.id
    LEFT JOIN reviews r ON r.course_id = c.id
    WHERE c.status = 1 AND c.teacher_id = :teacher_id AND c.id != :excludeCourseId
    GROUP BY c.id LIMIT :limit;
";
        $stmt = $this->_connect->prepare($sql);
        $stmt->bindParam(':teacher_id', $teacherId);
        $stmt->bindParam(':excludeCourseId', $excludeCourseId);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // admin ////////////////////////////////////////////////////////////////////////////////
    public function getAllCourseAdmin($status)
    {
        try {
            $sql = "SELECT 
    c.*,
    u.name AS instructor, cate.name AS category_name,
    COALESCE(ROUND(AVG(r.rating), 1), 0) AS rating,
    (
        SELECT ROUND(SUM(TIME_TO_SEC(l.lesson_length)) / 3600,1)
        FROM sections s
        LEFT JOIN lessons l ON l.section_id = s.id
        WHERE s.course_id = c.id
    ) AS total_length
    FROM $this->_table AS c
    INNER JOIN users AS u ON c.teacher_id = u.id
    INNER JOIN categories AS cate ON c.category_id = cate.id
    LEFT JOIN reviews r ON r.course_id = c.id
    WHERE c.status = :status
    GROUP BY c.id;
    ORDER BY c.created_at DESC;";
            $stmt = $this->_connect->prepare($sql);
            $stmt->bindParam(':status', $status);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Course.log");
        }
    }

    public function updateStatus($id, $status)
    {
        try {
            $sql = "UPDATE $this->_table SET status = :status, updated_at = NOW() WHERE id = :id";
            $stmt = $this->_connect->prepare($sql);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Course.log");
        }
    }
}
?>