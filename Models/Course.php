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
    public function getTotalCourses($rating = 0, $durationMin = 0, $durationMax = 1000)
    {
        $sql = "SELECT COUNT(*) AS total FROM (
        SELECT 
    c.*,
    u.name AS instructor,
    COALESCE(ROUND(AVG(r.rating), 1), 0) AS rating,
    COALESCE((
        SELECT ROUND(SUM(TIME_TO_SEC(l.lesson_length)) / 3600,1)
        FROM sections s
        LEFT JOIN lessons l ON l.section_id = s.id
        WHERE s.course_id = c.id
        ), 0) AS total_length
        FROM $this->_table AS c
        INNER JOIN users AS u ON c.teacher_id = u.id
        LEFT JOIN reviews r ON r.course_id = c.id
        WHERE c.status = 1
        GROUP BY c.id
        HAVING rating >= :rating
        AND total_length >= :durationMin
        AND total_length <= :durationMax) AS total;";
        $stmt = $this->_connect->prepare($sql);
        $stmt->execute([':rating' => $rating, ':durationMin' => $durationMin, ':durationMax' => $durationMax]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getTotalCoursesByCategory($categoryId, $rating = 0, $durationMin = 0, $durationMax = 1000)
    {
        $sql = "SELECT COUNT(*) AS total FROM (
        SELECT 
    c.*,
    u.name AS instructor,
    COALESCE(ROUND(AVG(r.rating), 1), 0) AS rating,
    COALESCE((
        SELECT ROUND(SUM(TIME_TO_SEC(l.lesson_length)) / 3600,1)
        FROM sections s
        LEFT JOIN lessons l ON l.section_id = s.id
        WHERE s.course_id = c.id
        ), 0) AS total_length
        FROM $this->_table AS c
        INNER JOIN users AS u ON c.teacher_id = u.id
        LEFT JOIN reviews r ON r.course_id = c.id
        WHERE c.status = 1 AND c.category_id = :category_id
        GROUP BY c.id
        HAVING rating >= :rating
        AND total_length >= :durationMin
        AND total_length <= :durationMax) AS total;";
        $stmt = $this->_connect->prepare($sql);
        $stmt->bindParam(':category_id', $categoryId);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':durationMin', $durationMin);
        $stmt->bindParam(':durationMax', $durationMax);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function checkDuplicateName($courseName)
    {
        try {
            $sql = "SELECT * FROM courses WHERE course_name = :course_name";
            $stmt = $this->_connect->prepare($sql);
            $stmt->bindParam(":course_name", $courseName);
            $stmt->execute();

            return $stmt->rowCount(); // trả về số dòng tìm được (0 hoặc >=1)

        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Course.log");
        }
    }

    public function getAllCourse($offset = 0, $rating = 0, $durationMin = 0, $durationMax = 1000, $sort = 'DESC', $dataSort = 'rating')
    {
        $filter = 'ORDER BY ' . $dataSort . ' ' . $sort;
        $sql = "SELECT 
    c.*,
    u.name AS instructor,
    COALESCE(ROUND(AVG(r.rating), 1), 0) AS rating,
    COALESCE((
        SELECT ROUND(SUM(TIME_TO_SEC(l.lesson_length)) / 3600,1)
        FROM sections s
        LEFT JOIN lessons l ON l.section_id = s.id
        WHERE s.course_id = c.id
        ), 0) AS total_length
        FROM courses AS c
        INNER JOIN users AS u ON c.teacher_id = u.id
        LEFT JOIN reviews r ON r.course_id = c.id
        WHERE c.status = 1
        GROUP BY c.id
        HAVING rating >= :rating
        AND total_length >= :durationMin
        AND total_length <= :durationMax
        $filter
        LIMIT 5 OFFSET :offset";
        $stmt = $this->_connect->prepare($sql);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':durationMin', $durationMin);
        $stmt->bindParam(':durationMax', $durationMax);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getCourseByCategory($categoryId, $offset = 0, $rating = 0, $durationMin = 0, $durationMax = 1000, $sort = 'DESC', $dataSort = 'rating')
    {
        $filter = 'ORDER BY ' . $dataSort . ' ' . $sort;
        $sql = "SELECT 
    c.*,
    u.name AS instructor,
    COALESCE(ROUND(AVG(r.rating), 1), 0) AS rating,
    COALESCE((
        SELECT ROUND(SUM(TIME_TO_SEC(l.lesson_length)) / 3600,1)
        FROM sections s
        LEFT JOIN lessons l ON l.section_id = s.id
        WHERE s.course_id = c.id
        ), 0) AS total_length
        FROM courses AS c
        INNER JOIN users AS u ON c.teacher_id = u.id
        LEFT JOIN reviews r ON r.course_id = c.id
        LEFT JOIN categories cate ON c.category_id = cate.id
        WHERE c.status = 1 AND c.category_id = :category_id AND cate.status = 1
        GROUP BY c.id
        HAVING rating >= :rating
        AND total_length >= :durationMin
        AND total_length <= :durationMax
        $filter
        LIMIT 5 OFFSET :offset";
        $stmt = $this->_connect->prepare($sql);
        $stmt->bindParam(':category_id', $categoryId);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':durationMin', $durationMin);
        $stmt->bindParam(':durationMax', $durationMax);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
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
    WHERE c.status != 0 AND c.id = :courseId
    GROUP BY c.id;";
        $stmt = $this->_connect->prepare($sql);
        $stmt->bindParam(':courseId', $courseId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getOneCourseWithCategoryStatus($courseId)
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
    LEFT JOIN categories cate ON c.category_id = cate.id
    WHERE c.status != 0 AND c.id = :courseId AND cate.status = 1
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

    public function getAvgRating($teacherId)
    {
        $sql = "SELECT ROUND(AVG(rating), 1) AS avg_rating FROM reviews r LEFT JOIN courses c ON c.id = r.course_id WHERE c.teacher_id = :teacher_id";
        $stmt = $this->_connect->prepare($sql);
        $stmt->bindParam(':teacher_id', $teacherId);
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

    public function updateStatus($id, $status, $reason)
    {
        try {
            $sql = "UPDATE $this->_table SET status = :status, reason = :reason, updated_at = NOW() WHERE id = :id";
            $stmt = $this->_connect->prepare($sql);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':reason', $reason);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Course.log");
        }
    }

    // QuocBao
    public function updateCourseById($data)
    {
        try {
            $sql = "UPDATE courses SET category_id=:category_id, course_name=:course_name, description=:description, benefit=:benefit, customer_object=:customer_object, regular_price=:regular_price, sale_price=:sale_price, teacher_id=:teacher_id, image=:image, status=:status  WHERE id=:id";
            $stmt = $this->_connect->prepare($sql);

            $result = $stmt->execute($data);
            return $result;
        } catch (PDOException $e) {
            $error = "Insert Fail When " . date("Ymd_His") . " with messageError: " . $e->getMessage() . PHP_EOL;
            file_put_contents("./Logs/Course.log", $error, FILE_APPEND);
        }
    }

    public function insert($category, $courseName, $teacherId)
    {
        try {
            $sql = "INSERT INTO courses (category_id, course_name, teacher_id) VALUES (:category, :courseName, :teacher_id)";
            $stmt = $this->_connect->prepare($sql);
            $data = [
                'category' => $category,
                'courseName' => $courseName,
                'teacher_id' => $teacherId
            ];

            $result = $stmt->execute($data);
            $lastId = $this->_connect->lastInsertId($result);
            return $lastId;
        } catch (PDOException $e) {
            $error = "Insert Fail When " . date("Ymd_His") . " with messageError: " . $e->getMessage() . PHP_EOL;
            file_put_contents("./Logs/Course.log", $error, FILE_APPEND);
        }
    }

    public function getCourseById($id)
    {
        try {
            $sql = "SELECT * FROM courses WHERE id = :id";
            $stmt = $this->_connect->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi lúc " . date("h:i:sa") . $e->getMessage();
            file_put_contents("./Logs/Course.log", $errorMessage, FILE_APPEND);
        }
    }

    public function getTeacherCourses($teacherId, $status)
    {
        try {
            $sql = "SELECT 
                courses.id AS course_id, 
                courses.image AS course_image,
                courses.course_name AS course_name,
                courses.sale_price AS sale_price,
                courses.reason AS reason,
                courses.regular_price AS regular_price,
                COUNT(DISTINCT enroll_courses.id) AS student_quantity,
                COALESCE(ROUND(AVG(reviews.rating), 1), 0) AS rating
                FROM courses
                LEFT JOIN enroll_courses ON enroll_courses.course_id = courses.id
                LEFT JOIN reviews ON reviews.course_id = courses.id
                WHERE courses.teacher_id = :teacher_id 
                AND courses.status = :status
                GROUP BY courses.id";
            $stmt = $this->_connect->prepare($sql);
            $stmt->bindParam(":teacher_id", $teacherId);
            $stmt->bindParam(":status", $status);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi lúc " . date("h:i:sa") . $e->getMessage();
            file_put_contents("./Logs/Course.log", $errorMessage, FILE_APPEND);
        }
    }

    public function countTeacherCourseByStatus($teacherId)
    {
        try {

            // 0 là đang chỉnh sửa, 1 là đã duyệt và được phép bán, 2 là đang chờ duyệt, 3 là ngừng bán, 4 là từ chối
            $sql = "SELECT
                    SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS editing_count,
                    SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS approved_count,
                    SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) AS pending_count,
                    SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS disabled_count,
                    SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS rejected_count
                    FROM courses
                    WHERE teacher_id = :teacher_id;";
            $stmt = $this->_connect->prepare($sql);
            $stmt->bindParam(":teacher_id", $teacherId);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi lúc " . date("h:i:sa") . $e->getMessage();
            file_put_contents("./Logs/Course.log", $errorMessage, FILE_APPEND);
        }
    }

    public function searchCoursesByName($courseName)
    {
        try {
            $sql = "SELECT id, course_name, image FROM courses WHERE course_name LIKE :course_name AND status=1 LIMIT 10";
            $stmt = $this->_connect->prepare($sql);
            $likeCourseName = '%' . $courseName . '%';
            $stmt->bindParam(":course_name", $likeCourseName);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi lúc " . date("h:i:sa") . $e->getMessage();
            file_put_contents("./Logs/Course.log", $errorMessage, FILE_APPEND);
        }
    }
}
