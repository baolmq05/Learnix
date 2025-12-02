<?php 
  require_once "Database.php";
  class Review{
    private $_connect;
    private $_table = 'reviews';
    public function __construct()
    {
        $db = new Database();
        $this->_connect = $db->getConnect();
    }
    public function getAllReviewsByCourseId($courseId, $start = 0, $limit = 3){
        $sql = "SELECT r.*, u.avatar, u.name FROM $this->_table r LEFT JOIN users u ON r.user_id = u.id WHERE course_id = :courseId LIMIT :start, :limit";
        $stmt = $this->_connect->prepare($sql);
        $stmt->bindParam(':courseId', $courseId, PDO::PARAM_INT);
        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
  }
?>