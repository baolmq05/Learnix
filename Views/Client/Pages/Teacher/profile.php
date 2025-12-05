<?php
$danger = $_SESSION['updateUser_error'] ?? null;
unset($_SESSION['updateUser_error']);
?>
<div class="max-w-screen-2xl mx-auto px-4 py-8">
  <?php if (!empty($danger)): ?>
    <div id="alert_success"
      class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg flex items-center gap-3 mb-4"
      role="alert">
      <!-- Icon X -->
      <svg class="w-5 h-5 flex-shrink-0 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
      </svg>

      <div class="flex-1">
        <?= $danger ?>
      </div>
    </div>
  <?php endif; ?>
  <div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg p-6 ">
      <div class="flex items-start gap-6">

        <img src="Uploads/Avatar/<?= htmlspecialchars($teacher['avatar'] ?? '') ?>"
          alt="<?= htmlspecialchars($teacher['name'] ?? '') ?>" class="w-28 h-28 object-cover rounded-full" />

        <div class="flex-1">
          <div class="flex items-start justify-between">
            <div>
              <h1 class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($teacher['name'] ?? '') ?></h1>
              <div class="text-sm text-gray-500 mt-1">
                <?= $teacher['information'] ?? '' ?>
              </div>
              <div class="mt-3 text-sm text-gray-600 space-y-1">
                <div><strong>Email:</strong> <?= htmlspecialchars($teacher['email'] ?? '') ?></div>
                <div><strong>Tham gia từ:</strong>
                  <?= (!empty($teacher['created_at']) ? date('d/m/Y', strtotime($teacher['created_at'])) : '') ?></div>
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
              <div class="text-xl font-bold text-green-600"><?= number_format($teacher['balance'], 0, ',', '.') ?> ₫
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-6 flex gap-3">
        <a href="#" class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Nạp ví</a>
        <a href="index.php?page=teacher&action=withdraw&id=<?= $teacher['id'] ?>"
          class="inline-block bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded">Rút tiền</a>
        <a href="index.php?page=teacher&action=editProfile&id=<?= $teacher['id'] ?>"
          class="inline-block border border-gray-300 text-gray-700 px-4 py-2 rounded">Chỉnh sửa</a>
      </div>
    </div>
  </div>
</div>