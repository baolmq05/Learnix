<?php
require_once "Models/Database.php";

class Transaction
{
    private $_connection;

    public function __construct()
    {
        $db = new Database();
        $this->_connection = $db->getConnect();
    }

    /**
     * Lấy danh sách transactions của user theo type
     * @param int $userId
     * @param int|null $type 
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getTransactionsByUser($userId, $type = null, $limit = 20, $offset = 0)
    {
        try {
            $query = "SELECT * FROM transactions WHERE user_id = :user_id";
            
            if ($type !== null) {
                $query .= " AND type = :type";
            }
            
            $query .= " ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
            
            $stmt = $this->_connection->prepare($query);
            $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
            
            if ($type !== null) {
                $stmt->bindValue(':type', $type, PDO::PARAM_INT);
            }
            
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    /**
     * Đếm tổng số transactions
     */
    public function countTransactionsByUser($userId, $type = null)
    {
        try {
            $query = "SELECT COUNT(*) as total FROM transactions WHERE user_id = :user_id";
            
            if ($type !== null) {
                $query .= " AND type = :type";
            }
            
            $stmt = $this->_connection->prepare($query);
            $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
            
            if ($type !== null) {
                $stmt->bindValue(':type', $type, PDO::PARAM_INT);
            }
            
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result['total'] ?? 0;
        } catch (PDOException $e) {
            return 0;
        }
    }

    /**
     * Lấy thông tin 1 transaction theo ID
     */
    public function getTransactionById($transactionId, $userId)
    {
        try {
            $stmt = $this->_connection->prepare(
                "SELECT * FROM transactions WHERE id = :id AND user_id = :user_id LIMIT 1"
            );
            $stmt->execute([
                'id' => $transactionId,
                'user_id' => $userId
            ]);
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }
}
?>