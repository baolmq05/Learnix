<?php
require_once 'Database.php';
class Note
{

    private $_connection;

    public function __construct()
    {
        $db = new Database();
        $this->_connection = $db->getConnect();
    }

    public function addNote($userId, $lessonId, $content, $videoTime)
    {
        try {
        $stmt = $this->_connection->prepare("INSERT INTO notes (content, lesson_id, user_id, video_time) VALUES (:content, :lesson_id, :user_id, :video_time)");
        return $stmt->execute([
            ':user_id' => $userId,
            ':lesson_id' => $lessonId,
            ':content' => $content,
            ':video_time' => $videoTime
        ]);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Note.log");
            return false;
        }
    }

    public function getNotesByUserAndLesson($userId, $lessonId)
    {
        $stmt = $this->_connection->prepare("SELECT n.*, l.lesson_name FROM `notes` n INNER JOIN lessons l ON n.lesson_id = l.id WHERE n.user_id = :user_id AND n.lesson_id = :lesson_id ORDER BY n.created_at DESC");
        $stmt->execute([
            ':user_id' => $userId,
            ':lesson_id' => $lessonId
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editNote($noteId, $content)
    {
        try {
        $stmt = $this->_connection->prepare("UPDATE notes SET content = :content WHERE id = :note_id");
        return $stmt->execute([
            ':note_id' => $noteId,
            ':content' => $content
        ]);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Note.log");
            return false;
        }
    }
    public function deleteNote($noteId)
    {
        try {
        $stmt = $this->_connection->prepare("DELETE FROM notes WHERE id = :note_id");
        return $stmt->execute([
            ':note_id' => $noteId
        ]);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Note.log");
            return false;
        }
    }
}