<?php
require_once 'Models/VnPay.php';
require_once 'Config/Global.php';

class VnPayController
{
    private $vnPayModel;
    public function __construct()
    {
        $this->vnPayModel = new VnPay();
    }

    public function createPayment()
    {
        // Nhận dữ liệu POST và gọi model tạo URL thanh toán
        $postData = isset($_POST) ? $_POST : array();
        $ipAddr = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
        $redirectUrl = $this->vnPayModel->createPayment($postData, $ipAddr);
        if ($redirectUrl) {
            header('Location: ' . $redirectUrl);
            exit();
        } else {
            // Trường hợp lỗi đơn giản, load view lỗi hoặc home
            require_once 'Views/Client/Pages/home.php';
        }
    }
    public function vnpayReturn()
    {
        // xử lý dữ liệu trả về từ VNPAY (GET)
        $vnp_SecureHash = isset($_GET['vnp_SecureHash']) ? $_GET['vnp_SecureHash'] : '';
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

       $secureHash = hash_hmac('sha512', $hashData, VNP_HASH_SECRET);
        // Xử lý: nếu chữ ký hợp lệ và VNPAY trả về thành công, lưu transaction và cập nhật balance
        $processResult = ['success' => false, 'message' => 'Chưa xử lý'];
        if ($secureHash === $vnp_SecureHash) {
            $responseCode = isset($inputData['vnp_ResponseCode']) ? $inputData['vnp_ResponseCode'] : '';
            $txnStatus = isset($inputData['vnp_TransactionStatus']) ? $inputData['vnp_TransactionStatus'] : '';

            if ($responseCode === '00' && $txnStatus === '00') {
                $vnp_Amount = isset($inputData['vnp_Amount']) ? $inputData['vnp_Amount'] / 100 : 0;
                $txnRef = isset($inputData['vnp_TxnRef']) ? $inputData['vnp_TxnRef'] : null;

                // Lấy user hiện tại từ session (nếu người dùng đang đăng nhập)
                $userId = isset($_SESSION['client']['id']) ? $_SESSION['client']['id'] : null;

                // Gọi model để insert transaction và cập nhật balance
                $insertResult = $this->vnPayModel->insertTransaction([
                    'user_id' => $userId,
                    'txn_ref' => $txnRef,
                    'amount' => $vnp_Amount,
                ]);

                if (is_array($insertResult) && isset($insertResult['success']) && $insertResult['success']) {
                    // Update session balance to the authoritative value returned by model
                    if (isset($insertResult['new_balance'])) {
                        if (isset($_SESSION['client'])) {
                            $_SESSION['client']['balance'] = $insertResult['new_balance'];
                        }
                    }

                    if (!empty($insertResult['already'])) {
                        $processResult = ['success' => true, 'message' => 'Giao dịch đã được xử lý trước đó', 'amount' => $vnp_Amount];
                    } else {
                        $processResult = ['success' => true, 'message' => 'Nạp tiền thành công', 'amount' => $vnp_Amount, 'new_balance' => $insertResult['new_balance']];
                    }
                } else {
                    $msg = is_array($insertResult) && isset($insertResult['message']) ? $insertResult['message'] : 'Lưu giao dịch thất bại';
                    $processResult = ['success' => false, 'message' => $msg];
                }
            } else {
                $processResult = ['success' => false, 'message' => 'Giao dịch không thành công (mã trả về: ' . $responseCode . ')'];
            }
        } else {
            $processResult = ['success' => false, 'message' => 'Chữ ký không hợp lệ'];
        }

        require_once 'Views/Client/Pages/vnpayReturn.php';
    }

    public function vnpayIpn()
    {
        // xử lý IPN: trả về JSON cho VNPAY
        global $vnp_HashSecret;
        $inputData = array();
        $returnData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = isset($inputData['vnp_SecureHash']) ? $inputData['vnp_SecureHash'] : '';
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $vnpTranId = isset($inputData['vnp_TransactionNo']) ? $inputData['vnp_TransactionNo'] : null;
        $vnp_BankCode = isset($inputData['vnp_BankCode']) ? $inputData['vnp_BankCode'] : null;
        $vnp_Amount = isset($inputData['vnp_Amount']) ? $inputData['vnp_Amount'] / 100 : 0;

        $Status = 0;
        $orderId = isset($inputData['vnp_TxnRef']) ? $inputData['vnp_TxnRef'] : null;

        try {
            if ($secureHash == $vnp_SecureHash) {
                // NOTE: ở đây cần kiểm tra DB để xác thực order thực sự tồn tại
                // hiện tại giả sử không có order
                $order = NULL;
                if ($order != NULL) {
                    if ($order["Amount"] == $vnp_Amount) {
                        if ($order["Status"] != NULL && $order["Status"] == 0) {
                            if ($inputData['vnp_ResponseCode'] == '00' && $inputData['vnp_TransactionStatus'] == '00') {
                                $Status = 1;
                            } else {
                                $Status = 2;
                            }
                            $returnData['RspCode'] = '00';
                            $returnData['Message'] = 'Confirm Success';
                        } else {
                            $returnData['RspCode'] = '02';
                            $returnData['Message'] = 'Order already confirmed';
                        }
                    } else {
                        $returnData['RspCode'] = '04';
                        $returnData['Message'] = 'invalid amount';
                    }
                } else {
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = 'Order not found';
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Invalid signature';
            }
        } catch (Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
        }

        header('Content-Type: application/json');
        echo json_encode($returnData);
        exit();
    }


}