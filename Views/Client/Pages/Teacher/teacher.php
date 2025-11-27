<?php
$showLoginSuccess = isset($_GET['login']) && $_GET['login'] === 'success';
?>
<div id="alert_login_success_teacher" role="alert" style="display:none;"
    class="fixed top-6 right-6 z-50 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg shadow-lg opacity-0 pointer-events-none transform transition-all duration-300 translate-x-full">
    <i class="bi bi-check-circle-fill"></i>
    <div class="text-sm font-medium">Đăng nhập thành công</div>
  </div>
<section class="max-w-screen-2xl mx-auto px-4 py-8">
  
  <div class="flex items-center justify-between gap-4">
    <div>
      <h1 class="text-2xl md:text-3xl font-semibold text-gray-900">Khóa học của tôi</h1>
      <p class="mt-1 text-sm text-gray-600">Danh sách các khóa học bạn đã tạo</p>
    </div>

    <div class="flex items-center gap-2">
      <a href="index.php?page=teacherAddCourse"
        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium shadow-sm">
        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        <span>Thêm khóa học</span>
      </a>
    </div>
  </div>

  <div class="mt-6">
    <?php
    $myCourses = [
      ['title' => 'Lập trình PHP cơ bản', 'students' => 124, 'rating' => '4.7', 'status' => 'Đang mở', 'price' => '199,000', 'image' => 'https://tedu.com.vn//uploaded/images/news/052019/learn-html5.jpg'],
      ['title' => 'Thiết kế giao diện với Tailwind CSS', 'students' => 98, 'rating' => '4.5', 'status' => 'Bản nháp', 'price' => '299,000', 'image' => 'https://caodang.fpt.edu.vn/wp-content/uploads/13-3.png'],
      ['title' => 'JavaScript nâng cao', 'students' => 210, 'rating' => '4.8', 'status' => 'Đang mở', 'price' => '349,000', 'image' => 'https://cdn.tgdd.vn/hoi-dap/1321801/javascript-la-gi-co-vai-tro-gi-cach-bat-javascript-tren.001.jpg'],
    ];
    ?>

    <?php if (empty($myCourses)): ?>
      <div class="rounded-md border border-dashed border-gray-200 p-8 text-center text-gray-600">
        Bạn chưa có khóa học nào. Nhấn "Thêm khóa học" để bắt đầu.
      </div>
    <?php else: ?>
      <div class="space-y-4">
        <?php foreach ($myCourses as $course): ?>
          <article class="flex items-center gap-4 border-b pb-4">
            <a href="#" class="flex items-center gap-4 flex-1 min-w-0">
              <div class="flex-shrink-0 w-32 h-20 bg-gray-100 overflow-hidden rounded-sm">
                <img src="<?= $course['image'] ?>" alt="<?= htmlspecialchars($course['title']) ?>"
                  class="w-full h-full object-cover" />
              </div>

              <div class="min-w-0">
                <h3 class="text-md font-semibold text-gray-900 truncate"><?= htmlspecialchars($course['title']) ?></h3>
                <p class="mt-1 text-sm truncate">
                  <span
                    class="inline-flex items-center text-xs font-medium px-2 py-0.5 rounded-full bg-green-100 text-green-800"><?= $course['students'] ?>
                    học viên</span>
                </p>
                <p class="text-sm mt-1">
                  <span class="text-yellow-600"><?= $course['rating'] ?>&nbsp;<i class="bi bi-star-fill text-xs"></i></span>
                </p>
              </div>
            </a>

            <div class="flex flex-col items-end gap-2">
              <div class="text-lg font-semibold text-gray-900"><?= $course['price'] ?>₫</div>
              <div class="flex items-center gap-2">
                <a href="index.php?page=teacher&action=viewDetail"
                  class="inline-block text-xs px-3 py-1 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200">Xem chi
                  tiết</a>
                <button class="inline-block text-xs px-3 py-1 bg-red-50 text-red-600 rounded-full hover:bg-red-100"
                  type="button">Xóa</button>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
<script>
  (function () {
    const key = 'login_success';
    const showFromQuery = <?php echo $showLoginSuccess ? 'true' : 'false'; ?>;
    if (!sessionStorage) return;
    if (sessionStorage.getItem(key) || showFromQuery) {
      const el = document.getElementById('alert_login_success_teacher');
      if (!el) return;
      // show (display + slide-in + fade)
      el.style.display = 'flex';
      requestAnimationFrame(() => {
        el.classList.remove('opacity-0', 'pointer-events-none', 'translate-x-full');
        el.classList.add('opacity-100', 'translate-x-0');
      });

      // hide after 4s with slide-out + fade
      setTimeout(() => {
        el.classList.remove('opacity-100', 'translate-x-0');
        el.classList.add('opacity-0', 'translate-x-full');
        setTimeout(() => {
          el.style.display = 'none';
          sessionStorage.removeItem(key);
          if (showFromQuery && window.history && window.history.replaceState) {
            const cleanUrl = window.location.pathname;
            window.history.replaceState({}, document.title, cleanUrl);
          }
        }, 300);
      }, 4000);
    }
  })();
</script>