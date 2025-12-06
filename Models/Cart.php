<?php
require_once "Database.php";

class Cart
{
    private $_table = 'carts';
    private $_connection;
    public function __construct()
    {
        $database = new Database();
        $this->_connection = $database->getConnect();
    }

    public function getAllCart($user_id)
    {
        $stmt = $this->_connection->prepare("SELECT 
    c.*,
    u.name AS instructor,
    COALESCE(ROUND(AVG(r.rating), 1), 0) AS rating,
    (
        SELECT ROUND(SUM(TIME_TO_SEC(l.lesson_length)) / 3600,1)
        FROM sections s
        LEFT JOIN lessons l ON l.section_id = s.id
        WHERE s.course_id = c.id 
    ) AS total_length,
    (
        SELECT COUNT(*)
        FROM sections s
        LEFT JOIN lessons l ON l.section_id = s.id
        WHERE s.course_id = c.id
    ) AS total_lesson
    FROM courses AS c
        INNER JOIN users AS u ON c.teacher_id = u.id
        LEFT JOIN reviews r ON r.course_id = c.id 
        INNER JOIN carts ca ON ca.course_id = c.id
            WHERE c.status = 1 AND ca.user_id = :user_id
            GROUP BY c.id;
    ");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addToCart($user_id, $course_id)
    {
        try {
            $stmt = $this->_connection->prepare("INSERT INTO {$this->_table} (user_id, course_id) VALUES (:user_id, :course_id)");
            $stmt->execute([
                'user_id' => $user_id,
                'course_id' => $course_id
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteCartItem($user_id, $course_id)
    {
        $sql = "DELETE FROM carts WHERE user_id = :user_id AND course_id = :course_id";
        $stmt = $this->_connection->prepare($sql);
        return $stmt->execute([
            'user_id' => $user_id,
            'course_id' => $course_id
        ]);
    }
}
