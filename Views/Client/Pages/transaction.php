<section class="bg-gray-50 min-h-screen">
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Search and Filter -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex flex-col sm:flex-row gap-4 items-center">
                <input type="text" placeholder="Tìm kiếm theo ID giao dịch..."
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                <select
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    <option>Tất cả trạng thái</option>
                    <option>Thành công</option>
                    <option>Đang xử lý</option>
                    <option>Thất bại</option>
                </select>
            </div>
        </div>

        <!-- Transaction Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày
                            Giao Dịch</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số
                            Tiền Nạp</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng
                            Thái</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hành
                            Động</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Row 1 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2025-11-28 14:30</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">500,000 VNĐ</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-success">Thành
                                công</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="index.php?page=transaction&action=detail" class="text-primary hover:text-blue-700">Chi tiết</a>
                        </td>
                    </tr>
                    <!-- Row 2 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2025-11-25 09:15</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">200,000 VNĐ</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-warning">Đang
                                xử lý</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="index.php?page=transaction&action=detail" class="text-primary hover:text-blue-700">Chi tiết</a>
                        </td>
                    </tr>
                    <!-- Row 3 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2025-11-20 16:45</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1,000,000 VNĐ</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-danger">Thất
                                bại</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="index.php?page=transaction&action=detail" class="text-primary hover:text-blue-700">Chi tiết</a>
                        </td>
                    </tr>
                </tbody>
            </table>
    </main>
</section>