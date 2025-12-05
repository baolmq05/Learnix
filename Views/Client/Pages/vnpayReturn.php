<?php

// Các biến cần thiết đã được truyền từ VnPayController::vnpayReturn() qua phạm vi global/include:
// 1. $secureHash: Chuỗi hash được tính toán lại từ dữ liệu GET.
// 2. $vnp_SecureHash: Chuỗi hash gốc nhận từ VNPAY qua GET.

$vnp_ResponseCode = isset($_GET['vnp_ResponseCode']) ? $_GET['vnp_ResponseCode'] : '';
$vnp_Amount = isset($_GET['vnp_Amount']) ? $_GET['vnp_Amount'] / 100 : 0;
$vnp_TxnRef = isset($_GET['vnp_TxnRef']) ? $_GET['vnp_TxnRef'] : '';
$vnp_OrderInfo = isset($_GET['vnp_OrderInfo']) ? $_GET['vnp_OrderInfo'] : '';
$vnp_BankCode = isset($_GET['vnp_BankCode']) ? $_GET['vnp_BankCode'] : 'N/A';
$vnp_PayDate = isset($_GET['vnp_PayDate']) ? $_GET['vnp_PayDate'] : '';

$isSuccess = false;
$message = "Giao dịch đang chờ xử lý hoặc không xác định.";

// Nếu controller đã truyền kết quả xử lý (idempotent result), ưu tiên dùng nó
$newBalance = null;
if (isset($processResult) && is_array($processResult)) {
    if (isset($processResult['success'])) {
        $isSuccess = $processResult['success'];
    }
    if (isset($processResult['message'])) {
        $message = $processResult['message'];
    }
    if (isset($processResult['new_balance'])) {
        $newBalance = $processResult['new_balance'];
    }
}

// 1. KIỂM TRA CHỮ KÝ BẢO MẬT
if ($secureHash === $vnp_SecureHash) {

    // 2. KIỂM TRA MÃ PHẢN HỒI VNPAY
    if ($vnp_ResponseCode == '00') {
        // Giao dịch thành công

        // !!! LƯU Ý QUAN TRỌNG:
        // Ở ĐÂY, BẠN CẦN THỰC HIỆN THAO TÁC CẬP NHẬT TRẠNG THÁI ĐƠN HÀNG VÀ CỘNG TIỀN VÀO TÀI KHOẢN NGƯỜI DÙNG
        // TRONG DATABASE ĐỂ ĐẢM BẢO CHÍNH XÁC.
        // Tuy nhiên, logic xử lý chính thức (cập nhật DB) NÊN được đặt trong hàm vnpayIpn()
        // để xử lý giao dịch đáng tin cậy hơn, còn trang này chỉ là thông báo cho người dùng.

        $isSuccess = true;
        $message = "Giao dịch nạp tiền thành công!";
    } else {
        // Giao dịch thất bại
        $message = "Giao dịch nạp tiền thất bại. Mã lỗi VNPAY: " . $vnp_ResponseCode;
    }
} else {
    // Sai chữ ký bảo mật (hash)
    $message = "Lỗi xác thực chữ ký bảo mật (Secure Hash). Vui lòng liên hệ hỗ trợ.";
}

// Hàm format tiền (ví dụ)
function formatCurrency($amount) {
    return number_format($amount, 0, ',', '.') . '₫';
}
?>

<div class="container mx-auto p-5 md:p-10">
    <div class="max-w-3xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden">
        <div class="p-6 text-center">
            <?php if ($isSuccess): ?>
                <div class="text-green-600 text-6xl mb-4">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h2 class="text-3xl font-bold text-green-600 mb-2">Thanh toán thành công!</h2>
                <p class="text-gray-600">Hệ thống đã ghi nhận giao dịch của bạn. Số dư sẽ sớm được cập nhật.</p>
            <?php else: ?>
                <div class="text-red-600 text-6xl mb-4">
                    <i class="fas fa-times-circle"></i>
                </div>
                <h2 class="text-3xl font-bold text-red-600 mb-2">Thanh toán thất bại!</h2>
                <p class="text-gray-600">Đã xảy ra lỗi trong quá trình xử lý giao dịch.</p>
            <?php endif; ?>
        </div>

        <div class="p-6 border-t border-gray-200">
            <h3 class="text-xl font-semibold mb-4 border-b pb-2">Chi tiết giao dịch</h3>
            <div class="grid grid-cols-2 gap-4 text-left">
                <p class="font-medium text-gray-700">Mã giao dịch:</p>
                <p class="text-gray-900 font-mono"><?= htmlspecialchars($vnp_TxnRef) ?></p>

                <p class="font-medium text-gray-700">Số tiền nạp:</p>
                <p class="text-lg font-bold <?= $isSuccess ? 'text-green-700' : 'text-red-700' ?>">
                    <?= formatCurrency($vnp_Amount) ?>
                </p>

                <p class="font-medium text-gray-700">Ngân hàng:</p>
                <p class="text-gray-900"><?= htmlspecialchars($vnp_BankCode) ?></p>

                <p class="font-medium text-gray-700">Nội dung:</p>
                <p class="text-gray-900"><?= htmlspecialchars($vnp_OrderInfo) ?></p>

                <p class="font-medium text-gray-700">Trạng thái:</p>
                <p class="text-gray-900 font-semibold"><?= htmlspecialchars($message) ?></p>
                <?php if (!is_null($newBalance)): ?>
                    <p class="font-medium text-gray-700">Số dư hiện tại:</p>
                    <p class="text-lg font-bold text-indigo-700"><?= formatCurrency($newBalance) ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="p-6 bg-gray-50 text-center">
            <a href="index.php?page=home" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-300 inline-flex items-center">
                <i class="fas fa-home mr-2"></i> Về trang chủ
            </a>
        </div>
    </div>
</div>