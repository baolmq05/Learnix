

    <?php
    if (!function_exists('formatCurrency')) {
        function formatCurrency($amount) {
            return number_format($amount, 0, ',', '.') . ' ₫';
        }
    }
    
    function getTypeLabel($type) {
        switch($type) {
            case 0: return ['label' => 'Nạp tiền', 'color' => 'bg-green-100 text-green-800'];
            case 1: return ['label' => 'Rút tiền', 'color' => 'bg-yellow-100 text-yellow-800'];
            case 2: return ['label' => 'Thanh toán', 'color' => 'bg-blue-100 text-blue-800'];
            default: return ['label' => 'Khác', 'color' => 'bg-gray-100 text-gray-800'];
        }
    }
    
    function getStatusLabel($status) {
        switch($status) {
            case 0: return ['label' => 'Chưa duyệt', 'color' => 'bg-gray-100 text-gray-800'];
            case 1: return ['label' => 'Đã duyệt', 'color' => 'bg-green-100 text-green-800'];
            case 2: return ['label' => 'Đã hủy', 'color' => 'bg-red-100 text-red-800'];
            default: return ['label' => 'Không rõ', 'color' => 'bg-gray-100 text-gray-800'];
        }
    }
    
    $currentFilter = isset($_GET['type']) && $_GET['type'] !== '' ? (int)$_GET['type'] : null;
    ?>

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Lịch sử giao dịch</h1>
            <p class="text-gray-600">Quản lý và theo dõi các giao dịch của bạn</p>
        </div>

        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px">
                    <a href="index.php?page=transaction" 
                       class="<?php echo $currentFilter === null ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'; ?> 
                              whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-colors">
                        Tất cả
                    </a>
                    <a href="index.php?page=transaction&type=0" 
                       class="<?php echo $currentFilter === 0 ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'; ?> 
                              whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-colors">
                        <span class="inline-flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z"/>
                            </svg>
                            Nạp tiền
                        </span>
                    </a>
                    <a href="index.php?page=transaction&type=1" 
                       class="<?php echo $currentFilter === 1 ? 'border-yellow-500 text-yellow-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'; ?> 
                              whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-colors">
                        <span class="inline-flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            Rút tiền
                        </span>
                    </a>
                    <a href="index.php?page=transaction&type=2" 
                       class="<?php echo $currentFilter === 2 ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'; ?> 
                              whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-colors">
                        <span class="inline-flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                            </svg>
                            Thanh toán
                        </span>
                    </a>
                </nav>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <?php if (empty($transactions)): ?>
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Chưa có giao dịch</h3>
                    <p class="mt-1 text-sm text-gray-500">Bạn chưa có giao dịch nào.</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã GD</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Loại</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số tiền</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số dư hiện tại</th>
                                <?php if ($currentFilter === 1): ?>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                                <?php endif; ?>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thời gian</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ghi chú</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($transactions as $txn): ?>
                                <?php 
                                $typeInfo = getTypeLabel($txn['type']);
                                $statusInfo = getStatusLabel($txn['status']);
                                $isPositive = in_array($txn['type'], [0]); // Nạp tiền là dương
                                ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            <?php echo htmlspecialchars($txn['transaction_code']); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $typeInfo['color']; ?>">
                                            <?php echo $typeInfo['label']; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold <?php echo $isPositive ? 'text-green-600' : 'text-red-600'; ?>">
                                            <?php echo ($isPositive ? '+' : '-') . formatCurrency(abs($txn['amount'])); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <?php echo formatCurrency($txn['current_balance']); ?>
                                        </div>
                                    </td>
                                    <?php if ($currentFilter === 1): ?>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $statusInfo['color']; ?>">
                                            <?php echo $statusInfo['label']; ?>
                                        </span>
                                    </td>
                                    <?php endif; ?>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">
                                            <?php echo date('d/m/Y H:i', strtotime($txn['created_at'])); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php $fullReason = trim($txn['reason'] ?? ''); ?>
                                        <?php if ($fullReason !== ''): ?>
                                        <button type="button"
                                                class="text-sm text-blue-600 hover:text-blue-800"
                                            data-reason="<?php echo htmlspecialchars($fullReason, ENT_QUOTES); ?>"
                                                onclick="openReasonModal(this)">
                                            Xem lý do
                                        </button>
                                        <?php else: ?>
                                        <div class="text-sm text-gray-500">-</div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <?php if ($page > 1): ?>
                                <a href="index.php?page=transaction<?php echo $currentFilter !== null ? '&type='.$currentFilter : ''; ?>&p=<?php echo $page - 1; ?>" 
                                   class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Trước
                                </a>
                            <?php endif; ?>
                            <?php if ($page < $totalPages): ?>
                                <a href="index.php?page=transaction<?php echo $currentFilter !== null ? '&type='.$currentFilter : ''; ?>&p=<?php echo $page + 1; ?>" 
                                   class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Sau
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Hiển thị <span class="font-medium"><?php echo $offset + 1; ?></span> đến 
                                    <span class="font-medium"><?php echo min($offset + $limit, $totalTransactions); ?></span> trong 
                                    <span class="font-medium"><?php echo $totalTransactions; ?></span> giao dịch
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                        <a href="index.php?page=transaction<?php echo $currentFilter !== null ? '&type='.$currentFilter : ''; ?>&p=<?php echo $i; ?>" 
                                           class="<?php echo $i === $page ? 'z-10 bg-blue-50 border-blue-500 text-blue-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'; ?> 
                                                  relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                            <?php echo $i; ?>
                                        </a>
                                    <?php endfor; ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <!-- Back button -->
        <div class="mt-6">
            <a href="index.php" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Quay lại trang chủ
            </a>
        </div>
    </div>
        <!-- Reason Modal (appended at end of body for highest stacking) -->
        <div id="reasonModal" class="fixed inset-0 bg-black bg-opacity-30 hidden items-center justify-center z-[1000]" role="dialog" aria-modal="true">
            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full mx-4">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Lý do hủy giao dịch</h3>
                </div>
                <div class="p-6">
                    <div id="reasonContent" class="text-gray-700 whitespace-pre-wrap break-words"></div>
                </div>
                <div class="px-6 py-4 border-t flex justify-end">
                    <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700" onclick="closeReasonModal()">Đóng</button>
                </div>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function(){
            function openReasonModal(el) {
                var reason = el.getAttribute('data-reason') || '';
                var contentEl = document.getElementById('reasonContent');
                var modal = document.getElementById('reasonModal');
                if (!modal || !contentEl) return;
                contentEl.textContent = reason;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('overflow-hidden');
            }
            function closeReasonModal() {
                var modal = document.getElementById('reasonModal');
                if (!modal) return;
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }
            window.openReasonModal = openReasonModal;
            window.closeReasonModal = closeReasonModal;

            try {
                document.querySelectorAll('[data-reason]').forEach(function(btn){
                    btn.addEventListener('click', function(e){
                        e.preventDefault();
                        openReasonModal(btn);
                    });
                });
            } catch(err) {
                console.warn('Reason modal binding error:', err);
            }

            document.addEventListener('click', function(e) {
                var modal = document.getElementById('reasonModal');
                if (!modal || modal.classList.contains('hidden')) return;
                var dialog = modal.querySelector('div.bg-white');
                if (dialog && !dialog.contains(e.target) && modal.contains(e.target)) {
                    closeReasonModal();
                }
            });
        });
        </script>
