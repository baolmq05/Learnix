    <main>
        <?php if (!empty($_SESSION["create_cate_success"])): ?>
            <div id="alert_success" class="flex items-center w-full p-4 mb-4 text-green-800 bg-green-100 rounded-lg"
                role="alert">
                <div class="whitespace-nowrap">
                    <?= $_SESSION["create_cate_success"] ?>
                </div>
            </div>
        <?php endif ?>
        <?php if (!empty($_SESSION["create_cate_danger"])): ?>
            <div id="alert_danger" class="flex items-center w-full p-4 mb-4 text-red-800 bg-red-100 rounded-lg"
                role="alert">
                <div class="whitespace-nowrap">
                    <?= $_SESSION["create_cate_danger"] ?>
                </div>
            </div>
        <?php endif ?>
        <div class="lg:w-[50%]  mx-auto mt-20 p-10">
            <div class="flex justify-between items-center mb-10">
                <p class="text-3xl font-bold">Tạo khóa học mới</p>
                <button
                    id="openModalBtn"
                    class="py-2 border-gray-300 bg-purple-600 text-white px-2 hover:bg-purple-500 rounded-[5px] hover:bg-blue-700 hover:cursor-pointer transition">
                    Thêm chủ đề
                </button>
            </div>
            <form action="?page=teacher&action=createCourse" method="post">
                <div class="flex flex-col mt-5">
                    <label for="course_name" class="text-[1.1rem]">Tên khóa học</label>
                    <input
                        value="<?= isset($_SESSION["course_name_old"]) ? $_SESSION["course_name_old"] : "" ?>"
                        type="text"
                        name="course_name"
                        id="course_name"
                        class="border border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white"
                        placeholder="Nhập tên khóa học"
                        oninput="disabledButton()" />
                    <?php
                    if (isset($_SESSION["course_name_error"])):
                    ?>
                        <small id="name_error" class="text-red-400 font-semibold"><?= $_SESSION["course_name_error"] ?? "" ?></small>
                    <?php
                    endif;
                    ?>
                    <label for="category" class="text-[1.1rem] mt-2">Chọn chủ đề</label>
                    <select
                        name="category"
                        id="category"
                        class="border border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white"
                        onchange="disabledButton()">
                        <option value="" selected disabled>Vui lòng chọn ...</option>
                        <?php
                        foreach ($categoryList as $key => $value):
                        ?>
                            <option value="<?= $value["id"] ?? "" ?>"><?= $value["name"] ?? "" ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                    <div class="flex justify-between">
                        <a href="?page=teacher" class="px-5 border border-purple-500 bg-white text-purple-700 hover:bg-purple-700 hover:text-white py-2 rounded-[5px] mt-8 hover:cursor-pointer">Quay lại</a>
                        <button name="createCourseBtn" class="px-5 border border-gray-300 bg-purple-700 text-white hover:bg-purple-500 py-2 rounded-[5px] mt-8 hover:cursor-pointer disabled:bg-purple-300" id="continueButton" disabled>Tiếp tục</button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- Overlay -->
    <div
        id="modalOverlay"
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-300">
        <!-- Modal box -->
        <div
            id="modalBox"
            class="bg-white rounded-2xl shadow-xl w-full max-w-xl p-6 scale-90 opacity-0 transition-all duration-300">
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Thêm danh mục</h2>
                <button id="closeModalBtn" class="text-gray-500 hover:text-red-500 text-xl"></button>
            </div>

            <!-- FORM -->
            <form id="myForm" action="?page=teacher&action=createCategory" method="post" class="space-y-4">
                <div>
                    <label class="block font-medium mb-1">Tên danh mục</label>
                    <input
                        id="name"
                        type="text"
                        name="category_name"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="Nhập tên...">
                    <small id="name_error" class="text-red-400 font-semibold"></small>
                </div>

                <!-- Mô tả + CKEditor -->
                <div>
                    <label class="block font-medium mb-1">Mô tả</label>
                    <textarea id="editor" name="category_description"></textarea>
                    <small id="description_error" class="text-red-400 font-semibold"></small>
                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <button
                        type="button"
                        id="closeModalBtn2"
                        class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">
                        Đóng
                    </button>
                    <button
                        name="btn_cate_create"
                        id="saveBtn"
                        type="submit"
                        onclick="checkError(event)"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Lưu
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <script>
        const openBtn = document.getElementById("openModalBtn");
        const closeBtn = document.getElementById("closeModalBtn");
        const closeBtn2 = document.getElementById("closeModalBtn2");
        const overlay = document.getElementById("modalOverlay");
        const modalBox = document.getElementById("modalBox");

        let editorInstance;

        function openModal() {
            overlay.classList.remove("opacity-0", "pointer-events-none");
            modalBox.classList.remove("opacity-0", "scale-90");

            // Tạo CKEditor khi modal mở (tránh lỗi render khi modal hidden)
            if (!editorInstance) {
                ClassicEditor.create(document.querySelector("#editor"))
                    .then(editor => editorInstance = editor)
                    .catch(error => console.error(error));
            }
        }

        function closeModal() {
            overlay.classList.add("opacity-0", "pointer-events-none");
            modalBox.classList.add("opacity-0", "scale-90");

            const cateName = document.querySelector("#name").value = "";
            const nameError = document.querySelector("#name_error").innerHTML = "";
            const descError = document.querySelector("#description_error").innerHTML = "";

            if (typeof editorInstance !== "undefined" && editorInstance) {
                editorInstance.setData(""); // <-- reset CKEditor
            } else {
                // fallback nếu dùng textarea bình thường
                document.querySelector("#editor").value = "";
            } 
        }

        openBtn.addEventListener("click", openModal);
        closeBtn.addEventListener("click", closeModal);
        closeBtn2.addEventListener("click", closeModal);

        // Click ra ngoài modal để đóng
        overlay.addEventListener("click", (e) => {
            if (e.target === overlay) closeModal();
        });

        function checkError(event) {
            event.preventDefault(); // chặn submit mặc định để validate trước

            const form = document.getElementById("myForm");
            const saveBtn = document.getElementById("saveBtn");

            const cateName = document.querySelector("#name");
            const nameError = document.querySelector("#name_error");
            const descError = document.querySelector("#description_error");

            // Lấy nội dung CKEditor (giả sử editorInstance đã khởi tạo)
            const cateDescription = (typeof editorInstance !== "undefined" && editorInstance) ?
                editorInstance.getData().trim() :
                document.querySelector("#editor").value.trim();

            let isError = false;

            // Validate tên
            if (cateName.value.trim() === "") {
                nameError.innerText = "Không được để trống";
                isError = true;
            } else {
                nameError.innerText = "";
            }

            // Validate mô tả
            if (cateDescription === "") {
                descError.innerText = "Không được để trống";
                isError = true;
            } else {
                descError.innerText = "";
            }

            if (isError) {
                // không submit nếu có lỗi
                return false;
            }

            // Nếu browser hỗ trợ requestSubmit -> dùng nó (sẽ gửi name của button)
            if (typeof form.requestSubmit === "function") {
                // Gọi requestSubmit với tham số là nút đã bấm để PHP nhận được name/value
                form.requestSubmit(saveBtn);
                return true;
            }

            // fallback: tạo hidden input có cùng name/value như button rồi submit programmatically
            // (dành cho trình duyệt cũ không có requestSubmit)
            const existingHidden = form.querySelector("input[name='btn_cate_create'][type='hidden']");
            if (!existingHidden) {
                const hidden = document.createElement("input");
                hidden.type = "hidden";
                hidden.name = saveBtn.name || "btn_cate_create";
                // nếu button có value, dùng value, ngược lại đặt value mặc định (1)
                hidden.value = saveBtn.value || "1";
                form.appendChild(hidden);
            }
            form.submit();
            return true;
        }
    </script>

    <?php
    unset($_SESSION["course_name_error"]);
    unset($_SESSION["course_name_old"]);
    unset($_SESSION["create_cate_success"]);
    unset($_SESSION["create_cate_danger"]);
    ?>