<?php

require_once 'Models/Database.php';
class Profile
{
    private $_connection;

    public function __construct()
    {
        $db = new Database();
        $this->_connection = $db->getConnect();
    }

    public function getUserById($userId)
    {
        try {
            $stmt = $this->_connection->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute([':id' => $userId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ?: null;
        } catch (PDOException $e) {
            error_log("Error in getUserById: " . $e->getMessage());
            return null;
        }
    }

    public function countEnrolledCourses($userId)
    {
        $stmt = $this->_connection->prepare("SELECT COUNT(*) as course_count FROM enroll_courses WHERE user_id = :userId");
        $stmt->execute([':userId' => $userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int) $result['course_count'] : 0;
    }

    public function getcompletedCourses($userId)
    {
        $sql = "SELECT courses.*, enroll_courses.status 
            FROM courses 
            INNER JOIN enroll_courses ON courses.id = enroll_courses.course_id 
            WHERE enroll_courses.user_id = :userId AND enroll_courses.status = '1'";

        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([':userId' => $userId]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateUserProfile($userId, $name, $email, $avatarName)
    {
        try {
            // If avatarName is null, do not overwrite the avatar column
            if ($avatarName === null) {
                $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
                $stmt = $this->_connection->prepare($sql);
                $stmt->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':id' => $userId
                ]);
            } else {
                $sql = "UPDATE users SET name = :name, email = :email, avatar = :avatar WHERE id = :id";
                $stmt = $this->_connection->prepare($sql);
                $stmt->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':avatar' => $avatarName,
                    ':id' => $userId
                ]);
            }

            // Consider the update successful if the statement executed without throwing.
            return true;
        } catch (PDOException $e) {
            error_log("Error in updateUserProfile: " . $e->getMessage());
            return false;
        }
    }

    public function updateAdminProfile($userId, $name, $email, $information, $avatarName)
    {
        try {
            // If avatarName is null, do not overwrite the avatar column
            if ($avatarName === null) {
                $stmt = $this->_connection->prepare("UPDATE users SET name = :name, email = :email, information = :information WHERE id = :userId");
                $stmt->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':information' => $information,
                    ':userId' => $userId
                ]);
            } else {
                $stmt = $this->_connection->prepare("UPDATE users SET name = :name, email = :email, information = :information, avatar = :avatar WHERE id = :userId");
                $stmt->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':information' => $information,
                    ':avatar' => $avatarName,
                    ':userId' => $userId
                ]);
            }

            return true;
        } catch (PDOException $e) {
            error_log("Error in updateAdminProfile: " . $e->getMessage());
            return false;
        }
    }

    public function updateUserPassword($userId, $hashedPassword)
    {
        try {
            $stmt = $this->_connection->prepare("UPDATE users SET password = :password WHERE id = :id");
            $stmt->execute([
                ':password' => $hashedPassword,
                ':id' => $userId
            ]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Error in updateUserPassword: " . $e->getMessage());
            return false;
        }
    }

    public function isEmailExistsForOtherUser($email, $userId)
    {
        $stmt = $this->_connection->prepare("SELECT * FROM users WHERE email = :email AND id != :id");
        $stmt->execute([
            ':email' => $email,
            ':id' => $userId
        ]);
        return $stmt->rowCount() > 0;
    }
}
?>