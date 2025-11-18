<?php ?>
<div class="max-w-screen-2xl mx-auto px-4 py-8">
  <?php
    $stats = [
      'courses' => 12,
      'students' => 14250,
      'revenue' => 12500000, 
    ];
  ?>

  <header class="mb-6">
    <h1 class="text-2xl font-semibold text-gray-900">Thống kê giảng viên</h1>
    <p class="text-sm text-gray-500 mt-1">Tổng quan nhanh về hiệu suất các khóa học của bạn</p>
  </header>

  <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white border rounded-lg p-5 shadow-sm">
      <div class="flex items-start gap-4">
        <div class="bg-indigo-50 text-indigo-600 p-3 rounded-full">
          <i class="bi bi-journals"></i>
        </div>
        <div class="flex-1">
          <div class="text-sm text-gray-500">Tổng số khóa học</div>
          <div class="mt-1 text-2xl font-bold text-gray-900"><?= number_format($stats['courses']) ?></div>
          <div class="mt-2 text-xs text-gray-400">Khóa học đang hoạt động / đã xuất bản</div>
        </div>
      </div>
    </div>

    <div class="bg-white border rounded-lg p-5 shadow-sm">
      <div class="flex items-start gap-4">
        <div class="bg-green-50 text-green-600 p-3 rounded-full">
          <i class="bi bi-person-circle"></i>
        </div>
        <div class="flex-1">
          <div class="text-sm text-gray-500">Tổng số học viên</div>
          <div class="mt-1 text-2xl font-bold text-gray-900"><?= number_format($stats['students']) ?></div>
          <div class="mt-2 text-xs text-gray-400">Số học viên đã đăng ký vào tất cả các khóa học</div>
        </div>
      </div>
    </div>

    <div class="bg-white border rounded-lg p-5 shadow-sm">
      <div class="flex items-start gap-4">
        <div class="bg-yellow-50 text-yellow-600 p-3 rounded-full">
          <i class="bi bi-wallet"></i>
        </div>
        <div class="flex-1">
          <div class="text-sm text-gray-500">Tổng doanh thu</div>
          <div class="mt-1 text-2xl font-bold text-gray-900"><?= number_format($stats['revenue'], 0, ',', '.') ?> ₫</div>
          <div class="mt-2 text-xs text-gray-400">Tổng doanh thu từ tất cả khóa học (chưa trừ chi phí)</div>
        </div>
      </div>
    </div>
  </section>

  <section class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white border rounded-lg p-5 shadow-sm">
      <h2 class="text-lg font-semibold">Doanh thu theo tháng </h2>
      <p class="text-sm text-gray-500 mt-1">Biểu đồ tạm thời</p>
      <div class="mt-4 h-56 bg-gray-50 rounded border flex items-center justify-center text-gray-400">Biểu đồ</div>
    </div>

    <aside class="bg-white border rounded-lg p-5 shadow-sm">
      <h3 class="text-md font-semibold">Tổng quan nhanh</h3>
      <ul class="mt-3 space-y-3 text-sm text-gray-600">
        <li class="flex justify-between"><span>Khóa học mới trong 30 ngày</span><span class="font-medium">2</span></li>
        <li class="flex justify-between"><span>Học viên mới (30 ngày)</span><span class="font-medium">1,200</span></li>
        <li class="flex justify-between"><span>Doanh thu (30 ngày)</span><span class="font-medium">1,250,000 ₫</span></li>
      </ul>
      <div class="mt-4">
        <a href="index.php?page=teacher" class="inline-block w-full text-center bg-blue-600 text-white px-4 py-2 rounded">Quản lý khóa học</a>
      </div>
    </aside>
  </section>
</div>
