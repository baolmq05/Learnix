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
            $sql = "SELECT 
                    c.id AS course_id,
                    c.course_name AS course_name,
                    c.image AS course_image,
                    c.regular_price AS course_base_price,
                    c.sale_price AS course_sale_price,
                    c.description AS course_description,
                    u.name AS teacher_name,
                    cat.name AS category_name,
                    COALESCE(ROUND(AVG(r.rating), 1), 0) AS rating
                    FROM courses c
                    INNER JOIN users u ON c.teacher_id = u.id
                    INNER JOIN categories cat ON c.category_id = cat.id
                    LEFT JOIN reviews r ON r.course_id = c.id
                    WHERE c.status = 1
                    GROUP BY c.id
                    ORDER BY c.id DESC;";

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
