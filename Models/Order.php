<?php
require_once 'Models/Database.php';
class Order
{
    private $_connection;

    private $_enrollCourseTable = 'enroll_courses';

    private $_userTable = 'users';

    private $_transactionTable = 'transactions';

    private $_courseTable = 'courses';

    private $_reviewTable = 'reviews';

    public function __construct()
    {
        $db = new Database();
        $this->_connection = $db->getConnect();
    }

    public function getAllEnrollCourses()
    {
        try {
            $sql = "SELECT 
            ec.*, 
            u.name AS user_name, 
            t.transaction_code
            FROM $this->_enrollCourseTable ec
            JOIN $this->_userTable u ON ec.user_id = u.id
            LEFT JOIN (
            SELECT user_id, transaction_code
            FROM $this->_transactionTable
            WHERE type = 2
            GROUP BY user_id) t ON ec.user_id = t.user_id
            ORDER BY ec.created_at DESC";
            $stmt = $this->_connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Order.log");
        }
    }

    public function getEnrollCourseDetail($enrollId)
    {
        try {
            $sql = "SELECT 
            ec.*, 
            u.name AS user_name, u.email as user_email, 
            c.course_name,
            c.image AS course_image,
            t.transaction_code,
            t2.name AS teacher_name,
            COALESCE(ROUND(AVG(r.rating), 1), 0) AS rating
            FROM $this->_enrollCourseTable ec
            JOIN $this->_userTable u ON ec.user_id = u.id
            JOIN $this->_courseTable c ON ec.course_id = c.id
            JOIN $this->_userTable t2 ON c.teacher_id = t2.id
            LEFT JOIN $this->_transactionTable t ON ec.user_id = t.user_id AND t.type = 2
            LEFT JOIN $this->_reviewTable r ON r.course_id = c.id 
            WHERE ec.id = :id
            GROUP BY ec.id";
            $stmt = $this->_connection->prepare($sql);
            $stmt->bindParam(':id', $enrollId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Order.log");
        }
    }



}
?>