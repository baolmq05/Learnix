    <main class="relative">
        <div
            class="bg-black text-white flex items-center border-b justify-between border-white">
            <div class="p-3 flex items-center">
                <a href="?page=course_learning"><i class="bi bi-arrow-left-short text-2xl me-2"></i></a>
                <a class="hover:text-gray-300" href="?page=course_learning"><?= $courseCurrent["course_name"] ?? "" ?></a>
            </div>
            <button onclick="tutorialPopup()" class="p-2 text-white rounded mx-3 hover:cursor-pointer lg:block hidden">
                <i class="bi bi-question-circle"></i> Hướng dẫn
            </button>
        </div>
        <div class="flex">
            <div class="lg:w-[70%] w-full">
                <div class="bg-black lg:h-115 h-100" id="video-player">
                    <iframe
                        id="main_video"
                        class="mx-auto"
                        width="80%"
                        height="100%"
                        src="<?= isset($lessonCurrent) ? $urlEmbed . $lessonCurrent["video_id"] : "" ?>"
                        title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin"
                        allowfullscreen></iframe>
                </div>

                <div x-data="{ tab: 1 }" class="w-full mt-2 lg:px-16 px-6">
                    <div class="flex border-b border-gray-300">
                        <button
                            @click="tab = 1"
                            :class="tab === 1 ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500'"
                            class="py-2 px-4 hover:cursor-pointer">
                            Tổng quan
                        </button>
                        <button
                            @click="tab = 4"
                            :class="tab === 4 ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500'"
                            class="py-2 px-4 hover:cursor-pointer lg:hidden block">
                            Nội dung
                        </button>
                        <button
                            @click="tab = 2"
                            :class="tab === 2 ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500'"
                            class="py-2 px-4 hover:cursor-pointer"
                            id="tab-notes">
                            Ghi chú
                        </button>
                        <button
                            @click="tab = 3"
                            :class="tab === 3 ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500'"
                            class="py-2 px-4 hover:cursor-pointer"
                            id="tab-review">
                            Đánh giá
                        </button>
                    </div>

                    <div class="mt-4 w-full lg:w-[90%] mx-auto">
                        <div x-show="tab === 1">
                            <div class="p-3 bg-blue-50 rounded">
                                <h2 id="main_title" class="text-2xl font-bold">Bài <?= $lessonCurrent["index"] ?? "" ?>: <?= (isset($lessonCurrent) && !empty($lessonCurrent)) ? $lessonCurrent["lesson_name"] : "" ?></h2>
                                <!-- <p>Qua bài học này giúp bạn hiểu thêm về html, css là gì?</p> -->
                            </div>
                            <div class="mt-3 p-3">
                                <h2 class="text-2xl font-bold">Về khóa học này</h2>
                                <p class="flex mt-5">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                        class="size-6 text-yellow-300 me-1">
                                        <path
                                            fill-rule="evenodd"
                                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <?= $courseCurrent["rating"] ?? 0 ?> (<?= $courseCurrent["total_review"] ?? 0 ?> lượt đánh giá) · <?= $courseCurrent["total_enroll"] ?? 0 ?> lượt bán
                                </p>
                                <p class="mt-2">
                                    Được đăng bởi
                                    <a href="#" class="text-[#0000e4] ms-1"><?= $courseCurrent["instructor"] ?? '' ?></a>
                                </p>
                                <p class="mt-5 flex">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="size-6 me-1">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                    </svg>
                                    Cập nhật lần cuối: <?= $courseCurrent["updated_at"] ?? "" ?>
                                </p>
                                <div class="border border-[#6d28d2] mt-5 p-5">
                                    <h2 class="text-2xl font-medium col-span-2 mb-5">
                                        Sau khi hoàn thành khóa học, bạn sẽ:
                                    </h2>
                                    <div class="grid grid-cols-2 gap-3">
                                        <?php
                                        if (isset($benefit)):
                                            foreach ($benefit as $benefitValue):
                                        ?>
                                                <div class="flex">
                                                    <p>
                                                        <i
                                                            class="bi bi-check-square-fill text-green-500 me-2"></i>
                                                    </p>
                                                    <p><?= $benefitValue ?? "" ?></p>
                                                </div>
                                            <?php
                                            endforeach;
                                        else:
                                            ?>
                                            <div>
                                                <p>Chưa được cập nhật</p>
                                            </div>
                                        <?php
                                        endif;
                                        ?>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold mt-5">Phù hợp cho ai:</h3>
                                    <ul class="list-disc ps-5 mt-3 space-y-1">
                                        <?php
                                        if (isset($customerObject)):
                                            foreach ($customerObject as $customerValue):
                                        ?>
                                                <li><?= $customerValue ?? "" ?></li>
                                            <?php
                                            endforeach;
                                        else:
                                            ?>
                                            <div>Chưa được cập nhật</div>
                                        <?php
                                        endif;
                                        ?>
                                    </ul>
                                </div>
                                <h3 class="text-2xl font-bold mt-5 mb-3">Giảng viên</h3>
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div class="w-20 h-20 overflow-hidden">
                                            <img
                                                class="rounded-full object-cover w-full h-full"
                                                src="<?= './Uploads/Avatar/' . htmlspecialchars($courseCurrent['avatar'] ?? 'default.webp') ?>"
                                                alt="" />
                                        </div>
                                        <p class="font-bold text-2xl ms-5">
                                            <a href="#"></a>
                                        </p>
                                    </div>
                                    <div class="me-10">
                                        <p><i class="bi bi-star"></i><?= $teacherRating ?? 0 ?> sao đánh giá</p>
                                        <p><i class="bi bi-people"></i> <?= $courseCurrent["total_enroll"] ?? 0 ?> học viên</p>
                                        <p><i class="bi bi-play-circle"></i> <?= $courseCurrent["total_lesson"] ?? 0 ?> video bài học</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="tab === 2">
                            <details class="group">
                                <summary
                                    class="flex justify-between border p-3 mt-3 select-none hover:cursor-pointer bg-[#f9f6f7]">
                                    <h4 class="font-bold">
                                        <i
                                            class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"></i>Thêm ghi chú mới
                                    </h4>
                                    <i class="bi bi-plus-circle-fill"></i>
                                </summary>
                                <div class="border-x border-b p-4">
                                    <div
                                        class="flex gap-3 justify-center items-center mt-2 px-10">
                                        <span class="px-2 rounded-[20px] bg-black text-white">1:00</span>
                                        <textarea
                                            class="border border-gray-300 focus:border-blue-500 focus:ring-0 p-2 rounded w-full"
                                            rows="4"></textarea>
                                    </div>
                                    <div class="flex gap-3 justify-end items-center mt-3 px-10">
                                        <button
                                            class="py-2 px-4 hover:cursor-pointer bg-purple-700 text-white rounded-[5px]">
                                            Lưu ghi chú
                                        </button>
                                    </div>
                                </div>
                            </details>
                        </div>
                        <div x-show="tab === 3" class="p-3 rounded">
                            <p class="mt-8 mb-2 text-lg font-bold">
                                <i class="bi bi-star-fill text-yellow-400"></i> • <?= $courseCurrent["total_review"] ?? 0 ?> đánh giá
                            </p>
                            <div class="flex flex-wrap gap-5" id="review">
                                <?php
                                foreach ($reviewList as $reviewValue):
                                ?>
                                    <div class="border w-full p-5">
                                        <div class="flex gap-5">
                                            <div class="w-15 h-15">
                                                <img
                                                    class="rounded-full"
                                                    src="<?= './Uploads/Avatar/' . htmlspecialchars($reviewValue['avatar'] ?? 'default.webp') ?>"
                                                    alt="" />
                                            </div>
                                            <div>
                                                <p><?= $reviewValue["name"] ?? "" ?></p>
                                                <p class="text-xs mt-3">
                                                    <i class="bi bi-star-fill text-yellow-400"></i>
                                                    <i class="bi bi-star-fill text-yellow-400"></i>
                                                    <i class="bi bi-star-fill text-yellow-400"></i>
                                                    <i class="bi bi-star-fill text-yellow-400"></i>
                                                    <i class="bi bi-star-fill text-yellow-400"></i>
                                                    <span class="ms-2"><?= $reviewValue["updated_at"] ?? "" ?></span>
                                                </p>
                                            </div>
                                        </div>
                                        <p id="<?= $reviewValue['id'] ?>" class="mt-3 text-justify two-line-ellipsis">
                                            <?= $reviewValue["content"] ?? "" ?>
                                        </p>
                                        <button class="font-bold hover:cursor-pointer" onclick="toggleContent(<?= $reviewValue['id'] ?>)">Xem thêm</button>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <button onclick="getMoreReview()" id="buttonGetMoreReview"
                                class="text-[#6d28d2] border-[#6d28d2] border hover:bg-purple-100 hover:cursor-pointer font-bold rounded-[5px] px-10 py-2 mt-5">
                                Xem thêm bình luận
                            </button>
                        </div>
                        <!-- Responsive sidebar -->
                        <div x-show="tab === 4" class="p-3 rounded lg:hidden block">
                            <h2 class="font-bold text-2xl text-center mb-4">
                                Nội dung khóa học
                            </h2>
                            <p class="text-center">
                                <?= $courseCurrent["total_section"] ?? 0 ?> phần • <?= $courseCurrent["total_lesson"] ?? 0 ?> bài giảng • Tổng thời lượng <?= $courseCurrent["total_length"] ?? 0 ?> giờ
                            </p>
                            <?php
                            if (!empty($sectionList)):
                                foreach ($sectionList as $sectionKey => $sectionValue):
                            ?>
                                    <details class="group" <?= (!empty($lessonCurrent) && $lessonCurrent["section_id"] == $sectionValue["section_id"]) ? "open" : "" ?>>
                                        <summary
                                            class="flex flex-col border-t border-[#ccc] p-5 mt-3 select-none hover:cursor-pointer bg-[#f9f6f7]">
                                            <h4 class="font-bold">
                                                <i
                                                    class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"></i><?= $sectionValue["section_name"] ?>
                                            </h4>
                                            <p class="text-sm ms-6"><?= $sectionValue["total_lesson"] ?? 0 ?> bài giảng • <?= !empty($sectionValue["total_length"] && $sectionValue["total_length"] < 1) ? ($sectionValue["total_length"] * 60) . " phút" : ($sectionValue["total_length"] . " giờ")  ?></p>
                                        </summary>
                                        <div>
                                            <?php
                                            foreach ($lessonList as $lessonKey => $lessonValue):
                                                if ($lessonValue["section_id"] == $sectionValue["section_id"]):
                                            ?>
                                                    <div data-videoId="<?= $lessonValue["video_id"] ?? "" ?>"
                                                        data-lessonName="<?= $lessonValue["lesson_name"] ?? "" ?>"
                                                        onclick="changeVideo(this)"

                                                        class=" flex justify-between items-center px-4 py-5 hover:bg-gray-200 hover:cursor-pointer lesson_container
                                                        <?=
                                                        ($lessonValue["enroll_lesson_status"] == 1 ? 'bg-blue-100' : '') .
                                                            (!empty($lessonCurrent) && $lessonCurrent["lesson_id"] == $lessonValue["lesson_id"] ? 'bg-gray-300' : '')
                                                        ?>">

                                                        <!-- Bên trái -->
                                                        <div class="flex items-center space-x-3">
                                                            <!-- Checkbox hiển thị trạng thái hoàn thành (disabled) -->
                                                            <input
                                                                type="checkbox"
                                                                class="w-5 h-5 cursor-not-allowed"
                                                                <?= $lessonValue["enroll_lesson_status"] == 1 ? "checked" : "" ?>
                                                                onclick="event.stopPropagation()" />

                                                            <!-- Tên bài học -->
                                                            <h4>
                                                                <?= $lessonValue["lesson_name"] ?>
                                                            </h4>
                                                        </div>

                                                        <!-- Thời lượng -->
                                                        <p class="whitespace-nowrap">
                                                            <?= $this->formatLessonLength($lessonValue["lesson_length"]) ?>
                                                        </p>
                                                    </div>
                                            <?php
                                                endif;
                                            endforeach;
                                            ?>
                                        </div>
                                    </details>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="w-[30%] border-s max-h-screen sticky top-0 right-0 border-[#ccc] lg:block hidden">
                <h2 class="font-bold text-2xl text-center my-4">Nội dung khóa học</h2>
                <p class="text-center">
                    <?= $courseCurrent["total_section"] ?? 0 ?> phần • <?= $courseCurrent["total_lesson"] ?? 0 ?> bài giảng • Tổng thời lượng <?= $courseCurrent["total_length"] ?? 0 ?> giờ
                </p>
                <div class="max-h-160 overflow-y-auto">
                    <?php
                    if (!empty($sectionList)):
                        foreach ($sectionList as $sectionKey => $sectionValue):
                    ?>
                            <details class="group" <?= (!empty($lessonCurrent) && $lessonCurrent["section_id"] == $sectionValue["section_id"]) ? "open" : "" ?>>
                                <summary
                                    class="flex flex-col border-t border-[#ccc] p-5 mt-3 select-none hover:cursor-pointer bg-[#f9f6f7]">
                                    <h4 class="font-bold">
                                        <i
                                            class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"></i><?= $sectionValue["section_name"] ?>
                                    </h4>
                                    <p class="text-sm ms-6"><?= $sectionValue["total_lesson"] ?? 0 ?> bài giảng • <?= !empty($sectionValue["total_length"] && $sectionValue["total_length"] < 1) ? ($sectionValue["total_length"] * 60) . " phút" : ($sectionValue["total_length"] . " giờ")  ?></p>
                                </summary>
                                <div>
                                    <?php
                                    foreach ($lessonList as $lessonKey => $lessonValue):
                                        if ($lessonValue["section_id"] == $sectionValue["section_id"]):
                                    ?>
                                            <div data-videoId="<?= $lessonValue["video_id"] ?? "" ?>"
                                                data-lessonName="<?= $lessonValue["lesson_name"] ?? "" ?>"
                                                onclick="changeVideo(this)"
                                                id="lesson-<?php if (($lessonKey + 1) == 1) {echo "one";} else if (($lessonKey + 1) == 2) {echo "two";} else {echo "three" . $lessonKey;}?>"
                                                class="flex justify-between items-center px-4 py-5 hover:bg-gray-200 hover:cursor-pointer lesson_container
                                                <?=
                                                ($lessonValue["enroll_lesson_status"] == 1 ? 'bg-blue-100' : '') .
                                                    (!empty($lessonCurrent) && $lessonCurrent["lesson_id"] == $lessonValue["lesson_id"] ? 'bg-gray-300' : '')
                                                ?>">

                                                <!-- Bên trái -->
                                                <div class="flex items-center space-x-3">
                                                    <!-- Checkbox hiển thị trạng thái hoàn thành (disabled) -->
                                                    <input
                                                        type="checkbox"
                                                        class="w-5 h-5 cursor-not-allowed"
                                                        <?= $lessonValue["enroll_lesson_status"] == 1 ? "checked" : "" ?>
                                                        onclick="event.stopPropagation()" />

                                                    <!-- Tên bài học -->
                                                    <h4>
                                                        <?= $lessonValue["lesson_name"] ?>
                                                    </h4>
                                                </div>

                                                <!-- Thời lượng -->
                                                <p class="whitespace-nowrap">
                                                    <?= $this->formatLessonLength($lessonValue["lesson_length"]) ?>
                                                </p>
                                            </div>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </div>
                            </details>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
        <!-- Intro modal shown before starting the guide -->
        <div id="intro-modal-backdrop" class="fixed inset-0 bg-black/40 hidden z-1100 items-center justify-center">
            <div id="intro-modal" class="bg-white rounded-lg shadow-lg max-w-xl  w-11/12 p-6 mx-auto ">
                <h2 class="text-xl font-bold mb-2">Chào mừng đến Learnix</h2>
                <p class="text-sm text-gray-700 mb-4">Chào mừng bạn! Mình sẽ hướng dẫn bạn cách để học trên hệ thống Learnix nhé!</p>
                <div class="flex justify-end gap-2">
                    <button id="intro-cancel" class="py-2 px-4 bg-gray-200 rounded hover:cursor-pointer">Hủy</button>
                    <button id="intro-start" class="py-2 px-4 bg-blue-600 text-white rounded hover:cursor-pointer">Bắt đầu hướng dẫn</button>
                </div>
            </div>
        </div>
    </main>
    <!-- Overlay che toàn màn hình -->
    <div
        id="guide-overlay"
        class="fixed inset-0 bg-black/30 hidden z-1000"></div>

    <!-- Khung highlight phát sáng khu vực được chọn -->
    <div
        id="guide-highlight"
        class="fixed border-3 border-yellow-400 rounded-l pointer-events-none hidden z-1001 transition-all duration-300"></div>

    <!-- Tooltip -->
    <div
        id="guide-tooltip"
        class="fixed bg-white p-4 rounded-lg shadow-lg w-72 hidden z-1002 transition-all duration-300">
        <h3 id="guide-title" class="font-bold text-lg"></h3>
        <p id="guide-desc" class="mt-2 text-sm text-gray-700"></p>
        <button
            id="guide-next"
            class="mt-3 bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 hover:cursor-pointer">
            Tiếp tục
        </button>
    </div>

    <script>
        let start = <?= count($reviewList) ?>;
        let limit = 3;

        function getMoreReview() {
            $.ajax({
                url: 'Controllers/Client/Ajax/AjaxGetMoreReview.php',
                type: 'GET',
                data: {
                    courseId: <?= $courseId ?>,
                    start: start,
                    limit: limit
                },
                success: function(response) {
                    $('#review').append(response);
                    start += limit;
                    console.log(start);
                    document.getElementById('buttonGetMoreReview').scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    if ($('#no-more-reviews').length) {
                        document.getElementById('buttonGetMoreReview').style.display = 'none';
                    }
                    console.log('Đã tải thêm bình luận thành công');
                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi (nếu có)
                    console.error(error);
                }
            })
        }

        function toggleContent(reviewId) {
            const paragraph = document.getElementById(reviewId);
            const button = paragraph.nextElementSibling;

            paragraph.classList.toggle('expanded');

            if (paragraph.classList.contains('expanded')) {
                button.textContent = 'Thu gọn';
            } else {
                button.textContent = 'Xem thêm';
            }
        }

        function changeVideo(lessonCurrent) {
            let lessonContainerList = document.querySelectorAll(".lesson_container");

            lessonContainerList.forEach(element => {
                element.classList.remove("bg-gray-300");
            });

            lessonCurrent.classList.add('bg-gray-300');
            const videoId = lessonCurrent.getAttribute('data-videoId');
            const lessonName = lessonCurrent.querySelector("h4");

            // Change main video
            let mainVideo = document.querySelector("#main_video");
            mainVideo.src = "https://iframe.mediadelivery.net/embed/561446" + "/" + videoId + "?loop=false&muted=false&preload=true&responsive=true";

            // Change Title
            let lessonTitle = document.querySelector("#main_title");
            lessonTitle.innerText = lessonName.innerText;

            scrollToTop();
        }

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>