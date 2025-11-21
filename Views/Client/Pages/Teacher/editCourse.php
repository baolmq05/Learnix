    <main class="mb-4">
      <div class="bg-black text-white p-3 flex items-center justify-between sticky top-0 z-10">
        <div class="flex items-center">
          <p class="text-[1.1rem]">
            <i class="bi bi-chevron-left me-2"></i>Quay lại
          </p>
          <span class="mx-4">|</span>
          <p class="text-[1.2rem] font-bold">
            Khóa học lập trình html/css từ zero đến hero
          </p>
        </div>
      </div>
      <div
        class="lg:w-[50%] w-[90%] p-10 shadow mx-auto mt-4 border border-gray-300"
      >
        <p class="text-2xl font-bold text-center">Thông tin khóa học</p>
        <form
          action=""
          class="flex flex-col mx-auto mt-4 my-6"
          method=""
          enctype="multipart/form-data"
        >
          <label for="course_name" class="text-[1.1rem]">Tên khóa học</label>
          <input
            type="text"
            name="course_name"
            id="course_name"
            class="border border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white"
            placeholder="Nhập tên khóa học"
            value="Khóa học lập trình html/css từ zero đến hero"
          />
          <label for="category" class="text-[1.1rem] mt-2">Chọn chủ đề</label>
          <select
            name="category"
            id="category"
            class="border border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white"
          >
            <option value="1" selected>Lập trình web</option>
            <option value="2">Lập trình phần mềm</option>
            <option value="3">Lập trình mobile</option>
            <option value="4">Lập trình game</option>
          </select>
          <label for="description" class="text-[1.1rem] mt-2"
            >Mô tả khóa học</label
          >
          <textarea
            name="description"
            id="description"
            placeholder="Nhập mô tả khóa học"
            class="border border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white"
          ></textarea>
          <label for="" class="text-[1.1rem] mt-4 font-medium"
            >Học sinh sẽ học được gì trong khóa học của bạn?</label
          >
          <p>
            Bạn phải nhập ít nhất 4 mục tiêu hoặc kết quả học tập mà người học
            có thể mong đợi đạt được sau khi hoàn thành khóa học.
          </p>
          <input
            type="text"
            name="benefit[]"
            class="border mt-3 border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white"
            placeholder="Ví dụ: Xác định được vai trò và trách nhiệm của người quản lý dự án"
          />
          <input
            type="text"
            name="benefit[]"
            class="border mt-3 border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white"
            placeholder="Ví dụ: Ước tính ngân sách và thời gian của dự án"
          />
          <input
            type="text"
            name="benefit[]"
            class="border mt-3 border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white"
            placeholder="Ví dụ: Xác định và quản lý rủi ro của dự án"
          />
          <input
            type="text"
            name="benefit[]"
            class="border mt-3 border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white"
            placeholder="Ví dụ: Hoàn thành được dự án của riêng mình"
          />
          <div>
            <button
              onclick="addBenefitField()"
              id="addButtonBenefit"
              disabled
              type="button"
              class="p-2 border border-gray-300 mt-2 rounded-[5px] hover:cursor-pointer hover:bg-purple-200 text-purple-700 font-bold text-start"
            >
              Thêm trường dữ liệu
            </button>
          </div>
          <label for="" class="text-[1.1rem] mt-4 font-medium"
            >Khóa học này dành cho ai?</label
          >
          <p>
            Viết một mô tả rõ ràng về đối tượng học viên tiềm năng cho khóa học
            của bạn, những người sẽ thấy nội dung khóa học của bạn có giá trị.
          </p>
          <input
            type="text"
            name="customer_object[]"
            class="border mt-3 border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white"
            placeholder="Ví dụ: Người mới bắt đầu hoàn toàn chưa có kiến thức về lập trình"
          />
          <div>
            <button
              onclick="addCustomerObjectField()"
              id="addButtonCustomer"
              disabled
              type="button"
              class="p-2 border border-gray-300 mt-2 rounded-[5px] hover:cursor-pointer hover:bg-purple-200 text-purple-700 font-bold text-start"
            >
              Thêm trường dữ liệu
            </button>
          </div>
          <label for="" class="text-[1.1rem] mt-4">Ảnh khóa học</label>
          <label
            for="avatar"
            class="lg:w-[60%] w-full h-50 border rounded-xl flex items-center justify-center cursor-pointer overflow-hidden"
          >
            <img id="preview" class="hidden w-full h-full object-cover" />
            <span id="placeholder">Chọn ảnh</span>
          </label>
          <input type="file" id="avatar" class="hidden" accept="image/*" />
          <div class="mt-4">
            <input
              type="radio"
              name="is_free"
              id="paid"
              value="0"
              class="mt-4"
              checked
              onclick="hiddenPrice()"
            />
            <label for="paid" class="me-3">Khóa học có phí</label>
            <input
              type="radio"
              name="is_free"
              id="free"
              value="1"
              class="mt-4"
              onclick="hiddenPrice()"
            />
            <label for="free">Khóa học miễn phí</label>
          </div>
          <div class="mt-4 grid grid-cols-2 gap-3" id="boxPrice">
            <div class="flex flex-col">
              <label for="regular_price">Giá của khóa học</label>
              <input
                type="number"
                name="regular_price"
                id="regular_price"
                class="border border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white"
                placeholder="Nhập giá khóa học"
              />
            </div>
            <div class="flex flex-col">
              <label for="discounted_price">Giá khuyến mãi (nếu có)</label>
              <input
                type="number"
                name="discounted_price"
                id="discounted_price"
                class="border border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white"
                placeholder="Nhập giá khuyến mãi"
              />
            </div>
          </div>
          <button
            class="p-2 border border-gray-300 bg-purple-700 mt-3 rounded-[5px] text-white"
          >
            Lưu thông tin
          </button>
        </form>
        <label for="" class="text-[1.1rem] font-medium"
          >Chương trình giảng dạy</label
        >
        <!-- Improved Course Editor UI with TailwindCSS -->
        <div class="space-y-5 mt-3 bg-gray-50 rounded-xl">
          <!-- Chương -->
          <details
            class="p-4 bg-white border border-gray-300 rounded-xl shadow-sm"
          >
            <summary
              class="font-semibold text-lg flex justify-between items-center cursor-pointer"
            >
              Phần 1: Giới thiệu về HTML và CSS
              <div class="flex">
              <button
                onclick="toggleEditSection('1')"
                type="button"
                class="ml-2 text-blue-600 hover:text-blue-800 hover: cursor-pointer"
              >
                <i class="bi bi-pencil-fill"></i>
              </button>
              <form action="">
                <input type="hidden" name="sectionId" id="" />
                <button
                  type="submit"
                  name="deleteSection"
                  value=""
                  class="ml-2 text-red-600 hover:text-red-800 hover: cursor-pointer"
                >
                  <i class="bi bi-trash3-fill"></i>
                </button>
              </form>
              </div>

            </summary>

            <!-- Form sửa tên chương học -->
            <form
              action=""
              id="section1"
              class="hidden mt-3 rounded-lg space-y-2"
            >
              <input
                type="text"
                name="chapter_name"
                class="p-2 border rounded-md w-full"
                value="Giới thiệu về HTML và CSS"
              />
              <button class="bg-blue-600 text-white px-3 py-2 rounded-md w-fit">
                Cập nhật
              </button>
              <button
                type="button"
                onclick="toggleEditSection('1')"
                class="bg-gray-200 text-black px-3 py-2 rounded-md w-fit"
              >
                Hủy
              </button>
            </form>

            <div class="mt-3 space-y-4">
              <!-- Bài học 1 -->
              <details class="p-3 border border-gray-200 rounded-lg bg-white">
                <summary
                  class="font-medium flex justify-between items-center cursor-pointer"
                >
                  Bài 1: Tổng quan về HTML và CSS
                  <div class="flex gap-2">
                    <button
                      onclick="toggleEditLesson('1')"
                      type="button"
                      class="ml-2 text-blue-600 hover:text-blue-800 hover: cursor-pointer"
                    >
                      <i class="bi bi-pencil-fill"></i>
                    </button>
                    <form action="">
                      <input type="hidden" name="videoId" id="" />
                      <button
                        type="submit"
                        name="deleteLesson"
                        value=""
                        class="ml-2 text-red-600 hover:text-red-800 hover: cursor-pointer"
                      >
                        <i class="bi bi-trash3-fill"></i>
                      </button>
                    </form>
                  </div>
                </summary>

                <div class="mt-3 space-y-2">
                  <p><strong>Video:</strong> introduction.mp4</p>

                  <!-- Form sửa bài học -->
                  <form
                    id="lesson1"
                    class="hidden mt-3 rounded-lg space-y-2"
                    enctype="multipart/form-data"
                  >
                    <div class="space-y-1">
                      <input
                        type="text"
                        name="lesson_name"
                        class="p-2 border rounded-md w-full"
                        value="Tổng quan về HTML và CSS"
                      />
                    </div>

                    <div class="space-y-1">
                      <label class="font-medium">Cập nhật video</label>
                      <input
                        type="file"
                        name="file"
                        class="border p-2 rounded-md w-full"
                      />
                    </div>

                    <button
                      class="bg-blue-600 text-white px-3 py-2 rounded-md w-fit"
                    >
                      Lưu cập nhật
                    </button>
                    <button
                      type="button"
                      onclick="toggleEditLesson('1')"
                      class="bg-gray-200 text-black px-3 py-2 rounded-md w-fit"
                    >
                      Hủy
                    </button>
                  </form>
                </div>
              </details>
              <!-- Bài học 2 -->
              <details class="p-3 border border-gray-200 rounded-lg bg-white">
                <summary
                  class="font-medium flex justify-between items-center cursor-pointer"
                >
                  Bài 2: Cấu trúc cơ bản của HTML
                  <button
                    onclick="toggleEditLesson('2')"
                    type="button"
                    class="ml-2 text-blue-600 hover:text-blue-800 hover: cursor-pointer"
                  >
                    <i class="bi bi-pencil-fill"></i>
                  </button>
                </summary>

                <div class="mt-3 space-y-2">
                  <p><strong>Video:</strong> introduction.mp4</p>

                  <!-- Form sửa bài học -->
                  <form
                    id="lesson2"
                    class="hidden mt-3 rounded-lg space-y-2"
                    enctype="multipart/form-data"
                  >
                    <div class="space-y-1">
                      <input
                        type="text"
                        name="lesson_name"
                        class="p-2 border rounded-md w-full"
                        value="Cấu trúc cơ bản của HTML"
                      />
                    </div>

                    <div class="space-y-1">
                      <label class="font-medium">Cập nhật video</label>
                      <input
                        type="file"
                        name="file"
                        class="border p-2 rounded-md w-full"
                      />
                    </div>

                    <button
                      class="bg-blue-600 text-white px-3 py-2 rounded-md w-fit"
                    >
                      Lưu cập nhật
                    </button>
                    <button
                      type="button"
                      onclick="toggleEditLesson('2')"
                      class="bg-gray-200 text-black px-3 py-2 rounded-md w-fit"
                    >
                      Hủy
                    </button>
                  </form>
                </div>
              </details>
              <!-- Thêm bài học mới -->
              <button
                onclick="toggleAddLesson('1')"
                type="button"
                id="btnAddLesson1"
                class="p-2 border border-gray-300 mt-3 rounded-lg bg-purple-100 text-purple-700 font-medium hover:bg-purple-200"
              >
                Thêm bài học mới
              </button>
              <form
                id="newLessonForm1"
                class="hidden mt-3 rounded-lg space-y-3"
              >
                <div class="space-y-1">
                  <label class="font-medium">Tên bài học</label>
                  <input
                    type="text"
                    class="p-2 border rounded-md w-full"
                    placeholder="Nhập tên bài học"
                  />
                </div>
                <div class="space-y-1">
                  <label class="font-medium">Video bài học</label>
                  <input type="file" class="p-2 border rounded-md w-full" />
                </div>
                <button
                  class="bg-purple-700 text-white px-3 py-2 rounded-md w-fit"
                >
                  Thêm bài học
                </button>
              </form>
            </div>
          </details>
          <details
            class="p-4 bg-white border border-gray-300 rounded-xl shadow-sm"
          >
            <summary
              class="font-semibold text-lg flex justify-between items-center cursor-pointer"
            >
              Phần 2: HTML và CSS nâng cao
              <button
                onclick="toggleEditSection('2')"
                type="button"
                class="ml-2 text-blue-600 hover:text-blue-800 hover: cursor-pointer"
              >
                <i class="bi bi-pencil-fill"></i>
              </button>
            </summary>

            <!-- Form sửa tên chương học -->
            <form
              action=""
              id="section2"
              class="hidden mt-3 rounded-lg space-y-2"
            >
              <input
                type="text"
                name="chapter_name"
                class="p-2 border rounded-md w-full"
                value="Giới thiệu về HTML và CSS"
              />
              <button class="bg-blue-600 text-white px-3 py-2 rounded-md w-fit">
                Cập nhật
              </button>
              <button
                type="button"
                onclick="toggleEditSection('2')"
                class="bg-gray-200 text-black px-3 py-2 rounded-md w-fit"
              >
                Hủy
              </button>
            </form>

            <div class="mt-3 space-y-4">
              <!-- Bài học 1 -->
              <details class="p-3 border border-gray-200 rounded-lg bg-white">
                <summary
                  class="font-medium flex justify-between items-center cursor-pointer"
                >
                  Bài 1: HTML là gì ?
                  <button
                    onclick="toggleEditLesson('3')"
                    type="button"
                    class="ml-2 text-blue-600 hover:text-blue-800 hover: cursor-pointer"
                  >
                    <i class="bi bi-pencil-fill"></i>
                  </button>
                </summary>

                <div class="mt-3 space-y-2">
                  <p><strong>Video:</strong> introduction.mp4</p>

                  <!-- Form sửa bài học -->
                  <form
                    id="lesson3"
                    class="hidden mt-3 rounded-lg space-y-2"
                    enctype="multipart/form-data"
                  >
                    <div class="space-y-1">
                      <input
                        type="text"
                        name="lesson_name"
                        class="p-2 border rounded-md w-full"
                        value="HTML là gì ?"
                      />
                    </div>

                    <div class="space-y-1">
                      <label class="font-medium">Cập nhật video</label>
                      <input
                        type="file"
                        name="file"
                        class="border p-2 rounded-md w-full"
                      />
                    </div>

                    <button
                      class="bg-blue-600 text-white px-3 py-2 rounded-md w-fit"
                    >
                      Lưu cập nhật
                    </button>
                    <button
                      type="button"
                      onclick="toggleEditLesson('3')"
                      class="bg-gray-200 text-black px-3 py-2 rounded-md w-fit"
                    >
                      Hủy
                    </button>
                  </form>
                </div>
              </details>
              <!-- Bài học 2 -->
              <details class="p-3 border border-gray-200 rounded-lg bg-white">
                <summary
                  class="font-medium flex justify-between items-center cursor-pointer"
                >
                  Bài 2: CSS là gì?
                  <button
                    onclick="toggleEditLesson('4')"
                    type="button"
                    class="ml-2 text-blue-600 hover:text-blue-800 hover: cursor-pointer"
                  >
                    <i class="bi bi-pencil-fill"></i>
                  </button>
                </summary>

                <div class="mt-3 space-y-2">
                  <p><strong>Video:</strong> introduction.mp4</p>

                  <!-- Form sửa bài học -->
                  <form
                    id="lesson4"
                    class="hidden mt-3 rounded-lg space-y-2"
                    enctype="multipart/form-data"
                  >
                    <div class="space-y-1">
                      <input
                        type="text"
                        name="lesson_name"
                        class="p-2 border rounded-md w-full"
                        value="CSS là gì?"
                      />
                    </div>

                    <div class="space-y-1">
                      <label class="font-medium">Cập nhật video</label>
                      <input
                        type="file"
                        name="file"
                        class="border p-2 rounded-md w-full"
                      />
                    </div>

                    <button
                      class="bg-blue-600 text-white px-3 py-2 rounded-md w-fit"
                    >
                      Lưu cập nhật
                    </button>
                    <button
                      type="button"
                      onclick="toggleEditLesson('4')"
                      class="bg-gray-200 text-black px-3 py-2 rounded-md w-fit"
                    >
                      Hủy
                    </button>
                  </form>
                </div>
              </details>
              <!-- Thêm bài học mới -->
              <button
                onclick="toggleAddLesson('2')"
                type="button"
                id="btnAddLesson2"
                class="p-2 border border-gray-300 mt-3 rounded-lg bg-purple-100 text-purple-700 font-medium hover:bg-purple-200"
              >
                Thêm bài học mới
              </button>
              <form
                id="newLessonForm2"
                class="hidden mt-3 rounded-lg space-y-3"
              >
                <div class="space-y-1">
                  <label class="font-medium">Tên bài học</label>
                  <input
                    type="text"
                    class="p-2 border rounded-md w-full"
                    placeholder="Nhập tên bài học"
                  />
                </div>
                <div class="space-y-1">
                  <label class="font-medium">Video bài học</label>
                  <input type="file" class="p-2 border rounded-md w-full" />
                </div>
                <button
                  class="bg-purple-700 text-white px-3 py-2 rounded-md w-fit"
                >
                  Thêm bài học
                </button>
              </form>
            </div>
          </details>
        </div>

        <div id="formSection" style="display: none">
          <form action="">
            <div class="flex flex-col mt-3">
              <label for="chapter_name" class="text-[1.1rem]"
                >Tên chương học</label
              >
              <input
                type="text"
                name="section_name"
                id="section_name"
                class="border border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white"
                placeholder="Nhập tên chương học"
              />
              <button
                class="border bg-purple-700 text-white p-2 rounded-[5px] mt-2"
              >
                Thêm chương
              </button>
            </div>
          </form>
        </div>
        <div>
          <button
            onclick="hiddenFormSection()"
            type="button"
            id="buttonHiddenForm"
            class="p-2 border border-gray-300 mt-2 rounded-[5px] hover:cursor-pointer hover:bg-purple-200 text-purple-700 font-bold text-start"
          >
            Thêm chương mới
          </button>
        </div>
      </div>
    </main>