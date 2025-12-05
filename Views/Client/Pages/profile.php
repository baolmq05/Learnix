<?php

$student['completed_courses'] = [
  [
    'id' => 101,
    'title' => 'Lập trình PHP và MySQL cơ bản',
    'image' => 'https://picsum.photos/seed/php/100/100', // Hình ảnh giả lập
    'updated_at' => '2023-11-15',
    'status' => '1' // Trạng thái hoàn thành (từ DB)
  ],
  [
    'id' => 102,
    'title' => 'Thiết kế giao diện với Tailwind CSS',
    'image' => 'https://picsum.photos/seed/tailwind/100/100',
    'updated_at' => '2023-10-28',
    'status' => '1'
  ],
  [
    'id' => 103,
    'title' => 'Kỹ năng làm việc nhóm hiệu quả',
    'image' => 'https://picsum.photos/seed/teamwork/100/100',
    'updated_at' => '2023-09-01',
    'status' => '1'
  ],
  [
    'id' => 104,
    'title' => 'Giới thiệu về Trí tuệ Nhân tạo (AI)',
    'image' => 'https://picsum.photos/seed/ai/100/100',
    'updated_at' => '2023-08-10',
    'status' => '1'
  ]
];

?>
<?php
$success = $_SESSION['update_success'] ?? '';
unset($_SESSION['update_success']);
?>
<?php if (!empty($success)): ?>
  <div id="alert_success" class="flex items-center w-full p-4 mb-4 text-green-800 bg-green-100 rounded-lg z-99" role="alert">
    <div>
      <?= $success ?>
    </div>
  </div>
<?php endif ?>
<div class="max-w-5xl mx-auto p-8 rounded-2xl">
  <div class="border-b border-gray-200 pb-6 mb-6">
    <div class="flex flex-col lg:flex-row lg:items-center justify-center lg:space-x-8">
      <div class="flex justify-center w-full lg:w-auto">
        <img src="<?= 'Uploads/Avatar/' . htmlspecialchars($student['avatar'] ?? 'default.webp') ?>" alt="Avatar"
          class="w-32 h-32 rounded-full object-cover shadow-lg" />
      </div>
      <div class="flex flex-col justify-center text-center lg:text-left pt-4 lg:pt-0">
        <h1 class="text-4xl font-extrabold text-black leading-none">
          <?= htmlspecialchars($student['name'] ?? '') ?>
        </h1>
        <p class="text-base text-black mt-0"><?= htmlspecialchars($student['email'] ?? '') ?></p>

        <div class="flex flex-wrap gap-4 mt-3 justify-center lg:justify-start text-sm">
          <span class="bg-gray-100 text-black px-3 py-1 rounded-full font-medium shadow-sm">
            Số dư: <span
              class="font-bold"><?= isset($student['balance']) ? number_format($student['balance'], 0, ',', '.') : '0' ?></span>
          </span>
          <span class="bg-gray-100 text-black px-3 py-1 rounded-full font-medium shadow-sm">
            Khóa học đang học: <span
              class="font-bold"><?= isset($student['enrolled_courses']) ? $student['enrolled_courses'] : '0' ?></span>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-6">
      <h3 class="text-2xl font-bold text-black border-b pb-2">
        Khóa học đã hoàn thành
      </h3>
      <ul class="space-y-4">
        <?php if (!empty($student['completed_courses'])): ?>
          <?php foreach ($student['completed_courses'] as $course): ?>
            <li
              class="p-4 bg-gray-50 border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex items-center gap-4">
              <a href="?page=course_detail&id=<?= htmlspecialchars($course['id']) ?>">
                <img src="<?= htmlspecialchars($course['image'] ?? '') ?>" class="w-16 h-16 rounded-md object-cover" />
              </a>
              <div>
                <a href="?page=course_detail&id=<?= htmlspecialchars($course['id']) ?>">
                  <p class="font-bold text-lg text-black"><?= htmlspecialchars($course['title'] ?? 'Khóa học') ?></p>
                </a>
                <p class="text-sm text-black mt-1">Hoàn thành: <?= htmlspecialchars($course['updated_at'] ?? '') ?></p>
              </div>
            </li>
          <?php endforeach; ?>
        <?php endif; ?>
      </ul>
    </div>
    <div class="lg:col-span-1 space-y-6">
      <div class="flex gap-3">
        <a href="?page=recharge"
          class="flex-1 px-2 py-3 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition shadow-md text-center">
          Nạp thêm
        </a>
        <a href="#" class="flex-1 items-center justify-center text-nowrap gap-2 px-4 py-3 
         bg-red-600 text-white font-semibold rounded-xl 
         hover:bg-red-700 transition shadow-md">
          Lịch sử giao dịch
        </a>
      </div>
      <div class="grid grid-cols-1">
        <a href="/index.php?page=profile_edit&id=<?= $student['id'] ?>"
          class="flex-1 px-2 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition shadow-md text-center">
          Chỉnh sửa
        </a>
      </div>
    </div>
  </div>
</div>