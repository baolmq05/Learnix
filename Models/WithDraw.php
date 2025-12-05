<?php
require_once 'Database.php';
class WithDraw
{
    private $_table = 'users';
    private $_transactionsTable = 'transactions';
    protected $_connection;

    public function __construct()
    {
        $database = new Database();
        $this->_connection = $database->getConnect();
    }

    // lấy tất cả yêu cầu rút tiền để dô admin
    public function getAllWithdrawRequests($status)
    {
        try {
            $sql = "SELECT 
                    t.id, t.amount, t.current_balance, t.status, 
                    t.created_at,t.reason, t.transaction_code,
                    u.name AS user_name,
                    u.bank_name, u.account_name, u.bank_number
                FROM $this->_transactionsTable t
                JOIN $this->_table u ON t.user_id = u.id
                WHERE t.type = 1 AND t.status = :status
                ORDER BY t.created_at DESC";

            $stmt = $this->_connection->prepare($sql);
            $stmt->execute(['status' => $status]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/WithDraw.log");
        }
    }

    // đếm yêu cầu rút tiền chờ duyệt theo status
    public function countPendingRequests($status)
    {
        try {
            $sql = "SELECT COUNT(*) AS pending_count FROM $this->_transactionsTable WHERE type = 1 AND status = :status";
            $stmt = $this->_connection->prepare($sql);
            $stmt->execute(['status' => $status]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['pending_count'] ?? 0;
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/WithDraw.log");
            return 0;
        }
    }



    // lấy thông tin rút tiền của user để dô client
    public function getUserWithdraw($id)
    {
        try {
            $sql = "SELECT balance, bank_name, account_name, bank_number
            FROM users
            Where id = :id";
            $stmt = $this->_connection->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/WithDraw.log");
        }
    }

    // tạo yêu cầu rút tiền
    public function createWithdrawRequest($data)
    {
        try {
            $this->_connection->beginTransaction();

            // Lock user row để tránh 2 2 máy gửi cùng lúc
            $sqlCheck = "SELECT id FROM $this->_transactionsTable 
                     WHERE user_id = :user_id AND status = 0 
                     LIMIT 1 FOR UPDATE";
            $stmt = $this->_connection->prepare($sqlCheck);
            $stmt->execute(['user_id' => $data['user_id']]);
            $existing = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existing) {
                $this->_connection->rollBack();
                return false;
            }

            $sql = "INSERT INTO $this->_transactionsTable 
            (user_id, current_balance, amount, type, status, created_at, transaction_code) 
            VALUES 
            (:user_id, :current_balance, :amount, :type, :status, :created_at, :transaction_code)";
            $stmt = $this->_connection->prepare($sql);
            $transactionCode = time() . random_int(1000, 9999);
            $stmt->execute([
                'user_id' => $data['user_id'],
                'current_balance' => $data['current_balance'],
                'amount' => $data['amount'],
                'type' => 1,
                'status' => 0,
                'created_at' => $data['created_at'] ?? date('Y-m-d H:i:s'),
                'transaction_code' => $transactionCode
            ]);

            $this->_connection->commit(); // quan trọng!!!
            return true;

        } catch (PDOException $e) {
            $this->_connection->rollBack();
            error_log('[' . date('Y-m-d H:i:s') . '] ' . $e->getMessage() . PHP_EOL, 3, "./Logs/WithDraw.log");
            return false;
        }
    }


    // kiểm tra user có yêu cầu rút tiền chờ duyệt không
    public function hasPendingRequest($userId)
    {
        try {
            $sql = "SELECT COUNT(*) FROM $this->_transactionsTable WHERE user_id = :user_id AND status = 0";
            $stmt = $this->_connection->prepare($sql);
            $stmt->execute(['user_id' => $userId]);
            return $stmt->fetchColumn() > 0; // >0 nghĩa là có yêu cầu chờ duyệt
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . '] ' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/WithDraw.log");
            return false;
        }
    }


    // chấp nhận yêu cầu và cập nhật tiền bên user
    public function approveWithdrawRequest($transactionId)
    {
        try {
            $transaction = $this->getById($transactionId);
            if (!$transaction) {
                return false;
            }
            $userId = $transaction['user_id'];
            $amount = $transaction['amount'];
            $current = $transaction['current_balance'];
            //tính tiefn bên user
            $newBalance = $current - $amount;
            // cập nhật số dư user
            $sqlUser = "UPDATE users SET balance = :balance WHERE id = :user_id";
            $stmt1 = $this->_connection->prepare($sqlUser);
            $stmt1->execute([
                'balance' => $newBalance,
                'user_id' => $userId
            ]);

            // cập nhật trạng thái giao dịch
            $sqlTrans = "UPDATE $this->_transactionsTable SET status = 1 WHERE id = :id";
            $stmt2 = $this->_connection->prepare($sqlTrans);
            $stmt2->execute(['id' => $transactionId]);

            return true;
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . '] ' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/WithDraw.log");
            return false;
        }
    }

    public function rejectWithdrawRequest($id, $reason)
    {
        try {
            $sql = "UPDATE $this->_transactionsTable SET status = 2, reason = :reason WHERE id = :id";
            $stmt = $this->_connection->prepare($sql);
            $stmt->execute(['id' => $id, 'reason' => $reason]);
            return true;
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . '] ' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/WithDraw.log");
            return false;
        }
    }

    // lấy giao dịch theo ID
    public function getById($id)
    {
        try {
            $sql = "SELECT t.*, u.balance FROM $this->_transactionsTable t JOIN $this->_table u ON t.user_id = u.id WHERE t.id = :id";
            $stmt = $this->_connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . '] ' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/WithDraw.log");
            return false;
        }
    }


}