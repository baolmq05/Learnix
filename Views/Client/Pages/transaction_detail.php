<section class="bg-gray-50 min-h-screen">
    <header class="bg-white shadow-sm border-b no-print">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <button onclick="history.back()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <h1 class="text-2xl font-bold text-gray-900">Chi Tiết Giao Dịch</h1>
                </div>
                <a href="lich-su-giao-dich.html" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                    Quay Lại Lịch Sử
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-sm overflow-hidden max-w-2xl mx-auto">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-8 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold">Giao Dịch #TXN-001234</h2>
                        <p class="text-blue-100 mt-1">Nạp tiền vào ví</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                        <span class="font-semibold">Thành công</span>
                    </div>
                </div>
            </div>

            <div id="invoice-content" class="p-8 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <p class="text-sm text-gray-500">Ngày Giao Dịch</p>
                        <p class="text-xl font-bold text-gray-900">28/11/2025 14:30</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Số Tiền Nạp</p>
                        <p class="text-3xl font-bold text-green-600">500,000 VNĐ</p>
                        <p class="text-sm text-gray-500 mt-1">Số dư sau giao dịch: <strong>1,250,000 VNĐ</strong></p>
                    </div>
                </div>

                <div class="border-t pt-6">
                    <p class="text-sm text-gray-500 mb-3">Phương Thức Thanh Toán</p>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="bi bi-credit-card-2-front text-2xl text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-semibold">Thẻ Visa **** 1234</p>
                            <p class="text-sm text-gray-500">Ngân hàng Vietcombank</p>
                        </div>
                    </div>
                </div>

                <div class="border-t pt-6">
                    <p class="text-sm text-gray-500 mb-3">Mô Tả Giao Dịch</p>
                    <p class="text-gray-700 leading-relaxed">
                        Nạp tiền từ thẻ Visa để bổ sung số dư ví điện tử. Giao dịch đã được xử lý ngay lập tức và <strong>không phát sinh phí</strong>.
                    </p>
                </div>

                <div class="border-t pt-6">
                    <p class="text-sm text-gray-500 mb-4">Lịch Sử Trạng Thái</p>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div><span class="text-sm">Hoàn tất – 14:30, 28/11/2025</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div><span class="text-sm">Xác nhận – 14:29, 28/11/2025</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-2 h-2 bg-gray-400 rounded-full"></div><span class="text-sm">Khởi tạo – 14:28, 28/11/2025</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 pt-0 no-print">
                <div class="flex flex-col sm:flex-row gap-4 border-t pt-6">
                    <button id="downloadInvoice" class="flex-1 bg-green-600 text-white py-3 px-6 rounded-lg hover:bg-green-700 transition font-medium">
                        <i class="bi bi-download mr-2"></i> Tải Hóa Đơn PDF
                    </button>
                </div>
            </div>
        </div>
    </main>
</section>