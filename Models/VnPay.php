<?php
require_once 'Models/Database.php';
require_once 'config/Global.php';

class VnPay
{

    private $_connection;    
    public function __construct()
    {
        $db = new Database();
        $this->_connection = $db->getConnect();
    }

    /**
     * Tạo URL chuyển hướng tới VNPAY
     * @param array $postData dữ liệu từ form
     * @param string $ipAddr địa chỉ IP khách
     * @return string url trả về để redirect
     */
    public function createPayment($postData, $ipAddr)
    {
        // lấy dữ liệu từ $postData, kèm xử lý mặc định
        $vnp_TxnRef = rand(1, 1000000);
        $vnp_Amount = isset($postData['amount']) ? $postData['amount'] : 0;
        $vnp_Locale = isset($postData['language']) ? $postData['language'] : 'vn';
        $vnp_BankCode = isset($postData['bankCode']) ? $postData['bankCode'] : '';
        $vnp_IpAddr = $ipAddr;

        // Sử dụng các biến cấu hình từ config/Global.php

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => VNP_TMN_CODE,
            "vnp_Amount" => $vnp_Amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => VNP_RETURN_URL,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => VNP_EXPIRE
        );

        if (!empty($vnp_BankCode)) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        // sắp xếp theo key và build chuỗi
        ksort($inputData);
        $queryParts = array();
        $hashdata = '';
        $first = true;
        foreach ($inputData as $key => $value) {
            $encodedKey = urlencode($key);
            $encodedValue = urlencode($value);
            $queryParts[] = $encodedKey . '=' . $encodedValue;
            if ($first) {
                $hashdata .= $encodedKey . '=' . $encodedValue;
                $first = false;
            } else {
                $hashdata .= '&' . $encodedKey . '=' . $encodedValue;
            }
        }

        $query = implode('&', $queryParts);

        // Tạo secure hash
        $vnpSecureHash = '';
       if (defined("VNP_HASH_SECRET") && VNP_HASH_SECRET != '') {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, VNP_HASH_SECRET);
        }
        // Tạo URL hoàn chỉnh
        $redirectUrl = VNP_URL . '?' . $query;
        if ($vnpSecureHash != '') {
            $redirectUrl .= '&vnp_SecureHash=' . $vnpSecureHash;
        }

        return $redirectUrl;
    }

    public function insertTransaction($data)
    {
        // Expect $data to contain: 'user_id', 'txn_ref' (or transaction_code), 'amount'
        $userId = isset($data['user_id']) ? $data['user_id'] : null;
        $txnRef = isset($data['txn_ref']) ? $data['txn_ref'] : (isset($data['transaction_code']) ? $data['transaction_code'] : null);
        $amount = isset($data['amount']) ? $data['amount'] : 0;

        if ($userId === null || $txnRef === null) {
            return ['success' => false, 'message' => 'Missing user_id or txn_ref'];
        }

        try {
            // Check if transaction_code already exists -> idempotent
            $check = $this->_connection->prepare("SELECT id FROM transactions WHERE transaction_code = :tx LIMIT 1");
            $check->execute([':tx' => $txnRef]);
            $exists = $check->fetch(PDO::FETCH_ASSOC);
            if ($exists) {
                // Already processed: return current balance so caller can update UI but not double-add
                $balStmt = $this->_connection->prepare("SELECT balance FROM users WHERE id = :id LIMIT 1");
                $balStmt->execute([':id' => $userId]);
                $brow = $balStmt->fetch(PDO::FETCH_ASSOC);
                $currentBalance = $brow ? (float)$brow['balance'] : 0;
                return ['success' => true, 'already' => true, 'message' => 'Transaction already processed', 'new_balance' => $currentBalance];
            }

            // Start transaction
            $this->_connection->beginTransaction();

            // Lock user row and get current balance
            $select = $this->_connection->prepare("SELECT balance FROM users WHERE id = :id FOR UPDATE");
            $select->execute([':id' => $userId]);
            $row = $select->fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                $this->_connection->rollBack();
                return ['success' => false, 'message' => 'User not found'];
            }

            $currentBalance = (float)$row['balance'];
            $newBalance = $currentBalance + (float)$amount;

            // Insert transaction record into transactions table
            $insertSql = "INSERT INTO transactions (user_id, current_balance, amount, created_at, transaction_code) VALUES (:user_id, :current_balance, :amount, NOW(), :transaction_code)";
            $insert = $this->_connection->prepare($insertSql);
            $insert->execute([
                ':user_id' => $userId,
                ':current_balance' => $currentBalance,
                ':amount' => $amount,
                ':transaction_code' => $txnRef
            ]);

            // Update user's balance
            $update = $this->_connection->prepare("UPDATE users SET balance = :balance WHERE id = :id");
            $update->execute([':balance' => $newBalance, ':id' => $userId]);

            $this->_connection->commit();
            return ['success' => true, 'already' => false, 'message' => 'Inserted and updated', 'new_balance' => $newBalance];
        } catch (PDOException $e) {
            if ($this->_connection->inTransaction()) {
                $this->_connection->rollBack();
            }
            // Log error to file for debugging
            file_put_contents(__DIR__ . '/../Logs/VnPay.log', date('Y-m-d H:i:s') . " - insertTransaction error: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
            return ['success' => false, 'message' => 'DB error: ' . $e->getMessage()];
        }
    }
}

?>: