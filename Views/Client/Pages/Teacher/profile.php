<?php ?>
<div class="max-w-screen-2xl mx-auto px-4 py-8">
  <?php
    // Sample teacher data - replace with DB query for the logged-in teacher
    $teacher = [
      'id' => 1,
      'name' => 'Phan Văn Tính',
      'email' => 'phan.tinh@example.com',
      'phone' => '+84 912 345 678',
      'bio' => "Giảng viên thiết kế web & front-end với hơn 8 năm kinh nghiệm. Chuyên về HTML, CSS, Tailwind và UX.",
      'location' => 'Hà Nội, Việt Nam',
      'joined' => '2021-05-10',
      'avatar' => '', // optional avatar url
      'courses' => 12,
      'students' => 14250,
      'rating' => 4.8,
      'wallet' => 2550000, // in VND
    ];
  ?>

  <div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg p-6 ">
      <div class="flex items-start gap-6">
        <?php if(!empty($teacher['avatar'])): ?>
          <img src="<?= htmlspecialchars($teacher['avatar']) ?>" alt="<?= htmlspecialchars($teacher['name']) ?>" class="w-28 h-28 object-cover rounded-full" />
        <?php else: ?>
          <div class="w-28 h-28 rounded-full bg-gray-100 flex items-center justify-center text-2xl font-semibold text-gray-700">
            <?= htmlspecialchars(strtoupper(mb_substr($teacher['name'],0,1))) ?>
          </div>
        <?php endif; ?>

        <div class="flex-1">
          <div class="flex items-start justify-between">
            <div>
              <h1 class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($teacher['name']) ?></h1>
              <p class="text-sm text-gray-500 mt-1"><?= htmlspecialchars($teacher['bio']) ?></p>
              <div class="mt-3 text-sm text-gray-600 space-y-1">
                <div><strong>Email:</strong> <?= htmlspecialchars($teacher['email']) ?></div>
                <div><strong>Điện thoại:</strong> <?= htmlspecialchars($teacher['phone']) ?></div>
                <div><strong>Địa chỉ:</strong> <?= htmlspecialchars($teacher['location']) ?></div>
                <div><strong>Tham gia từ:</strong> <?= date('d/m/Y', strtotime($teacher['joined'])) ?></div>
              </div>
            </div>

            <div class="hidden sm:flex sm:flex-col sm:items-end sm:gap-2">
              <div class="text-sm text-gray-500">Đánh giá</div>
              <div class="text-lg font-semibold text-yellow-500 flex items-center gap-2">
                <span><?= $teacher['rating'] ?></span>
                <i class="bi bi-star-fill"></i>
              </div>
            </div>
          </div>

          <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-gray-50 border rounded p-3 text-center">
                <i class="bi bi-book text-lg"></i>
              <div class="text-sm text-gray-500">Khóa học</div>
              <div class="text-xl font-bold text-blue-600"><?= number_format($teacher['courses']) ?></div>
            </div>
            <div class="bg-gray-50 border rounded p-3 text-center">
                <i class="bi bi-people text-lg"></i>
              <div class="text-sm text-gray-500">Học viên</div>
              <div class="text-xl font-bold text-yellow-600"><?= number_format($teacher['students']) ?></div>
            </div>
            <div class="bg-gray-50 border rounded p-3 text-center">
                <i class="bi bi-wallet text-lg"></i>
              <div class="text-sm text-gray-500">Số dư ví</div>
              <div class="text-xl font-bold text-green-600"><?= number_format($teacher['wallet'], 0, ',', '.') ?> ₫</div>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-6 flex gap-3">
        <a href="#" class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Nạp ví</a>
        <a href="index.php?page=teacher&action=editProfile&id=<?= $teacher['id'] ?>" class="inline-block border border-gray-300 text-gray-700 px-4 py-2 rounded">Chỉnh sửa</a>
      </div>
    </div>
  </div>
</div>
