<?php
// Trang thông báo thanh toán thành công
$txn = isset($_GET['txn']) ? htmlspecialchars($_GET['txn']) : '';
$userBalance = $_SESSION['client']['balance'] ?? 0;

function formatCurrency($amount)
{
    return number_format($amount, 0, ',', '.') . ' ₫';
}
?>

<div class="min-h-screen bg-gradient-to-br from-emerald-50 to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <!-- Success Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Header Success -->
            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 md:px-12 py-12 text-center">
                <div class="mb-4 flex justify-center">
                    <div class="rounded-full bg-white/20 p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Thanh toán thành công!</h1>
                <p class="text-emerald-50 text-lg">Bạn đã mua khóa học thành công. Hãy bắt đầu học ngay!</p>
            </div>

            <!-- Content -->
            <div class="px-6 md:px-12 py-10">
                <!-- Transaction Info -->
                <div class="mb-8 p-6 bg-slate-50 rounded-xl border border-slate-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-slate-600 font-medium mb-1">Mã giao dịch</p>
                            <p class="text-lg font-mono text-slate-900 break-all"><?= $txn ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-600 font-medium mb-1">Thời gian</p>
                            <p class="text-lg text-slate-900"><?= date('d/m/Y H:i:s') ?></p>
                        </div>
                    </div>
                </div>

                <!-- What's Next -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-slate-900 mb-4">Bước tiếp theo:</h2>
                    <div class="space-y-3">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 flex items-center justify-center h-8 w-8 rounded-lg bg-emerald-100">
                                <span class="text-emerald-700 font-bold text-sm">1</span>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">Truy cập khoá học</p>
                                <p class="text-sm text-slate-600">Vào mục "Khóa học của tôi" để xem danh sách khóa học đã mua</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 flex items-center justify-center h-8 w-8 rounded-lg bg-emerald-100">
                                <span class="text-emerald-700 font-bold text-sm">2</span>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">Bắt đầu học tập</p>
                                <p class="text-sm text-slate-600">Chọn khóa học và bắt đầu với bài học đầu tiên</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 flex items-center justify-center h-8 w-8 rounded-lg bg-emerald-100">
                                <span class="text-emerald-700 font-bold text-sm">3</span>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">Hoàn thành và nhận chứng chỉ</p>
                                <p class="text-sm text-slate-600">Sau khi hoàn thành khóa học, bạn sẽ nhận được chứng chỉ</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Balance Info -->
                <div class="mb-8 p-6 bg-blue-50 border border-blue-200 rounded-xl">
                    <div class="flex items-center gap-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-4a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd" />
                        </svg>
                        <p class="font-semibold text-blue-900">Số dư ví hiện tại</p>
                    </div>
                    <p class="text-2xl font-bold text-blue-700"><?= formatCurrency($userBalance) ?></p>
                    <p class="text-sm text-blue-600 mt-2">Bạn vẫn có thể sử dụng số dư này để mua thêm khóa học khác</p>
                </div>

                <!-- Actions -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="index.php?page=home" class="flex items-center justify-center gap-2 px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-900 font-semibold rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12a9 9 0 0118 0m-9 9a9 9 0 01-8.948-9.046" />
                        </svg>
                        Về trang chủ
                    </a>
                    <a href="index.php?page=course_learning" class="flex items-center justify-center gap-2 px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C6.228 6.228 2 10.228 2 15s4.228 8.772 10 8.772c5.772 0 10-3.946 10-8.772 0-4.772-4.228-8.747-10-8.747z" />
                        </svg>
                        Khóa học của tôi
                    </a>
                </div>
            </div>
        </div>

        <!-- Info Box -->
        <div class="mt-8 p-6 bg-white rounded-lg shadow-md border-l-4 border-l-blue-500">
            <p class="text-slate-700 text-sm leading-relaxed">
                <strong>💡 Gợi ý:</strong> Nếu bạn có bất kỳ câu hỏi nào về khóa học hoặc cần hỗ trợ, vui lòng liên hệ với 
                <a href="?page=contact" class="text-blue-600 hover:underline">bộ phận hỗ trợ khách hàng</a> của chúng tôi.
            </p>
        </div>
    </div>
</div>
