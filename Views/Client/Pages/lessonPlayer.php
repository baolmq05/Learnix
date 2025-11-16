    <main>
      <div class="bg-black text-white flex items-center border-b border-white">
        <i class="bi bi-arrow-left-short text-2xl p-3 me-2"></i>
        <a class="hover:text-gray-300" href="#"
          >Khóa học lập trình html/css từ zero đến hero</a
        >
      </div>
      <div class="flex">
        <div class="lg:w-[70%] w-full">
          <div class="bg-black lg:h-115 h-100">
            <iframe
              class="mx-auto"
              width="80%"
              height="100%"
              src="https://www.youtube.com/embed/R6plN3FvzFY?si=PONDsmc6W9w2P4PJ"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              referrerpolicy="strict-origin-when-cross-origin"
              allowfullscreen
            ></iframe>
          </div>

          <div x-data="{ tab: 1 }" class="w-full mt-2 lg:px-16 px-6">
            <div class="flex border-b border-gray-300">
              <button
                @click="tab = 1"
                :class="tab === 1 ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500'"
                class="py-2 px-4 hover:cursor-pointer"
              >
                Tổng quan
              </button>
              <button
                @click="tab = 4"
                :class="tab === 4 ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500'"
                class="py-2 px-4 hover:cursor-pointer lg:hidden block"
              >
                Nội dung
              </button>
              <button
                @click="tab = 2"
                :class="tab === 2 ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500'"
                class="py-2 px-4 hover:cursor-pointer"
              >
                Ghi chú
              </button>
              <button
                @click="tab = 3"
                :class="tab === 3 ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500'"
                class="py-2 px-4 hover:cursor-pointer"
              >
                Đánh giá
              </button>
            </div>

            <div class="mt-4 w-full lg:w-[90%] mx-auto">
              <div x-show="tab === 1">
                <div class="p-3 bg-blue-50 rounded">
                  <h2 class="text-2xl font-bold">Bài 1: Giới thiệu</h2>
                  <p>Qua bài học này giúp bạn hiểu thêm về html, css là gì?</p>
                </div>
                <div class="mt-3 p-3">
                  <h2 class="text-2xl font-bold">Về khóa học này</h2>
                  <p class="flex mt-5">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24"
                      fill="currentColor"
                      class="size-6 text-yellow-300 me-1"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                        clip-rule="evenodd"
                      />
                    </svg>
                    4.7 (199,000 lượt đánh giá) · 850,000 lượt bán
                  </p>
                  <p class="mt-2">
                    Được đăng bởi
                    <a href="#" class="text-[#0000e4] ms-1"
                      >Thầy Phan Văn Tính</a
                    >
                  </p>
                  <p class="mt-5 flex">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="size-6 me-1"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"
                      />
                    </svg>
                    Cập nhật lần cuối: 10/10/2025
                  </p>
                  <div class="border border-[#6d28d2] mt-5 p-5">
                    <h2 class="text-2xl font-medium col-span-2 mb-5">
                      Sau khi hoàn thành khóa học, bạn sẽ:
                    </h2>
                    <div class="grid grid-cols-2 gap-3">
                      <div class="flex">
                        <p>
                          <i
                            class="bi bi-check-square-fill text-green-500 me-2"
                          ></i>
                        </p>
                        <p>Hiểu rõ cấu trúc và cú pháp của HTML5.</p>
                      </div>
                      <div class="flex">
                        <p>
                          <i
                            class="bi bi-check-square-fill text-green-500 me-2"
                          ></i>
                        </p>
                        <p>
                          Thành thạo trong việc xây dựng các giao diện web thực
                          tế.
                        </p>
                      </div>
                      <div class="flex">
                        <p>
                          <i
                            class="bi bi-check-square-fill text-green-500 me-2"
                          ></i>
                        </p>
                        <p>
                          Biết cách sử dụng CSS3 để định dạng, bố cục và tạo
                          hiệu ứng giao diện.
                        </p>
                      </div>
                      <div class="flex">
                        <p>
                          <i
                            class="bi bi-check-square-fill text-green-500 me-2"
                          ></i>
                        </p>
                        <p>
                          Tự tin tiếp tục học các công nghệ nâng cao như
                          JavaScript, Bootstrap, Tailwind hoặc React.
                        </p>
                      </div>
                      <div class="flex">
                        <p>
                          <i
                            class="bi bi-check-square-fill text-green-500 me-2"
                          ></i>
                        </p>
                        <p>
                          Làm chủ Flexbox và Grid Layout để thiết kế bố cục hiện
                          đại.
                        </p>
                      </div>
                      <div class="flex">
                        <p>
                          <i
                            class="bi bi-check-square-fill text-green-500 me-2"
                          ></i>
                        </p>
                        <p>
                          Biết cách responsive website tương thích với mọi thiết
                          bị (mobile, tablet, PC).
                        </p>
                      </div>
                    </div>
                  </div>
                  <div>
                    <h3 class="text-2xl font-bold mt-5">Phù hợp cho ai:</h3>
                    <ul class="list-disc ps-5 mt-3 space-y-1">
                      <li>Người mới bắt đầu muốn học lập trình web.</li>
                      <li>
                        Học sinh, sinh viên muốn tạo website cá nhân hoặc dự án
                        học tập.
                      </li>
                      <li>Người muốn chuyển ngành sang lập trình Front-end.</li>
                    </ul>
                  </div>
                  <h3 class="text-2xl font-bold mt-5 mb-3">Giảng viên</h3>
                  <div class="flex justify-between items-center">
                    <div class="flex items-center">
                      <div class="w-20 h-20">
                        <img
                          class="rounded-full"
                          src="https://res.cloudinary.com/dfmoftnpw/image/upload/v1762444100/Screenshot_2025-11-06_224724_oheyga.png"
                          width="100%"
                          alt=""
                        />
                      </div>
                      <p class="font-bold text-2xl ms-5">
                        <a href="#">Thầy Phan Văn Tính</a>
                      </p>
                    </div>
                    <div class="me-10">
                      <p><i class="bi bi-star"></i> 5 sao đánh giá</p>
                      <p><i class="bi bi-people"></i> 200.000 học viên</p>
                      <p><i class="bi bi-play-circle"></i> 300 video bài học</p>
                    </div>
                  </div>
                </div>
              </div>
              <div x-show="tab === 2">
                <details class="group">
                  <summary
                    class="flex justify-between border p-3 mt-3 select-none hover:cursor-pointer bg-[#f9f6f7]"
                  >
                    <h4 class="font-bold">
                      <i
                        class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                      ></i
                      >Thêm ghi chú mới
                    </h4>
                    <i class="bi bi-plus-circle-fill"></i>
                  </summary>
                  <div class="border-x border-b p-4">
                    <div
                      class="flex gap-3 justify-center items-center mt-2 px-10"
                    >
                      <span class="px-2 rounded-[20px] bg-black text-white"
                        >1:00</span
                      >
                      <textarea
                        class="border border-gray-300 focus:border-blue-500 focus:ring-0 p-2 rounded w-full"
                        rows="4"
                      ></textarea>
                    </div>
                    <div class="flex gap-3 justify-end items-center mt-3 px-10">
                      <button
                        class="py-2 px-4 hover:cursor-pointer bg-purple-700 text-white rounded-[5px]"
                      >
                        Lưu ghi chú
                      </button>
                    </div>
                  </div>
                </details>
              </div>
              <div x-show="tab === 3" class="p-3 rounded">
                <p class="mt-8 mb-2 text-lg font-bold">
                  <i class="bi bi-star-fill text-yellow-400"></i> • 11K đánh giá
                </p>
                <div class="flex flex-wrap gap-5">
                  <div class="border w-full p-5">
                    <div class="flex gap-5">
                      <div class="w-15 h-15">
                        <img
                          class="rounded-full"
                          src="https://res.cloudinary.com/dfmoftnpw/image/upload/v1761579295/js-nangcao-images/zhj5snxw4ru14z2kvt67.png"
                          alt=""
                        />
                      </div>
                      <div>
                        <p>Nguyễn Hoàng Bảo</p>
                        <p class="text-xs mt-3">
                          <i class="bi bi-star-fill text-yellow-400"></i>
                          <i class="bi bi-star-fill text-yellow-400"></i>
                          <i class="bi bi-star-fill text-yellow-400"></i>
                          <i class="bi bi-star-fill text-yellow-400"></i>
                          <i class="bi bi-star-fill text-yellow-400"></i>
                          <span class="ms-2">1 tuần trước</span>
                        </p>
                      </div>
                    </div>
                    <p class="mt-3 text-justify">
                      Đây là một khóa học tuyệt vời và sâu sắc về AI. Nó thực sự
                      đã mở rộng hiểu biết của tôi về chủ đề này và cung cấp cho
                      tôi những kỹ năng thực tế mà tôi có thể áp dụng ngay.
                    </p>
                  </div>
                  <div class="border w-full p-5">
                    <div class="flex gap-5">
                      <div class="w-15 h-15">
                        <img
                          class="rounded-full"
                          src="https://res.cloudinary.com/dfmoftnpw/image/upload/v1761701354/js-nangcao-images/zoms8n5lnlotl3xc1ytg.jpg"
                          alt=""
                        />
                      </div>
                      <div>
                        <p>Đinh Quốc Toàn</p>
                        <p class="text-xs mt-3">
                          <i class="bi bi-star-fill text-yellow-400"></i>
                          <i class="bi bi-star-fill text-yellow-400"></i>
                          <i class="bi bi-star-fill text-yellow-400"></i>
                          <i class="bi bi-star-fill text-yellow-400"></i>
                          <i class="bi bi-star text-yellow-400"></i>
                          <span class="ms-2">1 tuần trước</span>
                        </p>
                      </div>
                    </div>
                    <p class="mt-3 text-justify">
                      Đây là một khóa học tuyệt vời và sâu sắc về AI. Nó thực sự
                      đã mở rộng hiểu biết của tôi về chủ đề này và cung cấp cho
                      tôi những kỹ năng thực tế mà tôi có thể áp dụng ngay.
                    </p>
                  </div>
                </div>
              </div>
              <div x-show="tab === 4" class="p-3 rounded lg:hidden block">
                <h2 class="font-bold text-2xl text-center mb-4">
                  Nội dung khóa học
                </h2>
                <p class="text-center">
                  5 phần • 20 bài giảng • Tổng thời lượng 24 giờ
                </p>
                <details class="group">
                  <summary
                    class="flex flex-col border-t border-[#ccc] p-5 mt-3 select-none hover:cursor-pointer bg-[#f9f6f7]"
                  >
                    <h4 class="font-bold">
                      <i
                        class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                      ></i
                      >Phần 1: Giới thiệu
                    </h4>
                    <p class="text-sm ms-6">3 bài giảng • 26 phút</p>
                  </summary>
                  <div>
                    <div
                      class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
                    >
                      <h4>Bài 1: Giới thiệu</h4>
                      <p class="whitespace-nowrap">13 phút</p>
                    </div>
                    <div
                      class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
                    >
                      <h4>Bài 2: Css là gì?</h4>
                      <p class="whitespace-nowrap">13 phút</p>
                    </div>
                  </div>
                </details>
                <details class="group">
                  <summary
                    class="flex flex-col border-t border-[#ccc] p-5 select-none hover:cursor-pointer bg-[#f9f6f7]"
                  >
                    <h4 class="font-bold">
                      <i
                        class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                      ></i
                      >Phần 1: Giới thiệu
                    </h4>
                    <p class="text-sm ms-6">3 bài giảng • 26 phút</p>
                  </summary>
                  <div>
                    <div
                      class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
                    >
                      <h4>Bài 1: Giới thiệu</h4>
                      <p class="whitespace-nowrap">13 phút</p>
                    </div>
                    <div
                      class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
                    >
                      <h4>Bài 2: Css là gì?</h4>
                      <p class="whitespace-nowrap">13 phút</p>
                    </div>
                  </div>
                </details>
                <details class="group">
                  <summary
                    class="flex flex-col border-t border-[#ccc] p-5 select-none hover:cursor-pointer bg-[#f9f6f7]"
                  >
                    <h4 class="font-bold">
                      <i
                        class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                      ></i
                      >Phần 1: Giới thiệu
                    </h4>
                    <p class="text-sm ms-6">3 bài giảng • 26 phút</p>
                  </summary>
                  <div>
                    <div
                      class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
                    >
                      <h4>Bài 1: Giới thiệu</h4>
                      <p class="whitespace-nowrap">13 phút</p>
                    </div>
                    <div
                      class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
                    >
                      <h4>Bài 2: Css là gì?</h4>
                      <p class="whitespace-nowrap">13 phút</p>
                    </div>
                  </div>
                </details>
                <details class="group">
                  <summary
                    class="flex flex-col border-t border-[#ccc] p-5 select-none hover:cursor-pointer bg-[#f9f6f7]"
                  >
                    <h4 class="font-bold">
                      <i
                        class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                      ></i
                      >Phần 1: Giới thiệu
                    </h4>
                    <p class="text-sm ms-6">3 bài giảng • 26 phút</p>
                  </summary>
                  <div>
                    <div
                      class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
                    >
                      <h4>Bài 1: Giới thiệu</h4>
                      <p class="whitespace-nowrap">13 phút</p>
                    </div>
                    <div
                      class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
                    >
                      <h4>Bài 2: Css là gì?</h4>
                      <p class="whitespace-nowrap">13 phút</p>
                    </div>
                  </div>
                </details>
                <details class="group">
                  <summary
                    class="flex flex-col border-t border-[#ccc] p-5 select-none hover:cursor-pointer bg-[#f9f6f7]"
                  >
                    <h4 class="font-bold">
                      <i
                        class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                      ></i
                      >Phần 1: Giới thiệu
                    </h4>
                    <p class="text-sm ms-6">3 bài giảng • 26 phút</p>
                  </summary>
                  <div>
                    <div
                      class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
                    >
                      <h4>Bài 1: Giới thiệu</h4>
                      <p class="whitespace-nowrap">13 phút</p>
                    </div>
                    <div
                      class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
                    >
                      <h4>Bài 2: Css là gì?</h4>
                      <p class="whitespace-nowrap">13 phút</p>
                    </div>
                  </div>
                </details>
                <details class="group">
                  <summary
                    class="flex flex-col border-t border-[#ccc] p-5 select-none hover:cursor-pointer bg-[#f9f6f7]"
                  >
                    <h4 class="font-bold">
                      <i
                        class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                      ></i
                      >Phần 1: Giới thiệu
                    </h4>
                    <p class="text-sm ms-6">3 bài giảng • 26 phút</p>
                  </summary>
                  <div>
                    <div
                      class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
                    >
                      <h4>Bài 1: Giới thiệu</h4>
                      <p class="whitespace-nowrap">13 phút</p>
                    </div>
                    <div
                      class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
                    >
                      <h4>Bài 2: Css là gì?</h4>
                      <p class="whitespace-nowrap">13 phút</p>
                    </div>
                  </div>
                </details>
                <details class="group">
                  <summary
                    class="flex flex-col border-t border-[#ccc] p-5 select-none hover:cursor-pointer bg-[#f9f6f7]"
                  >
                    <h4 class="font-bold">
                      <i
                        class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                      ></i
                      >Phần 1: Giới thiệu
                    </h4>
                    <p class="text-sm ms-6">3 bài giảng • 26 phút</p>
                  </summary>
                  <div>
                    <div
                      class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
                    >
                      <h4>Bài 1: Giới thiệu</h4>
                      <p class="whitespace-nowrap">13 phút</p>
                    </div>
                    <div
                      class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
                    >
                      <h4>Bài 2: Css là gì?</h4>
                      <p class="whitespace-nowrap">13 phút</p>
                    </div>
                  </div>
                </details>
                <details class="group">
                  <summary
                    class="flex flex-col border-t border-[#ccc] p-5 select-none hover:cursor-pointer bg-[#f9f6f7]"
                  >
                    <h4 class="font-bold">
                      <i
                        class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                      ></i
                      >Phần 1: Giới thiệu
                    </h4>
                    <p class="text-sm ms-6">3 bài giảng • 26 phút</p>
                  </summary>
                  <div>
                    <div
                      class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
                    >
                      <h4>Bài 1: Giới thiệu</h4>
                      <p class="whitespace-nowrap">13 phút</p>
                    </div>
                    <div
                      class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
                    >
                      <h4>Bài 2: Css là gì?</h4>
                      <p class="whitespace-nowrap">13 phút</p>
                    </div>
                  </div>
                </details>
                <details class="group">
                  <summary
                    class="flex flex-col border-t border-[#ccc] p-5 select-none hover:cursor-pointer bg-[#f9f6f7]"
                  >
                    <h4 class="font-bold">
                      <i
                        class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                      ></i
                      >Phần 1: Giới thiệu
                    </h4>
                    <p class="text-sm ms-6">3 bài giảng • 26 phút</p>
                  </summary>
                  <div>
                    <div
                      class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
                    >
                      <h4>Bài 1: Giới thiệu</h4>
                      <p class="whitespace-nowrap">13 phút</p>
                    </div>
                    <div
                      class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
                    >
                      <h4>Bài 2: Css là gì?</h4>
                      <p class="whitespace-nowrap">13 phút</p>
                    </div>
                  </div>
                </details>
                <details class="group">
                  <summary
                    class="flex flex-col border-t border-[#ccc] p-5 select-none hover:cursor-pointer bg-[#f9f6f7]"
                  >
                    <h4 class="font-bold">
                      <i
                        class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                      ></i
                      >Phần 1: Giới thiệu
                    </h4>
                    <p class="text-sm ms-6">3 bài giảng • 26 phút</p>
                  </summary>
                  <div>
                    <div
                      class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
                    >
                      <h4>Bài 1: Giới thiệu</h4>
                      <p class="whitespace-nowrap">13 phút</p>
                    </div>
                    <div
                      class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
                    >
                      <h4>Bài 2: Css là gì?</h4>
                      <p class="whitespace-nowrap">13 phút</p>
                    </div>
                  </div>
                </details>
              </div>
            </div>
          </div>
        </div>
        <div
          class="w-[30%] border-s max-h-screen sticky top-0 right-0 border-[#ccc] lg:block hidden"
        >
          <h2 class="font-bold text-2xl text-center my-4">Nội dung khóa học</h2>
          <p class="text-center">
            5 phần • 20 bài giảng • Tổng thời lượng 24 giờ
          </p>
          <div class="max-h-160 overflow-y-auto">
          <details class="group">
            <summary
              class="flex flex-col border-t border-[#ccc] p-5 mt-3 select-none hover:cursor-pointer bg-[#f9f6f7]"
            >
              <h4 class="font-bold">
                <i
                  class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                ></i
                >Phần 1: Giới thiệu
              </h4>
              <p class="text-sm ms-6">3 bài giảng • 26 phút</p>
            </summary>
            <div>
              <div
                class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
              >
                <h4>Bài 1: Giới thiệu</h4>
                <p class="whitespace-nowrap">13 phút</p>
              </div>
              <div
                class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
              >
                <h4>Bài 2: Css là gì?</h4>
                <p class="whitespace-nowrap">13 phút</p>
              </div>
            </div>
          </details>
          <details class="group">
            <summary
              class="flex flex-col border-t border-[#ccc] p-5 select-none hover:cursor-pointer bg-[#f9f6f7]"
            >
              <h4 class="font-bold">
                <i
                  class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                ></i
                >Phần 1: Giới thiệu
              </h4>
              <p class="text-sm ms-6">3 bài giảng • 26 phút</p>
            </summary>
            <div>
              <div
                class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
              >
                <h4>Bài 1: Giới thiệu</h4>
                <p class="whitespace-nowrap">13 phút</p>
              </div>
              <div
                class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
              >
                <h4>Bài 2: Css là gì?</h4>
                <p class="whitespace-nowrap">13 phút</p>
              </div>
            </div>
          </details>
          <details class="group">
            <summary
              class="flex flex-col border-t border-[#ccc] p-5 select-none hover:cursor-pointer bg-[#f9f6f7]"
            >
              <h4 class="font-bold">
                <i
                  class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                ></i
                >Phần 1: Giới thiệu
              </h4>
              <p class="text-sm ms-6">3 bài giảng • 26 phút</p>
            </summary>
            <div>
              <div
                class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
              >
                <h4>Bài 1: Giới thiệu</h4>
                <p class="whitespace-nowrap">13 phút</p>
              </div>
              <div
                class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
              >
                <h4>Bài 2: Css là gì?</h4>
                <p class="whitespace-nowrap">13 phút</p>
              </div>
            </div>
          </details>
          <details class="group">
            <summary
              class="flex flex-col border-t border-[#ccc] p-5 select-none hover:cursor-pointer bg-[#f9f6f7]"
            >
              <h4 class="font-bold">
                <i
                  class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                ></i
                >Phần 1: Giới thiệu
              </h4>
              <p class="text-sm ms-6">3 bài giảng • 26 phút</p>
            </summary>
            <div>
              <div
                class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
              >
                <h4>Bài 1: Giới thiệu</h4>
                <p class="whitespace-nowrap">13 phút</p>
              </div>
              <div
                class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
              >
                <h4>Bài 2: Css là gì?</h4>
                <p class="whitespace-nowrap">13 phút</p>
              </div>
            </div>
          </details>
          <details class="group">
            <summary
              class="flex flex-col border-t border-[#ccc] p-5 select-none hover:cursor-pointer bg-[#f9f6f7]"
            >
              <h4 class="font-bold">
                <i
                  class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                ></i
                >Phần 1: Giới thiệu
              </h4>
              <p class="text-sm ms-6">3 bài giảng • 26 phút</p>
            </summary>
            <div>
              <div
                class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
              >
                <h4>Bài 1: Giới thiệu</h4>
                <p class="whitespace-nowrap">13 phút</p>
              </div>
              <div
                class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
              >
                <h4>Bài 2: Css là gì?</h4>
                <p class="whitespace-nowrap">13 phút</p>
              </div>
            </div>
          </details>
          <details class="group">
            <summary
              class="flex flex-col border-t border-[#ccc] p-5 select-none hover:cursor-pointer bg-[#f9f6f7]"
            >
              <h4 class="font-bold">
                <i
                  class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                ></i
                >Phần 1: Giới thiệu
              </h4>
              <p class="text-sm ms-6">3 bài giảng • 26 phút</p>
            </summary>
            <div>
              <div
                class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
              >
                <h4>Bài 1: Giới thiệu</h4>
                <p class="whitespace-nowrap">13 phút</p>
              </div>
              <div
                class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
              >
                <h4>Bài 2: Css là gì?</h4>
                <p class="whitespace-nowrap">13 phút</p>
              </div>
            </div>
          </details>
          <details class="group">
            <summary
              class="flex flex-col border-t border-[#ccc] p-5 select-none hover:cursor-pointer bg-[#f9f6f7]"
            >
              <h4 class="font-bold">
                <i
                  class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                ></i
                >Phần 1: Giới thiệu
              </h4>
              <p class="text-sm ms-6">3 bài giảng • 26 phút</p>
            </summary>
            <div>
              <div
                class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
              >
                <h4>Bài 1: Giới thiệu</h4>
                <p class="whitespace-nowrap">13 phút</p>
              </div>
              <div
                class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
              >
                <h4>Bài 2: Css là gì?</h4>
                <p class="whitespace-nowrap">13 phút</p>
              </div>
            </div>
          </details>
          <details class="group">
            <summary
              class="flex flex-col border-t border-[#ccc] p-5 select-none hover:cursor-pointer bg-[#f9f6f7]"
            >
              <h4 class="font-bold">
                <i
                  class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                ></i
                >Phần 1: Giới thiệu
              </h4>
              <p class="text-sm ms-6">3 bài giảng • 26 phút</p>
            </summary>
            <div>
              <div
                class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
              >
                <h4>Bài 1: Giới thiệu</h4>
                <p class="whitespace-nowrap">13 phút</p>
              </div>
              <div
                class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
              >
                <h4>Bài 2: Css là gì?</h4>
                <p class="whitespace-nowrap">13 phút</p>
              </div>
            </div>
          </details>
          <details class="group">
            <summary
              class="flex flex-col border-t border-[#ccc] p-5 select-none hover:cursor-pointer bg-[#f9f6f7]"
            >
              <h4 class="font-bold">
                <i
                  class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                ></i
                >Phần 1: Giới thiệu
              </h4>
              <p class="text-sm ms-6">3 bài giảng • 26 phút</p>
            </summary>
            <div>
              <div
                class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
              >
                <h4>Bài 1: Giới thiệu</h4>
                <p class="whitespace-nowrap">13 phút</p>
              </div>
              <div
                class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
              >
                <h4>Bài 2: Css là gì?</h4>
                <p class="whitespace-nowrap">13 phút</p>
              </div>
            </div>
          </details>
          <details class="group">
            <summary
              class="flex flex-col border-t border-[#ccc] p-5 select-none hover:cursor-pointer bg-[#f9f6f7]"
            >
              <h4 class="font-bold">
                <i
                  class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"
                ></i
                >Phần 1: Giới thiệu
              </h4>
              <p class="text-sm ms-6">3 bài giảng • 26 phút</p>
            </summary>
            <div>
              <div
                class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
              >
                <h4>Bài 1: Giới thiệu</h4>
                <p class="whitespace-nowrap">13 phút</p>
              </div>
              <div
                class="flex justify-between px-4 py-5 hover:bg-gray-200 hover:cursor-pointer"
              >
                <h4>Bài 2: Css là gì?</h4>
                <p class="whitespace-nowrap">13 phút</p>
              </div>
            </div>
          </details>
          </div>

        </div>
      </div>
    </main>