    <style>
        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .animate-shimmer {
            animation: shimmer 1.8s infinite;
        }

        /* Video Demo */
        .video-popup {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 99999;
        }

        /* Ẩn popup */
        .video-popup.hidden {
            display: none;
        }

        .video-wrapper {
            position: relative;
            width: 80%;
            max-width: 900px;
            height: 80%;
            background: #000;
            border-radius: 12px;
            overflow: hidden;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.6);
            border: none;
            color: white;
            font-size: 25px;
            cursor: pointer;
            z-index: 10;
            padding: 5px 10px;
            border-radius: 6px;
        }

        /* Video */
        #popupVideo {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Mobile Fullscreen */
        @media (max-width: 768px) {
            .video-wrapper {
                width: 100%;
                height: 100%;
                border-radius: 0;
            }

            #popupVideo {
                width: 100%;
                height: 100%;
                object-fit: contain;
            }

            .close-btn {
                font-size: 30px;
                top: 20px;
                right: 20px;
            }
        }

        /* Alert */
        .alert {
            position: fixed;
            top: 65px;
            right: 0;
            max-width: 400px;
            transition: all 0.3s ease-in-out;
            animation: alert_anim 0.5s linear 0s 1 forwards;
            z-index: 1000;
        }

        @keyframes alert_anim {
            0% {
                right: -300px;
            }

            100% {
                right: 0px;
            }
        }

        /* ALERT LESSON */
        /* Alert riêng cho update lesson */
        .alert-box {
            position: fixed;
            top: 65px;
            right: -350px;
            /* Bắt đầu ẩn */
            max-width: 400px;
            transition: right 0.35s ease-in-out;
            z-index: 9999;
        }

        .alert-box.show {
            right: 0;
            /* Hiện alert */
        }
    </style>

    <main class="mb-4">
        <?php if (isset($_SESSION["update_success"])): ?>
            <div id="alert_success" class="alert flex items-center gap-2 p-4 rounded-lg bg-green-100 text-green-700 border border-green-300">
                <span><?= $_SESSION["update_success"] ?? "" ?></span>
            </div>

            <script>
                setTimeout(() => {
                    document.querySelector("#alert_success")?.remove();
                }, 3000);
            </script>
        <?php endif; ?>

        <?php if (isset($_SESSION["create_course_success"])): ?>
            <div id="alert_success" class="alert flex items-center gap-2 p-4 rounded-lg bg-green-100 text-green-700 border border-green-300">
                <span><?= $_SESSION["create_course_success"] ?? "" ?></span>
            </div>
            <script>
                setTimeout(() => {
                    document.querySelector("#alert_success")?.remove();
                }, 3000);
            </script>
        <?php endif; ?>

        <div id="alert_danger" class="hidden alert flex items-center gap-2 p-4 rounded-lg bg-red-100 text-red-400 border border-red-300">
            <span>Cập nhật thất bại</span>
        </div>


        <!-- LESSON ALERT -->
        <div id="alert_update_lesson"
            class="alert-box hidden flex items-center gap-2 p-4 rounded-lg 
            bg-green-100 text-green-500 border border-green-300">
            <span>Cập nhật bài học thành công</span>
        </div>

        <div class="bg-black text-white p-3 flex items-center justify-between sticky top-0 z-1">
            <div class="flex items-center">
                <a href="?page=teacher" class="text-[1.1rem]">
                    <i class="bi bi-chevron-left me-2"></i>Quay lại
                </a>
                <span class="mx-4">|</span>
                <p class="text-[1.2rem] font-bold">
                    <?= $courseResult["course_name"] ?>
                </p>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row justify-between items-start gap-6 px-3">
            <div class="lg:basis-1/2 w-full p-6 lg:p-10 rounded-md shadow mx-auto mt-4 border border-gray-300">
                <p class="text-2xl font-bold text-center">Thông tin khóa học</p>
                <form
                    id="form_infor_course"
                    action="?page=teacher&action=updateCourse"
                    class="flex flex-col mx-auto mt-4 my-6"
                    method="post"
                    enctype="multipart/form-data">
                    <label for="course_name" class="text-[1.1rem]">Tên khóa học</label>
                    <input type="hidden" name="course_id" value="<?= $courseId ?? "" ?>">
                    <input
                        type="text"
                        name="course_name"
                        id="course_name"
                        class="border border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white"
                        placeholder="Nhập tên khóa học"
                        value="<?= $courseResult["course_name"] ?? "Tên khóa học" ?>" />
                    <small id="course_name_error" class="text-red-400 font-semibold"></small>
                    <label for="category" class="text-[1.1rem] mt-2">Chọn chủ đề</label>
                    <select
                        name="category_id"
                        id="category"
                        class="border border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white">
                        <?php
                        foreach ($categoryList as $key => $value):
                        ?>
                            <option <?= $value["id"] == $courseResult["category_id"] ? "selected" : "" ?> value="<?= $value["id"] ?? "" ?>"><?= $value["name"] ?? "" ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                    <small id="category_error" class="text-red-400 font-semibold"></small>
                    <label for="description" class="text-[1.1rem] mt-2">Mô tả khóa học</label>
                    <textarea
                        value="<?= $courseResult["description"] ?? "" ?>"
                        name="description"
                        id="description"
                        placeholder="Nhập mô tả khóa học"
                        class="border border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white">
                        <?= $courseResult["description"] ?? "" ?>
                    </textarea>
                    <small id="description_error" class="text-red-400 font-semibold block "></small>
                    <label for="" class="text-[1.1rem] mt-4 font-medium">Học sinh sẽ học được gì trong khóa học của bạn?</label>
                    <p>
                        Bạn phải nhập ít nhất 4 mục tiêu hoặc kết quả học tập mà người học
                        có thể mong đợi đạt được sau khi hoàn thành khóa học.
                    </p>
                    <!-- Benefit -->
                    <?php
                    if (!empty($benefitCurrent)):
                        foreach ($benefitCurrent as $benefitValue):
                    ?>
                            <input
                                value="<?= $benefitValue ?>"
                                type="text"
                                name="benefit[]"
                                class="border mt-3 border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white benefit"
                                placeholder="Ví dụ: Xác định được vai trò và trách nhiệm của người quản lý dự án" />
                        <?php
                        endforeach;
                    else:
                        ?>
                        <input
                            value="<?= $benefitValue ?? "" ?>"
                            type="text"
                            name="benefit[]"
                            class="border mt-3 border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white benefit"
                            placeholder="Ví dụ: Xác định được vai trò và trách nhiệm của người quản lý dự án" />
                    <?php
                    endif;
                    ?>

                    <div>
                        <small class="text-red-400 font-semibold benefit-error block"></small>
                        <button
                            onclick="addBenefitField()"
                            id="addButtonBenefit"

                            type="button"
                            class="p-2 border border-gray-300 mt-2 rounded-[5px] hover:cursor-pointer hover:bg-purple-200 text-purple-700 font-bold text-start">
                            Thêm trường dữ liệu
                        </button>
                    </div>
                    <label for="" class="text-[1.1rem] mt-4 font-medium">Khóa học này dành cho ai?</label>
                    <p>
                        Viết một mô tả rõ ràng về đối tượng học viên tiềm năng cho khóa học
                        của bạn, những người sẽ thấy nội dung khóa học của bạn có giá trị.
                    </p>
                    <?php
                    if (!empty($customerObjCurrent)):
                        foreach ($customerObjCurrent as $customerValue):
                    ?>
                            <input
                                value="<?= $customerValue ?? "" ?>"
                                type="text"
                                name="customer_object[]"
                                class="border mt-3 border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white customer_object"
                                placeholder="Ví dụ: Người mới bắt đầu hoàn toàn chưa có kiến thức về lập trình" />
                        <?php
                        endforeach;
                    else:
                        ?>
                        <input
                            value="<?= $customerValue ?? "" ?>"
                            type="text"
                            name="customer_object[]"
                            class="border mt-3 border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white customer_object"
                            placeholder="Ví dụ: Người mới bắt đầu hoàn toàn chưa có kiến thức về lập trình" />
                    <?php
                    endif;
                    ?>
                    <div>
                        <small class="text-red-400 block font-semibold customerObj-error"></small>
                        <button
                            onclick="addCustomerObjectField()"
                            id="addButtonCustomer"
                            <?= isset($customerObjCurrent) ? (count($customerObjCurrent) > 0 ? "" : "disabled") : "" ?>
                            type="button"
                            class="p-2 border border-gray-300 mt-2 rounded-[5px] hover:cursor-pointer hover:bg-purple-200 text-purple-700 font-bold text-start">
                            Thêm trường dữ liệu
                        </button>
                    </div>
                    <label for="" class="text-[1.1rem] mt-4">Ảnh khóa học</label>
                    <label
                        for="avatar"
                        class="lg:w-[60%] w-full h-50 border rounded-xl flex items-center justify-center cursor-pointer overflow-hidden">
                        <img class="image-preview" src='<?= (isset($courseResult["image"]) && !empty($courseResult["image"])) ? "./Uploads/Courses/" . $courseResult["image"] : "" ?>'
                            id="preview"
                            class="<?= (isset($courseResult["image"]) && !empty($courseResult["image"])) ? "" : "hidden" ?> w-full h-full object-cover" />
                        <span class="<?= (isset($courseResult["image"]) && !empty($courseResult["image"])) ? "hidden" : "" ?>" id="placeholder">Chọn ảnh</span>
                    </label>
                    <input type="file" id="avatar" name="image" class="hidden" accept="image/*" />
                    <input type="hidden" value="<?= $courseResult["image"] ?? "" ?>" name="imageCurrent" />
                    <small class="text-red-400 block font-semibold"><?= $_SESSION["error_file_type"] ?? "" ?></small>
                    <small class="text-red-400 block font-semibold" id="image_error"></small>

                    <div class="mt-5 grid grid-cols-2 gap-3" id="boxPrice">
                        <div class="flex flex-col">
                            <label for="regular_price">Giá của khóa học</label>
                            <input
                                value="<?= (isset($courseResult["regular_price"]) && !empty($courseResult["regular_price"])) ? $courseResult["regular_price"] : "" ?>"
                                type="number"
                                name="regular_price"
                                id="regular_price"
                                class="border border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white"
                                placeholder="Nhập giá khóa học" />
                            <small class="text-red-400 font-semibold block" id="regular_error"></small>
                        </div>
                        <div class="flex flex-col">
                            <label for="discounted_price">Giá khuyến mãi (nếu có)</label>
                            <input
                                value="<?= (isset($courseResult["sale_price"]) && !empty($courseResult["sale_price"])) ? $courseResult["sale_price"] : "" ?>"
                                type="number"
                                name="discounted_price"
                                id="discounted_price"
                                class="border border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white"
                                placeholder="Nhập giá khuyến mãi" />
                            <small class="text-red-400 font-semibold block" id="discounted_error"></small>
                        </div>
                    </div>
                    <input type="hidden" name="status" value="<?= isset($courseResult["status"]) ? $courseResult["status"] : "" ?>">
                    <button
                        class="p-2 border border-gray-300 bg-purple-700 mt-3 rounded-[5px] text-white">
                        Lưu thông tin
                    </button>
                </form>
            </div>

            <div class="lg:basis-1/2 w-full p-6 lg:p-10 shadow rounded-md mt-4 border border-gray-300">
                <p for="" class="text-2xl font-bold text-center mb-5">Chương trình giảng dạy</p>
                <div id="section_container" class="space-y-5 mt-3 bg-gray-50 rounded-xl">
                    <!-- ========================= Chương ========================== -->
                    <?php
                    foreach ($sectionResult as $key => $value):
                    ?>
                        <details
                            class="p-4 bg-white border border-gray-300 rounded-xl shadow-sm">
                            <summary class="font-semibold summary text-lg flex justify-between items-center cursor-pointer">
                                <h2 class="section_name_title"><?= $value["section_name"] ?? "" ?></h2>
                                <div class="flex">
                                    <button
                                        onclick="toggleEditSection(<?= $value['id'] ?>)"
                                        type="button"
                                        class="ml-2 text-blue-600 hover:text-blue-800 hover: cursor-pointer">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    <form action="">
                                        <input type="hidden" class="section_id" value="<?= $value["id"] ?>" name="sectionId" id="" />
                                        <button
                                            type="button"
                                            onclick="processDeleteSection(this)"
                                            name="deleteSection"
                                            value=""
                                            class="ml-2 text-red-600 hover:text-red-800 hover: cursor-pointer">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </summary>

                            <form
                                action=""
                                id="section<?= $value['id'] ?>"
                                class="hidden mt-3 rounded-lg space-y-2">
                                <input type="hidden" value="<?= $courseId ?>">
                                <input required
                                    type="text"
                                    name="chapter_name"
                                    class="p-2 border rounded-md w-full"
                                    value="<?= $value['section_name'] ?>" />
                                <small class="text-red-400 block"></small>
                                <input class="section_id" type="hidden" value="<?= $value["id"] ?>">
                                <button type="button" onclick="updateSection(this)" class="cursor-pointer bg-blue-600 text-white px-3 py-2 rounded-md w-fit">
                                    Cập nhật
                                </button>
                                <button
                                    type="button"
                                    onclick="toggleEditSection(<?= $value['id'] ?>)"
                                    class="cursor-pointer bg-gray-200 text-black px-3 py-2 rounded-md w-fit">
                                    Hủy
                                </button>
                            </form>

                            <div class="mt-3 space-y-4">
                                <div id="lessonContainer<?= $value['id'] ?>" class="mt-3 space-y-4">
                                    <?php
                                    foreach ($lessonResult as $lessionKey => $lessionValue):
                                        if ($lessionValue["section_id"] != $value["id"]) continue;
                                    ?>
                                        <details class="p-3 border border-gray-200 rounded-lg bg-white">
                                            <summary
                                                class="font-medium flex justify-between items-center cursor-pointer">
                                                <p class="lesson_name"><?= $lessionValue["lesson_name"] ?? "Lỗi" ?></p>
                                                <div class="flex gap-2">
                                                    <button
                                                        onclick="toggleEditLesson(<?= $lessionValue['id'] ?>)"
                                                        type="button"
                                                        class="ml-2 text-blue-600 hover:text-blue-800 hover: cursor-pointer">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                    <form action="">
                                                        <input type="hidden" name="videoId" id="" />
                                                        <button
                                                            type="button"
                                                            name="deleteLesson"
                                                            value=""
                                                            onclick="processDeleteLesson(this)"
                                                            class="ml-2 text-red-600 hover:text-red-800 hover: cursor-pointer">
                                                            <i class="bi bi-trash3-fill"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </summary>

                                            <div class="mt-3 space-y-2">
                                                <p class="video_name_class"><strong>Video:</strong> <?= !empty($lessionValue["video_name"]) ? $lessionValue["video_name"] : "video.mp4" ?></p>
                                                <button
                                                    type="button"
                                                    class="bg-purple-500 text-white p-2 hover:opacity-[0.8] rounded-sm review_btn"
                                                    onclick="openVideoPopup(`<?= $lessionValue['video_id'] ?>`)">
                                                    Xem trước
                                                </button>
                                                <form
                                                    id="lesson<?= $lessionValue['id'] ?>"
                                                    class="hidden mt-3 rounded-lg space-y-2"
                                                    enctype="multipart/form-data">
                                                    <div class="space-y-1">
                                                        <label class="font-medium">Cập nhật tên bài học</label>
                                                        <input
                                                            type="text"
                                                            name="lesson_name_update"
                                                            class="p-2 border rounded-md w-full lesson_name_update"
                                                            value="<?= $lessionValue['lesson_name'] ?? "" ?>" />
                                                        <small class="text-red-400 name_lesson_error w-full"></small>
                                                    </div>

                                                    <div class="space-y-1">
                                                        <label class="font-medium">Cập nhật video</label>
                                                        <input
                                                            type="file"
                                                            name="file"
                                                            class="border p-2 rounded-md w-full lesson_video_update" />
                                                        <small class="text-red-400 video_lesson_error w-full"></small>
                                                        <input type="hidden" class="lesson_id_update" value="<?= $lessionValue["id"] ?>">
                                                        <input type="hidden" class="video_id_update" value="<?= $lessionValue["video_id"] ?>">
                                                    </div>

                                                    <div style="display: none;" class="message-success text-green-400 font-medium">
                                                        <span>Hoàn thành</span>
                                                    </div>

                                                    <div style="display: none;" class="w-full relative main-progress">
                                                        <!-- Text phần trăm nằm trên cùng -->
                                                        <div class="absolute inset-0 flex items-center justify-center z-20 pointer-events-none">
                                                            <span class="progressText text-sm font-semibold text-white">
                                                                60%
                                                            </span>
                                                        </div>

                                                        <!-- Progress bar -->
                                                        <div
                                                            class="progressBar relative h-5 bg-gray-200 rounded-full overflow-hidden"
                                                            style="--value: 60;">
                                                            <!-- Progress value -->
                                                            <div
                                                                class="h-full bg-green-400 rounded-full relative overflow-hidden transition-all duration-500 ease-out"
                                                                style="width: calc(var(--value) * 1%);">
                                                                <!-- Shimmer -->
                                                                <div
                                                                    class="absolute inset-0 animate-shimmer z-0"
                                                                    style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="flex justify-between items-center">
                                                        <div>
                                                            <button type="button"
                                                                onclick="processUpdateLesson(this)"
                                                                class="bg-blue-600 text-white px-3 py-2 rounded-md w-fit">
                                                                Lưu cập nhật
                                                            </button>
                                                            <button
                                                                type="button"
                                                                onclick="toggleEditLesson(<?= $lessionValue['id'] ?>)"
                                                                class="bg-gray-200 text-black px-3 py-2 rounded-md w-fit">
                                                                Hủy
                                                            </button>
                                                        </div>
                                                        <div style="display: none;" class="spinner w-6 h-6 border-4 border-gray-200 border-t-green-600 rounded-full animate-spin" role="status" aria-label="Loading">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </details>
                                    <?php
                                    endforeach;
                                    ?>
                                </div>

                                <button
                                    onclick="toggleAddLesson(<?= $value['id'] ?>)"
                                    type="button"
                                    id="btnAddLesson<?= $value['id'] ?>"
                                    class="p-2 border border-gray-300 mt-3 rounded-lg bg-purple-100 text-purple-700 font-medium hover:bg-purple-200">
                                    Thêm bài học mới
                                </button>

                                <form enctype="multipart/form-data"
                                    id="newLessonForm<?= $value['id'] ?>"
                                    class="hidden mt-3 rounded-lg space-y-3">
                                    <div class="space-y-1">
                                        <label class="font-medium lesson_title">Tên bài học</label>
                                        <input
                                            type="text"
                                            class="p-2 border rounded-md w-full input_lesson_name"
                                            placeholder="Nhập tên bài học" />
                                        <small class="text-red-400 name_lesson_error w-full"></small>
                                        <input type="hidden" class="input_section_id" value="<?= $value['id'] ?? '' ?>">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="font-medium">Video bài học</label>
                                        <input type="file" class="p-2 border rounded-md w-full input_lesson_file" />
                                        <small class="text-red-400 video_lesson_error w-full"></small>
                                    </div>

                                    <div style="display: none;" class="message-success text-green-400 font-medium">
                                        <span>Hoàn thành</span>
                                    </div>

                                    <div style="display: none;" class="w-full relative main-progress">
                                        <!-- Text phần trăm nằm trên cùng -->
                                        <div class="absolute inset-0 flex items-center justify-center z-20 pointer-events-none">
                                            <span class="progressText text-sm font-semibold text-white">
                                                60%
                                            </span>
                                        </div>

                                        <!-- Progress bar -->
                                        <div
                                            class="progressBar relative h-5 bg-gray-200 rounded-full overflow-hidden"
                                            style="--value: 60;">
                                            <!-- Progress value -->
                                            <div
                                                class="h-full bg-green-400 rounded-full relative overflow-hidden transition-all duration-500 ease-out"
                                                style="width: calc(var(--value) * 1%);">
                                                <!-- Shimmer -->
                                                <div
                                                    class="absolute inset-0 animate-shimmer z-0"
                                                    style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-between items-center">
                                        <button type="button" onclick="processCreateLesson(this)"
                                            class="bg-purple-700 text-white px-3 py-2 rounded-md w-fit">
                                            Thêm bài học
                                        </button>
                                        <div style="display: none;" class="spinner w-6 h-6 border-4 border-gray-200 border-t-green-600 rounded-full animate-spin" role="status" aria-label="Loading">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </details>
                    <?php
                    endforeach;
                    ?>
                </div>

                <div id="formSection" style="display: none">
                    <form>
                        <div class="flex flex-col mt-3">
                            <label for="chapter_name" class="text-[1.1rem]">Tên chương học</label>
                            <input
                                type="text"
                                name="section_name"
                                id="section_name"
                                class="section_name border border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white"
                                placeholder="Nhập tên chương học" />
                            <input type="hidden" class="course_id" value="<?= $courseResult["id"] ?? '' ?>" name="">
                            <button type="button" onclick="processCreateSection(this)"
                                class="border bg-purple-700 text-white p-2 rounded-[5px] mt-2">
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
                        class="p-2 border border-gray-300 mt-2 rounded-[5px] hover:cursor-pointer hover:bg-purple-200 text-purple-700 font-bold text-start">
                        Thêm chương mới
                    </button>
                </div>
            </div>
        </div>
    </main>

    <div id="videoPopup" class="video-popup hidden">
        <div class="video-wrapper">
            <button class="close-btn" onclick="closeVideoPopup()">✕</button>
            <iframe
                id="popupIframe"
                width="100%"
                height="100%"
                allow="autoplay; encrypted-media"
                allowfullscreen
                frameborder="0"></iframe>
        </div>
    </div>

    <!-- CKEDITOR -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

        function openVideoPopup(videoId) {
            const popup = document.getElementById("videoPopup");
            const iframe = document.getElementById("popupIframe");
            const url = "https://iframe.mediadelivery.net/embed/561446/";

            let didLoad = false;

            iframe.onload = function() {
                didLoad = true;
            };

            iframe.src = url + videoId;
            popup.classList.remove("hidden");
        }

        function closeVideoPopup() {
            const popup = document.getElementById("videoPopup");
            const iframe = document.getElementById("popupIframe");

            iframe.src = ""; // reset iframe → ngừng video

            popup.classList.add("hidden");
        }
    </script>
    <!-- JQUERY AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./Assets/Client/js/courses/sectionProcessAjax.js"></script>
    <script src="./Assets/Client/js/courses/lessonProcessAjax.js"></script>
    <script src="./Assets/Client/js/courses/checkUpdateCourse.js"></script>

    <?php
    unset($_SESSION["error_file_type"]);
    unset($_SESSION["update_success"]);
    unset($_SESSION["create_course_success"]);
    ?>