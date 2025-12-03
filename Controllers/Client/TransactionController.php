<?php
class TransactionController {

    public function viewTransaction() {
        require 'Views/Client/Pages/transaction.php';
    }   
    public function viewTransactionDetail() {
        require 'Views/Client/Pages/transaction_detail.php';
    }
}