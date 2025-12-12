<?php
/** @var array $withDraw */
?>
<?php
$error = $_SESSION['error'] ?? [];
unset($_SESSION['error']);
?>
<?php
$success = $_SESSION['withdraw_success'] ?? null;
unset($_SESSION['withdraw_success']);

$danger = $_SESSION['withdraw_error'] ?? null;
unset($_SESSION['withdraw_error']);
?>
<div class="max-w-5xl mx-auto my-14 p-8 bg-gray-50 shadow-lg rounded-2xl border border-gray-200">
    <?php if (!empty($success)): ?>
        <div id="alert_success"
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center mb-4"
            role="alert">
            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414L9 13.414l4.707-4.707z"
                    clip-rule="evenodd" />
            </svg>
            <div>
                <?= $success ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if (!empty($danger)): ?>
        <div id="alert_success"
            class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg flex items-center gap-3 mb-4"
            role="alert">
            <div class="flex-1">
                <?= $danger ?>
            </div>
        </div>
    <?php endif; ?>
    <a href="index.php?page=teacher&action=profile"
        class="inline-flex items-center text-gray-600 hover:text-gray-800 text-sm font-medium mb-2">
        <!-- Icon mũi tên trái -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Quay lại Profile
    </a>
    <h2 class="text-3xl font-semibold text-gray-800 mb-8 pb-3 border-b">
        Yêu Cầu Rút Tiền Thù Lao 
    </h2>
    <form action="index.php?page=teacher&action=withDrawRequest" method="POST">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8 p-6 bg-white rounded-xl shadow-sm border border-gray-100 mb-4">
                <div class="relative">
                    <input type="number" name="amount" value="10000" placeholder="Nhập số tiền"
                        class="w-full pr-20 pl-4 py-3 rounded-lg border border-gray-300 bg-gray-50 text-xl text-gray-800 shadow-inner focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 hover:border-gray-400 transition">
                    <span
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-base font-medium text-gray-600">
                        VNĐ
                    </span>

                    <div class="mt-1">
                        <small class="text-red-500"><?= $error['amount'] ?? '' ?></small>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-indigo-600 mb-3">2. Thông Tin Ngân Hàng Nhận</h3>
                    <div class="space-y-4 mb-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-600 mb-1">Chủ Tài Khoản</label>
                            <input type="text" name="account_name"
                                value="<?= $withDraw['account_name'] ?? 'Vui lòng về trang cá nhân để cập nhật thông tin ngân hàng' ?>"
                                readonly
                                class="w-full p-3 rounded-lg border border-gray-300 bg-gray-100 text-gray-800 shadow-inner focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-600 mb-1">Tên Ngân Hàng</label>
                                <input type="text" name="bank_name"
                                    value="<?= $withDraw['bank_name'] ?? 'Vui lòng về trang cá nhân để cập nhật thông tin ngân hàng' ?>"
                                    readonly
                                    class="w-full p-3 rounded-lg border border-gray-300 bg-gray-100 text-gray-800 shadow-inner focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-600 mb-1">Số Tài Khoản</label>
                                <input type="text" name="bank_number"
                                    value="<?= $withDraw['bank_number'] ?? 'Vui lòng về trang cá nhân để cập nhật thông tin ngân hàng' ?>"
                                    readonly
                                    class="w-full p-3 rounded-lg border border-gray-300 bg-gray-100 text-gray-800 shadow-inner focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="lg:col-span-1 space-y-6">
                <div class="p-5 rounded-xl bg-white shadow-sm border border-gray-200">
                    <p class="text-xs font-medium text-gray-500">SỐ DƯ HIỆN TẠI</p>
                    <p class="text-3xl font-semibold text-gray-800 mt-2">
                        <?= number_format($withDraw['balance'] ?? 0) ?><span class="text-lg ml-1">VNĐ</span>
                    </p>
                    <input type="hidden" name="current_balance" value="<?= $withDraw['balance'] ?? 0 ?>">
                </div>
                <p class="text-xs text-yellow-700 bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                    ⚠️ Yêu cầu xử lý thủ công, tiền sẽ về trong 1-3 ngày làm việc.
                </p>
                <p class="text-xs text-yellow-700 bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                    ⚠️ Nếu bạn đã gửi yêu cầu mà admin chưa duyệt, bạn không thể gửi thêm yêu cầu mới..
                </p>
                <p class="text-xs text-yellow-700 bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                    ⚠️ Nếu sai hoặc chưa có thông tin ngân hàng vui lòng trờ về trang cá nhân để cập nhật lại.
                </p>
                <button
                    class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-3 rounded-lg text-base transition shadow">
                    Gửi Yêu Cầu Rút Tiền
                </button>

                <a href="index.php?page=teacher&action=profile"
                    class="block text-center mt-2 text-gray-500 hover:text-gray-700 text-sm">
                    Hủy Bỏ
                </a>
            </div>
        </div>
    </form>
</div>