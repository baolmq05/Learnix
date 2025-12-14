<?php
require_once "Database.php";
class Review
{
    private $_connect;
    private $_table = 'reviews';
    public function __construct()
    {
        $db = new Database();
        $this->_connect = $db->getConnect();
    }
    public function getAllReviewsByCourseId($courseId, $start = 0, $limit = 3)
    {
        $sql = "SELECT r.*, u.avatar, u.name FROM $this->_table r LEFT JOIN users u ON r.user_id = u.id WHERE course_id = :courseId LIMIT :start, :limit";
        $stmt = $this->_connect->prepare($sql);
        $stmt->bindParam(':courseId', $courseId, PDO::PARAM_INT);
        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkHasReview($user_id, $course_id)
    {
        $sql = "
        SELECT *
        FROM {$this->_table}
        WHERE user_id = :user_id
          AND course_id = :course_id
        LIMIT 1";

        $stmt = $this->_connect->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':course_id', $course_id, PDO::PARAM_INT);
        $stmt->execute();

        return (bool) $stmt->fetchColumn();
    }

    public function insert($userId, $courseId, $content, $rating)
    {
        $sql = "
        INSERT INTO reviews (user_id, course_id, content, rating, status)
        VALUES (:user_id, :course_id, :content, :rating, :status)
    ";

        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([
            ':user_id'   => (int)$userId,
            ':course_id' => (int)$courseId,
            ':content'   => $content,
            ':rating'    => (int)$rating,
            ':status'    => 1
        ]);
    }
}
