<?php
require_once "Database.php";
class Index
{
    private $_conn;
    private $_enrollCourseTable = 'enroll_courses';
    private $_enrollCourseLessonTable = 'enroll_course_lessons';

    private $_lessonTable = 'lessons';

    private $_courseTable = 'courses';

    private $_reviewTable = 'reviews';

    public function __construct()
    {
        $database = new Database();
        $this->_conn = $database->getConnect();
    }


    // lấy khóa học đã đăng ký của người dùng chưa hoàn thành
    public function getEnrollCourse($user_id)
    {
        try {
            $sql = "SELECT *
        FROM $this->_enrollCourseTable 
        WHERE user_id = :user_id AND status = 0";
            $stmt = $this->_conn->prepare($sql);
            $stmt->execute(['user_id' => $user_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Index.log");
        }
    }

    // lấy enroll_id từ user_id và course_id
    public function getEnrollID($user_id, $course_id)
    {
        try {
            $sql = "SELECT id
        FROM $this->_enrollCourseTable
        WHERE user_id = :user_id 
        AND course_id = :course_id 
        LIMIT 1";
            $stmt = $this->_conn->prepare($sql);
            $stmt->execute(['user_id' => $user_id, 'course_id' => $course_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['id'] : null;
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Index.log");
        }
    }

    // lấy thông tin khóa học theo id
    public function getCourseById($id)
    {
        try {
            $sql = "SELECT *
            FROM $this->_courseTable
            WHERE id = :id 
            LIMIT 1";
            $stmt = $this->_conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Index.log");
        }
    }

    // lấy số bài học đã hoàn thành của khóa học của học viên
    public function getCompletedLessons($enroll_id)
    {
        try {
            $sql = "SELECT lesson_id
        FROM $this->_enrollCourseLessonTable
        WHERE enroll_course_id = :enroll_id 
        AND status = 1";
            $stmt = $this->_conn->prepare($sql);
            $stmt->execute(['enroll_id' => $enroll_id]);
            $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
            return is_array($result) ? $result : [];

        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Index.log");
        }
    }

    // đếm tổng số bài học của khóa học
    public function getTotalLessons($course_id)
    {
        try {
            $sql = "SELECT COUNT(l.id) AS total
                FROM sections s
                INNER JOIN lessons l ON l.section_id = s.id
                WHERE s.course_id = :course_id";
            $stmt = $this->_conn->prepare($sql);
            $stmt->execute(['course_id' => $course_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? (int) $result['total'] : 0;
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Index.log");
        }
    }

    // đếm tổng thời gian của khóa học
    public function getTotalLength($course_id)
    {
        try {
            $sql = "SELECT ROUND(SUM(TIME_TO_SEC(l.lesson_length)) / 3600,1) as total_length
        FROM sections s
        LEFT JOIN lessons l ON l.section_id = s.id
        WHERE s.course_id = :course_id";
            $stmt = $this->_conn->prepare($sql);
            $stmt->execute(['course_id' => $course_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? (float) $result['total_length'] : 0;
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Index.log");
        }
    }
    // lấy top 10 khóa học nhiều người đăng ký nhất
    public function getTop10EnrollCoursesIndex()
    {
        try {
            $sql = "SELECT  u.name AS instructor, t1.course_id, t2.course_name, t2.image, t2.regular_price, t2.sale_price,
            (SELECT ROUND(AVG(r.rating),1) 
            FROM reviews r 
            WHERE r.course_id = t1.course_id) as rating,
            COUNT(*) as total FROM enroll_courses t1 
            INNER JOIN courses t2 ON t1.course_id = t2.id
            INNER JOIN users u ON t2.teacher_id = u.id
            WHERE t2.status = 1
            GROUP BY t1.course_id
            ORDER BY total DESC
            LIMIT 10";
            $stmt = $this->_conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Dashboard.log");
        }
    }

    // lấy khóa học bán chạy nhất
    public function getTop1EnrollCoursesIndex()
    {
        try {
            $sql = "SELECT  u.name AS instructor, t1.course_id, t2.course_name,t2.description, t2.image, t2.regular_price, t2.sale_price,
            (SELECT ROUND(AVG(r.rating),1) 
            FROM reviews r 
            WHERE r.course_id = t1.course_id) as rating,
            COUNT(*) as total FROM enroll_courses t1 
            INNER JOIN courses t2 ON t1.course_id = t2.id
            INNER JOIN users u ON t2.teacher_id = u.id
            WHERE t2.status = 1
            GROUP BY t1.course_id
            ORDER BY total DESC
            LIMIT 1";
            $stmt = $this->_conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Dashboard.log");
        }
    }

    // lấy top10 khóa học giảm giá 
    public function getTop10SaleCoursesIndex()
    {
        try {
            $sql = "SELECT u.name AS instructor, c.id, c.course_name, c.image, c.regular_price, c.sale_price,((c.regular_price - c.sale_price)/c.regular_price)*100 AS discount_percent,
            (SELECT ROUND(AVG(r.rating),1) 
            FROM reviews r 
            WHERE r.course_id = c.id) as rating
            FROM courses c
            INNER JOIN users u ON c.teacher_id = u.id
            WHERE c.sale_price < c.regular_price AND c.status = 1
            ORDER BY (c.regular_price - c.sale_price) DESC
            LIMIT 10";
            $stmt = $this->_conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Index.log");
        }
    }
}