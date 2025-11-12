<div class="max-w-6xl mx-auto p-6 flex flex-col lg:flex-row gap-6">
      <div class="w-full lg:w-2/3 space-y-5">
        <p class="text-3xl font-semibold mb-5 tracking-wide text-neutral-700">
          Thông báo
        </p>
        <div class="flex gap-6">
          <a
            href="#"
            class="font-semibold border-b-2 border-blue-500 text-blue-600 transition duration-300"
          >
            Giảng viên
          </a>
          <a
            href="#"
            class="font-semibold hover:text-blue-600 hover:underline underline-offset-4 transition duration-300"
          >
            Học viên
          </a>
        </div>

        <div class="flex gap-3 my-4 justify-center">
          <button
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:text-white transition duration-300"
          >
            Chưa đọc
          </button>
          <button
            class="px-4 py-2 bg-gray-100 rounded-lg hover:bg-blue-600 hover:text-white transition duration-300"
          >
            Đã đọc
          </button>
        </div>

        <div class="space-y-3">
          <div
            class="flex items-start gap-3 p-4 bg-green-50 rounded-lg hover:bg-gray-100 item-notify cursor-pointer"
          >
            <img
              src="https://i.pinimg.com/736x/61/62/2e/61622ec8899cffaa687a8342a84ea525.jpg"
              class="w-12 h-12 rounded-full"
              alt="Avatar Giảng viên"
            />
            <a href="#">
              <p class="font-bold">
                Giảng viên Nguyễn Văn A đã phản hồi bình luận của bạn trong khóa
                học "PHP cơ bản".
              </p>
              <span class="text-xs text-gray-500">3 giờ trước</span>
            </a>
          </div>

          <div
            class="flex items-start gap-3 p-4 rounded-lg hover:bg-gray-100 cursor-pointer"
          >
            <img
              src="https://anhdephd.vn/wp-content/uploads/2022/04/hinh-anh-hoat-hinh.jpg"
              class="w-12 h-12 rounded-full"
              alt="Avatar hệ thống"
            />
            <a href="#">
              <p class="font-media text-gray-600">
                Bạn vừa nhận được 100.000₫ doanh thu từ khóa học "React nâng
                cao".
              </p>
              <span class="text-xs text-gray-500">1 ngày trước</span>
            </a>
          </div>

          <div
            class="flex items-start gap-3 p-4 bg-green-50 rounded-lg hover:bg-gray-100 item-notify cursor-pointer"
          >
            <img
              src="https://anhdephd.vn/wp-content/uploads/2022/04/hinh-anh-hoat-hinh.jpg"
              class="w-12 h-12 rounded-full"
              alt="Avatar hệ thống"
            />
            <a href="#">
              <p class="font-bold">Giảng viên Nguyễn Văn A đã phản hồi...</p>
              <span class="text-xs text-gray-500">1 ngày trước</span>
            </a>
          </div>
        </div>

        <div class="text-center mt-6">
          <p class="text-blue-600 text-lg hidden">Không có thông báo</p>
        </div>
      </div>

      <div class="w-full lg:w-1/3 lg:flex items-center justify-center hidden">
        <img
          src="./Assets/Client/Images/bell.png"
          class="w-56 h-56 rounded-full"
          alt="Chuông thông báo"
        />
      </div>
    </div>
    <div
      id="modalDetail"
      class="fixed inset-0 hidden bg-black/40 items-center justify-center z-50"
    >
      <div class="bg-white rounded-2xl shadow-xl w-96 p-6 relative">
        <button
          id="btnCloseModal"
          class="absolute top-3 right-3 text-gray-500 hover:text-black cursor-pointer"
        >
          ✕
        </button>

        <div class="space-y-3">
          <img
            src="https://i.pinimg.com/736x/61/62/2e/61622ec8899cffaa687a8342a84ea525.jpg"
            class="w-20 h-20 rounded-full mx-auto"
            alt="Avatar Giảng viên"
          />
          <h2 class="text-xl font-semibold text-gray-800  text-center">
            Giảng viên Nguyễn Văn A
          </h2>
          <p class="text-gray-600  text-center">
            Đã phản hồi bình luận của bạn trong khóa học
            <span class="font-medium text-blue-600">"PHP cơ bản"</span>.
          </p>
          <p class="text-gray-600">
            <span class="font-semibold text-black">Nội dung bạn đã gửi:</span> Cho em hỏi phần này mình nên lên làm sao v ạ
          </p>
          <p class="text-gray-600">
            <span class="font-semibold text-black">Nội dung phản hồi:</span> Làm như video là được nha em
          </p>
          <span class="text-sm text-gray-400">3 giờ trước</span>
        </div>

        <div class="flex justify-center gap-3 mt-6">
          <button
            class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition cursor-pointer"
            id="btnClose2"
          >
            Đóng
          </button>
        </div>
      </div>
    </div>
    <script>
      const modal = document.querySelector("#modalDetail");
      document.querySelectorAll(".item-notify").forEach((el) => {
        el.addEventListener("click", () => {
          modal.classList.remove("hidden");
          modal.classList.add("flex");
        });
      });
      document.querySelectorAll("#btnCloseModal, #btnClose2").forEach((el) => {
        el.addEventListener("click", () => {
          modal.classList.remove("flex");
          modal.classList.add("hidden");
        });
      });
    </script>