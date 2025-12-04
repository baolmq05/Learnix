<?php
require_once "../../../Models/Database.php";
class LessonAjax
{
    private $_connect;

    public function __construct()
    {
        $db = new Database();
        $this->_connect = $db->getConnect();
    }

    public function getBySectionId($sectionId) {
        try {
            $sql = "SELECT video_id FROM lessons WHERE section_id = :section_id";
            $stmt = $this->_connect->prepare($sql);

            $stmt->bindValue(":section_id", $sectionId, PDO::PARAM_INT);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            $errorMessage = PHP_EOL . "[" . date("H:i:s") . "] Lỗi update lesson: " . $e->getMessage();
            file_put_contents("../../Logs/Lesson.log", $errorMessage, FILE_APPEND);
            return false;
        }
    }

    public function insert($lessonLength, $lessonName, $sectionId, $videoId, $videoName)
    {
        try {
            $sql = "INSERT INTO lessons (lesson_name, lesson_length, section_id, video_id, video_name) VALUES (:lesson_name, :lesson_length, :section_id, :video_id, :video_name)";
            $stmt = $this->_connect->prepare($sql);
            $stmt->bindParam(":lesson_name", $lessonName);
            $stmt->bindParam(":lesson_length", $lessonLength);
            $stmt->bindParam(":section_id", $sectionId);
            $stmt->bindParam(":video_id", $videoId);
            $stmt->bindParam(":video_name", $videoName);

            $result = $stmt->execute();
            $lastId = $this->_connect->lastInsertId($result);
            return $lastId;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi khi " . date("H:i:s") . ". Lỗi là: " . $e->getMessage();
            file_put_contents("../../Logs/Lesson.log", $errorMessage, FILE_APPEND);
        }
    }

    public function updateNameById($lessonName, $lessonId)
    {
        try {
            $sql = "UPDATE lessons SET lesson_name = :lesson_name WHERE id = :lesson_id";
            $stmt = $this->_connect->prepare($sql);
            $stmt->bindParam(":lesson_name", $lessonName);
            $stmt->bindParam(":lesson_id", $lessonId);

            $result = $stmt->execute();
            return $result;
        } catch (PDOException $e) {
            $errorMessage = "Lỗi khi " . date("H:i:s") . ". Lỗi là: " . $e->getMessage();
            file_put_contents("../../Logs/Lesson.log", $errorMessage, FILE_APPEND);
        }
    }

    public function updateLessonVideo($lessonName, $lessonId, $videoName, $videoId)
    {
        try {
            if (!empty($lessonName)) {
                $sql = "UPDATE lessons 
                    SET lesson_name = :lesson_name, video_name = :video_name, video_id = :video_id 
                    WHERE id = :lesson_id";
            } else {
                $sql = "UPDATE lessons 
                    SET video_name = :video_name, video_id = :video_id
                    WHERE id = :lesson_id";
            }

            $stmt = $this->_connect->prepare($sql);

            // Nếu có tên bài học thì bind luôn
            if (!empty($lessonName)) {
                $stmt->bindValue(":lesson_name", $lessonName);
            }

            $stmt->bindValue(":lesson_id", $lessonId, PDO::PARAM_INT);
            $stmt->bindValue(":video_name", $videoName);
            $stmt->bindValue(":video_id", $videoId);

            return $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = PHP_EOL . "[" . date("H:i:s") . "] Lỗi update lesson: " . $e->getMessage();
            file_put_contents("../../Logs/Lesson.log", $errorMessage, FILE_APPEND);
            return false;
        }
    }

    public function deleteById($lessonId) {
        try {
            $sql = "DELETE FROM lessons WHERE id = :lesson_id";
            $stmt = $this->_connect->prepare($sql);

            $stmt->bindValue(":lesson_id", $lessonId, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = PHP_EOL . "[" . date("H:i:s") . "] Lỗi update lesson: " . $e->getMessage();
            file_put_contents("../../Logs/Lesson.log", $errorMessage, FILE_APPEND);
            return false;
        }
    }

    public function deleteBySectionId($sectionId) {
        try {
            $sql = "DELETE FROM lessons WHERE section_id = :section_id";
            $stmt = $this->_connect->prepare($sql);

            $stmt->bindValue(":section_id", $sectionId, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = PHP_EOL . "[" . date("H:i:s") . "] Lỗi update lesson: " . $e->getMessage();
            file_put_contents("../../Logs/Lesson.log", $errorMessage, FILE_APPEND);
            return false;
        }
    }
}
