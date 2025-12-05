<?php
require_once 'Models/WithDraw.php';
class WithDrawController
{
    private $_withDraw;
    public function __construct()
    {
        $this->_withDraw = new WithDraw();
    }

    public function viewIndex()
    {
        $withDrawRequestsStatus0 = $this->_withDraw->getAllWithdrawRequests($status = 0);
        $withDrawRequestsStatus1 = $this->_withDraw->getAllWithdrawRequests($status = 1);
        $withDrawRequestsStatus2 = $this->_withDraw->getAllWithdrawRequests($status = 2);

        // hiển thị số lượng yêu cầu rút tiền chờ duyệt
        $count0 = $this->_withDraw->countPendingRequests(0);
        $count1 = $this->_withDraw->countPendingRequests(1);
        $count2 = $this->_withDraw->countPendingRequests(2);
        include "./Views/Admin/Pages/WithDraw/index.php";
    }

    public function accept()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['error'] = "Không tìm thấy yêu cầu rút tiền";
            header("Location: admin.php?page=withdraw");
            exit;
        }

        $withdrawId = $_GET['id'];

        // Chấp nhận yêu cầu rút tiền
        $success = $this->_withDraw->approveWithdrawRequest($withdrawId);

        if ($success) {
            $_SESSION['withDraw_success'] = "Đã chấp nhận yêu cầu rút tiền thành công";
            header("Location: admin.php?page=withdraw");
            exit;
        }

    }

    public function reject()
    {
        if (!isset($_GET['id']) || !isset($_POST['reason'])) {
            $_SESSION['withDraw_success'] = "Không tìm thấy yêu cầu rút tiền hoặc lý do từ chối";
            header("Location: admin.php?page=withdraw");
            exit;
        }

        $withdrawId = $_GET['id'];
        $reason = $_POST['reason'];

        // Từ chối yêu cầu rút tiền
        $success = $this->_withDraw->rejectWithdrawRequest($withdrawId, $reason);

        if ($success) {
            $_SESSION['withDraw_reject'] = "Đã từ chối yêu cầu rút tiền";
            header("Location: admin.php?page=withdraw");
            exit;
        }
    }


}
