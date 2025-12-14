<?php
$success = $_SESSION['login_success'] ?? '';
unset($_SESSION['login_success']);
?>
<?php if (!empty($success)): ?>
  <div id="alert_success" class="flex items-center w-full p-4 mb-4 text-green-800 bg-green-100 rounded-lg" role="alert">
    <div>
      <?= $success ?>
    </div>
  </div>
<?php endif ?>
<div class="max-w-3xl mx-auto px-4 py-8">
  <h1 class="text-2xl font-semibold mb-4">Chỉnh sửa hồ sơ</h1>
  <?php if (!isset($errors) || !is_array($errors)) {
    $errors = [];
  } ?>
  <?php if (!isset($old) || !is_array($old)) {
    $old = [];
  } ?>

  <?php if (!empty($errors['general'])): ?>
    <div class="mb-4 text-sm text-red-600"><?= htmlspecialchars($errors['general']) ?></div>
  <?php endif; ?>

  <form id="teacher-profile-form" action="?page=teacher&action=updateProfile" method="post"
    enctype="multipart/form-data" class="bg-white rounded-lg p-6">
    <input type="hidden" name="id" value="<?= $teacher['id'] ?>">

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
      <div class="col-span-1 flex flex-col self-start items-center">
          <img id="avatarPreview" src="<?= 'Uploads/Avatar/' . htmlspecialchars($teacher['avatar'] ?? 'default.webp') ?>" alt="avatar"
            class="w-40 h-40 md:w-48 md:h-48 object-cover rounded-full" />
        <label class="mt-3 text-sm text-blue-600 font-medium hover:text-blue-700 transition flex items-center gap-3 cursor-pointer">
          <span>Thay đổi ảnh đại diện</span>
          <input id="avatarInput" type="file" name="avatar" accept="image/*" class="hidden" />
        </label>
        <?php if (!empty($errors['avatar'])): ?>
          <small class="text-sm text-red-600 mt-1"><?= htmlspecialchars($errors['avatar']) ?></small>
        <?php endif; ?>
      </div>

      <div class="sm:col-span-2 grid grid-cols-1 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Họ và tên</label>
          <input type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? $teacher['name'] ?? '') ?>"
            class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" />
          <?php if (!empty($errors['name'])): ?>
            <small class="text-sm text-red-600 mt-1"><?= htmlspecialchars($errors['name']) ?></small>
          <?php endif; ?>
        </div>

        <div class="sm:col-span-2 grid grid-cols-1 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($old['email'] ?? $teacher['email'] ?? '') ?>"
              class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" />
            <?php if (!empty($errors['email'])): ?>
              <small class="text-sm text-red-600 mt-1"><?= htmlspecialchars($errors['email']) ?></small>
            <?php endif; ?>
          </div>
        </div>
        <div class="sm:col-span-2 grid grid-cols-1 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Thông tin</label>
            <textarea id="editor" name="information"
              placeholder="Mô tả..."><?= htmlspecialchars($old['information'] ?? $teacher['information'] ?? '') ?></textarea>
            <?php if (!empty($errors['information'])): ?>
              <small class="text-sm text-red-600 mt-1"><?= htmlspecialchars($errors['information']) ?></small>
            <?php endif; ?>
          </div>
        </div>
        <div class="sm:col-span-2 grid grid-cols-1 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Tên ngân hàng</label>
            <input type="text" name="bank_name"
              value="<?= htmlspecialchars($old['bank_name'] ?? $teacher['bank_name'] ?? '') ?>"
              class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" />
            <?php if (!empty($errors['bank_name'])): ?>
              <small class="text-sm text-red-600 mt-1"><?= htmlspecialchars($errors['bank_name']) ?></small>
            <?php endif; ?>
          </div>
        </div>
        <div class="sm:col-span-2 grid grid-cols-1 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Số tài khoản</label>
            <input type="text" name="bank_number"
              value="<?= htmlspecialchars($old['bank_number'] ?? $teacher['bank_number'] ?? '') ?>"
              class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" />
            <?php if (!empty($errors['bank_number'])): ?>
              <small class="text-sm text-red-600 mt-1"><?= htmlspecialchars($errors['bank_number']) ?></small>
            <?php endif; ?>
          </div>
        </div>
        <div class="sm:col-span-2 grid grid-cols-1 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Tên tài khoản</label>
            <input type="text" name="account_name"
              value="<?= htmlspecialchars($old['account_name'] ?? $teacher['account_name'] ?? '') ?>"
              class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" />
            <?php if (!empty($errors['account_name'])): ?>
              <small class="text-sm text-red-600 mt-1"><?= htmlspecialchars($errors['account_name']) ?></small>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-6">
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Lưu thay đổi</button>

    </div>
    <div id="password-panel" class="mt-4">
      <div class="p-4 rounded mt-2 ">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Mật khẩu hiện tại</label>
            <input type="password" name="current_password"
              class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
            <?php if (!empty($errors['current_password'])): ?>
              <small class="text-sm text-red-600 mt-1"><?= htmlspecialchars($errors['current_password']) ?></small>
            <?php endif; ?>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Mật khẩu mới</label>
            <input type="password" name="new_password"
              class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
            <?php if (!empty($errors['new_password'])): ?>
              <small class="text-sm text-red-600 mt-1"><?= htmlspecialchars($errors['new_password']) ?></small>
            <?php endif; ?>
          </div>
          <div class="sm:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Xác nhận mật khẩu mới</label>
            <input type="password" name="confirm_password"
              class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
            <?php if (!empty($errors['confirm_password'])): ?>
              <small class="text-sm text-red-600 mt-1"><?= htmlspecialchars($errors['confirm_password']) ?></small>
            <?php endif; ?>
          </div>
        </div>

        <div class="mt-4">
          <div class="text-sm text-gray-500">Nhập mật khẩu mới ở trên rồi nhấn "Lưu thay đổi" để cập nhật.</div>
          <div class="text-sm text-gray-500">Vui lòng để trống nếu không muốn đổi mật khẩu</div>
        </div>
      </div>
    </div>
  </form>

</div>
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script>
  ClassicEditor
    .create(document.querySelector('#editor'))
    .catch(error => {
      console.error(error);
    });
</script>
<script>
  // Avatar preview: when user selects a file, show it in the avatar image
  (function () {
    const input = document.getElementById('avatarInput');
    const preview = document.getElementById('avatarPreview');
    if (!input || !preview) return;

    let currentObjectUrl = null;

    input.addEventListener('change', function (e) {
      const file = input.files && input.files[0];
      if (!file) return;
      // Only handle image types
      if (!file.type.startsWith('image/')) return;

      // Revoke previous object URL if present
      if (currentObjectUrl) {
        URL.revokeObjectURL(currentObjectUrl);
        currentObjectUrl = null;
      }

      const objectUrl = URL.createObjectURL(file);
      currentObjectUrl = objectUrl;
      preview.src = objectUrl;

      // Once image has loaded, revoke the object URL after a short delay
      preview.onload = function () {
        // optional: keep preview displayed; revoke to free memory
        if (currentObjectUrl) {
          URL.revokeObjectURL(currentObjectUrl);
          currentObjectUrl = null;
        }
      };
    });
  })();
</script>