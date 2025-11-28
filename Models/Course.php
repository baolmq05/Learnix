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
}
?>