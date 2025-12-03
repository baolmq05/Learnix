<?php
require_once "Database.php";
class Comment
{
    private $_conn;
    private $_table = 'reviews';

    public function __construct()
    {
        $database = new Database();
        $this->_conn = $database->getConnect();
    }

    public function getAllComments()
    {
        try {
            $sql = "SELECT c.*,
            u.name AS user_name,
            cou.course_name
            FROM $this->_table c
            LEFT JOIN users u ON c.user_id = u.id
            LEFT JOIN courses cou ON c.course_id = cou.id
            ORDER BY c.created_at DESC";
            $stmt = $this->_conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Comment.log");
        }
    }

    public function getByIdComment($id)
    {
        try {
            $sql = "SELECT c.*,
            u_student.name AS student_name,
            cou.course_name,
            u_teacher.name AS teacher_name
            FROM $this->_table c
            INNER JOIN users u_student ON c.user_id = u_student.id
            INNER JOIN courses cou ON c.course_id = cou.id
            INNER JOIN users u_teacher ON cou.teacher_id = u_teacher.id
            WHERE c.id = :id";
            $stmt = $this->_conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Comment.log");
        }
    }

    public function updateStatus($id,$status){
        try {
            $sql = "UPDATE $this->_table SET status = :status, updated_at = NOW() WHERE id = :id";
            $stmt = $this->_conn->prepare($sql);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Comment.log");
        }
    }
}