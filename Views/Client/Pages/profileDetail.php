<div class="max-w-3xl mx-auto my-10 p-8 r">
      <header class="pb-4 mb-6 border-b border-gray-200">
        <h2 class="text-3xl font-extrabold text-black">
          Chỉnh Sửa Hồ Sơ Học Viên
        </h2>
        <p class="text-sm text-gray-500 mt-1">
          Cập nhật thông tin cá nhân và liên hệ của bạn
        </p>
      </header>

      <form action="#" method="POST" class="space-y-6">
        <div
          class="flex flex-col items-center space-y-4 pb-4 border-b border-gray-100"
        >
          <img
            src="https://i.pinimg.com/736x/61/62/2e/61622ec8899cffaa687a8342a84ea525.jpg"
            alt="Avatar"
            class="w-28 h-28 rounded-full object-cover shadow-lg ring-4 ring-gray-100"
          />
          <button
            type="button"
            class="text-sm text-blue-600 font-medium hover:text-blue-700 transition"
          >
            Thay đổi ảnh đại diện
          </button>
        </div>

        <div class="space-y-4">
          <h3 class="text-xl font-bold text-black border-b pb-2 mb-4">
            Thông tin Cá nhân
          </h3>

          <div>
            <label for="name" class="block text-sm font-medium text-black mb-1"
              >Họ và Tên</label
            >
            <input
              type="text"
              id="name"
              name="name"
              value="Ong Tuấn Nghĩa"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg text-black"
            />
          </div>
        </div>

        <div class="space-y-4 pt-4">
          <h3 class="text-xl font-bold text-black border-b pb-2 mb-4">
            Thông tin Liên hệ
          </h3>

          <div>
            <label for="email" class="block text-sm font-medium text-black mb-1"
              >Email</label
            >
            <input
              type="email"
              id="email"
              name="email"
              value="nghia@gmail.com"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg text-black"
            />
          </div>
          <div>
            <label for="phone" class="block text-sm font-medium text-black mb-1"
              >Điện thoại</label
            >
            <input
              type="tel"
              id="phone"
              name="phone"
              value="(84) 901-234-567"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg text-black"
            />
          </div>
          <div>
            <label
              for="address"
              class="block text-sm font-medium text-black mb-1"
              >Địa chỉ</label
            >
            <input
              type="text"
              id="address"
              name="address"
              value="TP.Cần Thơ, Việt Nam"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg text-black"
            />
          </div>

          <div class="flex items-center gap-2 pt-4">
            <input
              type="checkbox"
              id="toggle-password"
              class="h-4 w-4 border-gray-300 rounded"
            />
            <label for="toggle-password" class="text-sm font-medium text-black"
              >Tôi muốn thay đổi mật khẩu</label
            >
          </div>
          <div id="password-section" class="hidden space-y-4">
            <div>
              <label
                for="new-password"
                class="block text-sm font-medium text-black mb-1"
                >Mật khẩu mới</label
              >
              <input
                type="password"
                id="new-password"
                name="new-password"
                placeholder="Nhập mật khẩu mới"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 text-black"
              />
            </div>
            <div>
              <label
                for="confirm-password"
                class="block text-sm font-medium text-black mb-1"
                >Nhập lại mật khẩu</label
              >
              <input
                type="password"
                id="confirm-password"
                name="confirm-password"
                placeholder="Xác nhận mật khẩu mới"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 text-black"
              />
            </div>
          </div>
        </div>

        <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
          <a
            href="/index.php?page=profile"
            class="px-6 py-2 bg-gray-200 text-black font-semibold rounded-lg hover:bg-gray-300 transition shadow-md"
          >
            Hủy
          </a>
          <button
            type="submit"
            class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition shadow-md"
          >
            Lưu Thay Đổi
          </button>
        </div>
      </form>
    </div>

    <script>
      const checkbox = document.getElementById("toggle-password");
      const section = document.getElementById("password-section");
      const newPass = document.getElementById("new-password");
      const confirmPass = document.getElementById("confirm-password");

      checkbox.addEventListener("change", () => {
        const show = checkbox.checked;
        section.classList.toggle("hidden", !show);

        newPass.value = "";
        confirmPass.value = "";
        newPass.required = show;
        confirmPass.required = show;
      });
    </script>