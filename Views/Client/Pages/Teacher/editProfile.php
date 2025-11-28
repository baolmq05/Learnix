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
  <?php
    $teacher = [
      'id'=>1,
      'name'=>'Phan Văn Tính',
      'email'=>'phan.tinh@example.com',
      'phone'=>'+84 912 345 678',
      'bio'=>'Giảng viên thiết kế web & front-end với hơn 8 năm kinh nghiệm.',
      'avatar'=>'',
    ];
  ?>

  <h1 class="text-2xl font-semibold mb-4">Chỉnh sửa hồ sơ</h1>

  <form id="teacher-profile-form" action="index.php?page=teacherSaveProfile" method="post" enctype="multipart/form-data" class="bg-white rounded-lg p-6">
    <input type="hidden" name="id" value="<?= $teacher['id'] ?>">
    <input type="hidden" name="change_password" id="change_password" value="0">

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
      <div class="col-span-1 flex flex-col items-center">
        <?php if(!empty($teacher['avatar'])): ?>
          <img src="<?= htmlspecialchars($teacher['avatar']) ?>" alt="avatar" class="w-28 h-28 object-cover rounded-full" />
        <?php else: ?>
          <div class="w-28 h-28 rounded-full bg-gray-100 flex items-center justify-center text-2xl font-semibold text-gray-700"><?= htmlspecialchars(strtoupper(mb_substr($teacher['name'],0,1))) ?></div>
        <?php endif; ?>

        <label class="mt-3 w-full">
          <span class="sr-only">Upload avatar</span>
          <input type="file" name="avatar" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:bg-blue-600 file:text-white mt-2" />
        </label>
      </div>

      <div class="sm:col-span-2 grid grid-cols-1 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Họ và tên</label>
          <input type="text" name="name" value="<?= htmlspecialchars($teacher['name']) ?>" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($teacher['email']) ?>" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Điện thoại</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($teacher['phone']) ?>" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" />
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Giới thiệu ngắn</label>
          <textarea name="bio" rows="4" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500"><?= htmlspecialchars($teacher['bio']) ?></textarea>
        </div>
      </div>
    </div>

    <div class="mt-6">
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Lưu thay đổi</button>

      <button type="button" id="toggle-password" aria-expanded="false" class="ml-3 bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded">Đổi mật khẩu</button>
    </div>

    <div id="password-panel" class="overflow-hidden mt-4" style="max-height:0; transition: max-height 300ms ease;">
      <div class="p-4 rounded mt-2 ">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Mật khẩu hiện tại</label>
            <input type="password" name="current_password" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Mật khẩu mới</label>
            <input type="password" name="new_password" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
          </div>
          <div class="sm:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Xác nhận mật khẩu mới</label>
            <input type="password" name="confirm_password" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
          </div>
        </div>

        <div class="mt-4">
          <div class="text-sm text-gray-500">Nhập mật khẩu mới ở trên rồi nhấn "Lưu thay đổi" để cập nhật.</div>
        </div>
      </div>
    </div>
  </form>

  <script>
    (function(){
      const btn = document.getElementById('toggle-password');
      const panel = document.getElementById('password-panel');
      const form = document.getElementById('teacher-profile-form');
      const changeFlag = document.getElementById('change_password');

      function expand() {
        panel.style.maxHeight = panel.scrollHeight + 'px';
        btn.setAttribute('aria-expanded', 'true');
      }

      function collapse() {
        panel.style.maxHeight = '0';
        btn.setAttribute('aria-expanded', 'false');
      }

      btn.addEventListener('click', function(){
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        if(expanded) collapse(); else expand();
      });

      // When form submits, set change_password = 1 only if new_password provided and panel is open
      form.addEventListener('submit', function(e){
        const newPwd = form.querySelector('input[name="new_password"]').value.trim();
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        if(expanded && newPwd.length > 0) {
          changeFlag.value = '1';
        } else {
          changeFlag.value = '0';
        }
      });

      // Close panel if clicking outside (optional)
      document.addEventListener('click', function(e){
        if(!panel.contains(e.target) && !btn.contains(e.target) && panel.style.maxHeight !== '0'){
          collapse();
        }
      });
    })();
  </script>
</div>
