<?php 

// hiển thị lỗi mật khẩu không đúng



?>
<div class="max-w-3xl mx-auto my-10 p-8 r">
  <header class="pb-4 mb-6 border-b border-gray-200">
    <h2 class="text-3xl font-extrabold text-black">
      Chỉnh Sửa Hồ Sơ Học Viên
    </h2>
    <p class="text-sm text-gray-500 mt-1">
      Cập nhật thông tin cá nhân của bạn
    </p>
  </header>

  <?php if (!isset($old) || !is_array($old)) { $old = []; } ?>

  <form action="?page=profile_edit&action=updateUserProfile" method="POST" enctype="multipart/form-data"
    class="space-y-6">
    <input type="hidden" name="id" value="<?= htmlspecialchars($student['id'] ?? '') ?>" />
    <div class="flex flex-col items-center space-y-4 pb-4 border-b border-gray-100">
      <img id="avatarPreview" src="<?= 'Uploads/Avatar/' . htmlspecialchars($student['avatar'] ?? 'default.webp') ?>" alt="Avatar"
        class="w-28 h-28 rounded-full object-cover shadow-lg ring-4 ring-gray-100" />
      <label class="mt-2 text-sm text-blue-600 font-medium hover:text-blue-700 transition flex items-center gap-3">
        <span>Thay đổi ảnh đại diện</span>
        <input id="avatarInput" type="file" name="avatar" accept="image/*" class="hidden" />
      </label>
      <?php if (!empty($errors['avatar'])): ?>
        <small class="text-sm text-red-600 mt-2"><?= htmlspecialchars($errors['avatar']) ?></small>
      <?php endif; ?>
    </div>

    <div class="space-y-4">
      <h3 class="text-xl font-bold text-black border-b pb-2 mb-4">
        Thông tin Cá nhân
      </h3>

      <div>
        <label for="name" class="block text-sm font-medium text-black mb-1">Họ và Tên</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($old['name'] ?? $student['name'] ?? '') ?>"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg text-black" />
        <?php if (!empty($errors['name'])): ?>
          <small class="text-sm text-red-600 mt-1"><?= htmlspecialchars($errors['name']) ?></small>
        <?php endif; ?>
      </div>
    </div>

    <div class="space-y-4 pt-4">
      <div>
        <label for="email" class="block text-sm font-medium text-black mb-1">Email</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($old['email'] ?? $student['email'] ?? '') ?>"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg text-black" />
        <?php if (!empty($errors['email'])): ?>
          <small class="text-sm text-red-600 mt-1"><?= htmlspecialchars($errors['email']) ?></small>
        <?php endif; ?>
      </div>
      <div id="password-section" class="space-y-4 pt-4">
        <p class="font-medium ">Cập nhật mật khẩu:</p>
        <p class="text-sm text-gray-500">Vui lòng để trống nếu không muốn thay đổi mật khẩu</p>
        <div>
          <label for="current-password" class="block text-sm font-medium text-black mb-1">Mật khẩu hiện tại</label>
          <input type="password" id="current-password" name="current-password" placeholder="Nhập mật khẩu hiện tại"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 text-black" />
          <?php if (!empty($errors['current_password'])): ?>
            <small class="text-sm text-red-600 mt-1"><?= htmlspecialchars($errors['current_password']) ?></small>
          <?php endif; ?>
        </div>
        <div>
          <label for="new-password" class="block text-sm font-medium text-black mb-1">Mật khẩu mới</label>
          <input type="password" id="new-password" name="new-password" placeholder="Nhập mật khẩu mới"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 text-black" />
          <?php if (!empty($errors['new_password'])): ?>
            <small class="text-sm text-red-600 mt-1"><?= htmlspecialchars($errors['new_password']) ?></small>
          <?php endif; ?>
        </div>
        <div>
          <label for="confirm-password" class="block text-sm font-medium text-black mb-1">Nhập lại mật khẩu</label>
          <input type="password" id="confirm-password" name="confirm-password" placeholder="Xác nhận mật khẩu mới"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 text-black" />
          <?php if (!empty($errors['confirm_password'])): ?>
            <small class="text-sm text-red-600 mt-1"><?= htmlspecialchars($errors['confirm_password']) ?></small>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
      <a href="/index.php?page=profile"
        class="px-6 py-2 bg-gray-200 text-black font-semibold rounded-lg hover:bg-gray-300 transition shadow-md">
        Hủy
      </a>
      <button type="submit"
        class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition shadow-md">
        Lưu Thay Đổi
      </button>
    </div>
  </form>
</div>

  <script>
  // Avatar preview behavior (mirror of Teacher editProfile)
  (function () {
    const input = document.getElementById('avatarInput');
    const preview = document.getElementById('avatarPreview');
    if (!input || !preview) return;

    let currentObjectUrl = null;

    // If the label is clicked, trigger the hidden input
    const label = input.closest('label');
    if (label) {
      label.addEventListener('click', function (e) {
        // allow native file picker
      });
    }

    input.addEventListener('change', function (e) {
      const file = input.files && input.files[0];
      if (!file) return;
      if (!file.type.startsWith('image/')) return;

      if (currentObjectUrl) {
        URL.revokeObjectURL(currentObjectUrl);
        currentObjectUrl = null;
      }

      const objectUrl = URL.createObjectURL(file);
      currentObjectUrl = objectUrl;
      preview.src = objectUrl;

      preview.onload = function () {
        if (currentObjectUrl) {
          URL.revokeObjectURL(currentObjectUrl);
          currentObjectUrl = null;
        }
      };
    });
  })();
</script>