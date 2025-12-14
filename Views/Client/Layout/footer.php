<footer class="bg-black text-white">
  <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6 px-6">
    <div class="my-5">
      <h3 class="font-semibold text-lg mb-3">Giới thiệu</h3>
      <ul class="space-y-2 text-sm">
        <li>
          <a href="#" class="hover:underline underline-offset-1 transition duration-300">Giới thiệu về chúng tôi</a>
        </li>
        <li>
          <a href="#" class="hover:underline underline-offset-1 transition duration-300">Đội ngũ giảng viên
          </a>
        </li>
        <li>
          <a href="#" class="hover:underline underline-offset-1 transition duration-300">Liên hệ với chúng tôi</a>
        </li>
      </ul>
    </div>
    <div class="my-5">
      <h3 class="font-semibold text-lg mb-3">Khóa học</h3>
      <ul class="space-y-2 text-sm">
        <li>
          <a href="#" class="hover:underline underline-offset-1 transition duration-300">
            Lập trình web
          </a>
        </li>

        <li>
          <a href="#" class="hover:underline underline-offset-1 transition duration-300">
            Lập trình frontend
          </a>
        </li>
        <li>
          <a href="#" class="hover:underline underline-offset-1 transition duration-300">
            Lập trình backend
          </a>
        </li>
        <li>
          <a href="#" class="hover:underline underline-offset-1 transition duration-300">
            Lập trình phần mềm
          </a>
        </li>
      </ul>
    </div>
    <div class="my-5">
      <h3 class="font-semibold text-lg mb-3">Hỗ trợ/ Chính sách</h3>
      <ul class="space-y-2 text-sm">
        <li>
          <a href="#" class="hover:underline underline-offset-1 transition duration-300">
            FAQ / Hướng dẫn sử dụng
          </a>
        </li>

        <li>
          <a href="#" class="hover:underline underline-offset-1 transition duration-300">
            Chính sách bảo mật
          </a>
        </li>
        <li>
          <a href="#" class="hover:underline underline-offset-1 transition duration-300">
            Điều khoản sử dụng
          </a>
        </li>
        <li>
          <a href="#" class="hover:underline underline-offset-1 transition duration-300">
            Chính sách hoàn tiền
          </a>
        </li>
      </ul>
    </div>
    <div class="my-5">
      <h3 class="font-semibold text-lg mb-3">Kết nối/ Hỗ trợ</h3>
      <ul class="space-y-2 text-sm">
        <li class="flex items-center gap-2 hover:underline underline-offset-1 transition duration-300">
          <i class="bi bi-geo-alt-fill"></i>
          <span>
            Số 3 Ngõ 216 Lê Trọng Tấn, Thanh Xuân, Hà Nội</span>
        </li>

        <li class="flex items-center gap-2 hover:underline underline-offset-1 transition duration-300">
          <i class="bi bi-telephone-fill"></i>
          <span>0932 873 666</span>
        </li>
        <li class="flex items-center lex gap-2 hover:underline underline-offset-1 transition duration-300">
          <i class="bi bi-envelope-fill"></i>
          <span>Learnix@gmail.com</span>
        </li>
        <li class="flex gap-5">
          <a href="#">
            <i class="bi bi-facebook hover:text-blue-500 text-2xl"></i>
          </a>
          <a href="#">
            <i class="bi bi-instagram hover:text-blue-500 text-2xl"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <hr />
  <div class="container mx-auto text-center py-4 text-sm font-semibold">
    © 2025 Learnix. Mọi quyền được bảo lưu. | Thiết kế bởi nhóm Learnix
  </div>
</footer>
</body>
<script src="/Assets/Client/js/header.js"></script>
<script src="/Assets/Client/js/cart.js"></script>
<script src="/Assets/Client/js/createCourse.js"></script>
<!-- <script src="/Assets/Client/js/editCourse.js"></script> -->
<script src="/Assets/Client/js/lessonPlayer.js"></script>
<script src="https://kit.fontawesome.com/645e77e620.js" crossorigin="anonymous"></script>
<script src="/Assets/Client/js/alert.js"></script>
<script src="/Assets/Client/js/teacherProfile.js"></script>


<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
  document.getElementById('searchInput').addEventListener('keyup', function() {
    let keyword = this.value.trim();

    if (keyword.length === 0) {
      document.getElementById('suggestBox').classList.add('hidden');
      return;
    }

    fetch(`Controllers/Client/Ajax/AjaxSearch.php?q=${keyword}`)
      .then(response => response.json())
      .then(data => {
        let box = document.getElementById('suggestBox');
        box.innerHTML = "";

        if (data.length === 0) {
          box.innerHTML = `<div class="p-2 text-gray-500 text-sm">Không có kết quả</div>`;
        } else {
          data.forEach(item => {
            box.innerHTML += `
                        <a href="?page=course_detail&id=${item.id}" 
                           class="flex items-center gap-3 p-2 hover:bg-gray-100 cursor-pointer">
                            <img src="Uploads/Courses/${item.image}" class="w-10 h-10 rounded-md object-cover">
                            <span class="text-gray-700 two-line-ellipsis text-sm">${item.course_name}</span>
                        </a>
                    `;
          });
        }
        box.classList.remove('hidden');
      });
  });

  document.addEventListener("click", function(e) {
    const box = document.getElementById("suggestBox");
    const input = document.getElementById("searchInput");

    if (!box.contains(e.target) && e.target !== input) {
      box.classList.add("hidden");
    }
  });
</script>

</html>