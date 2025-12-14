<?php
require_once "Models/Transaction.php";

class TransactionController {
    private $transactionModel;

    public function __construct()
    {
        $this->transactionModel = new Transaction();
    }

    public function viewTransaction() {
        $userId = $_SESSION['client']['id'] ?? null;
        
        if (!$userId) {
            header('Location: index.php?page=login');
            exit();
        }

        // Lấy filter type từ URL (mặc định null = tất cả)
        $filterType = isset($_GET['type']) && $_GET['type'] !== '' ? (int)$_GET['type'] : null;
        
        // Phân trang
        $page = isset($_GET['p']) ? max(1, (int)$_GET['p']) : 1;
        $limit = 20;
        $offset = ($page - 1) * $limit;
        
        // Lấy danh sách transactions
        $transactions = $this->transactionModel->getTransactionsByUser($userId, $filterType, $limit, $offset);
        $totalTransactions = $this->transactionModel->countTransactionsByUser($userId, $filterType);
        $totalPages = ceil($totalTransactions / $limit);
        
        require 'Views/Client/Pages/transaction.php';
    }   
    
    public function viewTransactionDetail() {
        $userId = $_SESSION['client']['id'] ?? null;
        
        if (!$userId) {
            header('Location: index.php?page=login');
            exit();
        }
        
        $transactionId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if ($transactionId <= 0) {
            header('Location: index.php?page=transaction');
            exit();
        }
        
        $transaction = $this->transactionModel->getTransactionById($transactionId, $userId);
        
        if (!$transaction) {
            $_SESSION['error'] = 'Giao dịch không tồn tại.';
            header('Location: index.php?page=transaction');
            exit();
        }
        
        require 'Views/Client/Pages/transaction_detail.php';
    }
}
?>