<?php
require_once "Database.php";
class ChatBot
{
    private $_connect;

    public function __construct()
    {
        $db = new Database();
        $this->_connect = $db->getConnect();
    }

    public function getCourseInfo()
    {
        try {
            $sql = "SELECT courses.course_name AS course_name, courses.image, courses.regular_price AS course_base_price, courses.sale_price AS course_sale_price, courses.id AS course_id, courses.description AS course_description, users.name AS teacher_name, categories.name AS category_name FROM `courses` INNER JOIN users ON courses.teacher_id = users.id INNER JOIN categories ON courses.category_id = categories.id WHERE courses.status = 1;";
            $stmt = $this->_connect->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi lúc " . date("h:i:sa") . $e->getMessage();
            file_put_contents(".//Logs/Course.log", $errorMessage, FILE_APPEND);
        }
    }
}
