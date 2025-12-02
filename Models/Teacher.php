<?php
require_once 'Models/Database.php';
class Teacher
{

    private $_connection;
    public function __construct()
    {
        $db = new Database();
        $this->_connection = $db->getConnect();
    }

    public function updateTeacherProfile($userId, $name, $email, $information, $avatarName, $bankName, $bankNumber)
    {
        try {
            if ($avatarName === null) {
                $stmt = $this->_connection->prepare("UPDATE users SET name = :name, email = :email, information = :information, bank_name = :bank_name, bank_number = :bank_number WHERE id = :userId");
                $stmt->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':information' => $information,
                    ':bank_name' => $bankName,
                    ':bank_number' => $bankNumber,
                    ':userId' => $userId
                ]);
            } else {
                $stmt = $this->_connection->prepare("UPDATE users SET name = :name, email = :email, information = :information, avatar = :avatar, bank_name = :bank_name, bank_number = :bank_number WHERE id = :userId");
                $stmt->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':information' => $information,
                    ':avatar' => $avatarName,
                    ':bank_name' => $bankName,
                    ':bank_number' => $bankNumber,
                    ':userId' => $userId
                ]);
            }

            return true;
        } catch (PDOException $e) {
            error_log("Error in updateTeacherProfile: " . $e->getMessage());
            return false;
        }

    }

    public function getById($userId)
    {
        try {
            $stmt = $this->_connection->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute([':id' => $userId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ?: null;
        } catch (PDOException $e) {
            error_log("Error in getById: " . $e->getMessage());
            return null;
        }
    }

    public function countCoursesByTeacher($teacherId)
    {
        try {
            $stmt = $this->_connection->prepare("SELECT COUNT(*) as course_count FROM courses WHERE teacher_id = :teacherId");
            $stmt->execute([':teacherId' => $teacherId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? (int) $row['course_count'] : 0;
        } catch (PDOException $e) {
            error_log("Error in countCoursesByTeacher: " . $e->getMessage());
            return 0;
        }
    }

    public function countStudentsByTeacher($teacherId)
    {
        try {
            $stmt = $this->_connection->prepare("SELECT COUNT(DISTINCT e.user_id) as student_count
                                                 FROM enroll_courses e
                                                 JOIN courses ON e.course_id = courses.id
                                                 WHERE courses.teacher_id = :teacherId");
            $stmt->execute([':teacherId' => $teacherId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? (int) $row['student_count'] : 0;
        } catch (PDOException $e) {
            error_log("Error in countStudentsByTeacher: " . $e->getMessage());
            return 0;
        }
    }

    public function calRatingByCourse($teacherId)
    {
        try {
            $sql = "
            SELECT 
                AVG(r.rating) as avg_rating
            FROM 
                reviews r
            JOIN 
                courses c ON r.course_id = c.id
            WHERE 
                c.teacher_id = :teacherId
        ";

            $stmt = $this->_connection->prepare($sql);
            $stmt->execute([':teacherId' => $teacherId]);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row && $row['avg_rating'] !== null
                ? round((float) $row['avg_rating'], 2)
                : 0.0;

        } catch (PDOException $e) {
            error_log("Error in calRatingByCourse: " . $e->getMessage());
            return 0.0;
        }
    }
}
