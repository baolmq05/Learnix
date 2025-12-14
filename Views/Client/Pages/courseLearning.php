<style>
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
<?php
if (isset($_SESSION["create_review_success"])):
?>
    <div id=""
        class="alert-box flex items-center gap-2 p-4 rounded-lg 
            bg-green-100 text-green-500 border border-green-300 show">
        <span>Cập nhật bài học thành công</span>
    </div>

    <script>
        setTimeout(() => {
            document.querySelector(".alert-box").classList.remove("show");
        }, 3000);
    </script>
<?php
endif;
?>

<?php
unset($_SESSION["create_review_success"]);
?>

<section class="mx-5 mt-5 mb-10">
    <div
        class="sm:grid sm:grid-cols-5 border justify-between border-gray-300 shadow mt-2 rounded-2xl p-5 items-center">
        <div class="col-span-1 gap-3">
            <p class="text-3xl md:text-4xl font-bold sm:block hidden">Học tập</p>
            <p class="text-gray-600 mt-3 sm:block hidden">Hãy học chăm chỉ cùng Learnix nhé!</p>
        </div>
        <div class="sm:col-span-2 not-last:md:col-span-3 text-center">
            <p class="text-sm font-bold">Tổng quan tiến độ học tập của bạn</p>
            <p class="text-sm mb-4 px-2">Bạn đang có <span class="font-bold text-sm text-gray-700"><?= $countTotal["course_quantity"] ?? 0 ?></span> khóa
                học trên Learnix.</p>
        </div>
        <div class="sm:flex sm:justify-end sm:col-span-2 md:col-span-1">
            <div class="border border-gray-300 bg-white shadow rounded-2xl p-5 sm:w-9/12 md:w-8/12 ">
                <p class="md:text-xl font-bold">Tổng quan</p>
                <p class="flex justify-between font-bold text-gray-600 w-full">Đang học:<span
                        class="text-yellow-500 font-bold"><?= $countCourseLearning["course_quantity"] ?? 0 ?></span></p>
                <p class="flex justify-between font-bold text-gray-600 w-full">Hoàn thành:<span
                        class="text-green-500 font-bold"><?= $countCourseDone["course_quantity"] ?? 0 ?></span></p>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1">
        <div class="border border-gray-300 bg-white shadow mt-6 rounded-2xl p-4">
            <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                <span class="w-3 h-3 rounded-full"></span>
                Khóa đang học
            </h2>
            <!-- Foreach -->
            <?php
            if (count($enrollCourse) > 0):
                foreach ($enrollCourse as $key => $value):
            ?>
                    <div class="sm:flex justify-between border-b border-gray-400 mb-5 p-5 gap-5">
                        <div class="sm:flex">

                            <form action="?page=lesson_player" method="POST"
                                class="relative md:w-[200px] md:h-[150px] sm:w-[180px] sm:h-[150px] rounded-xl group overflow-hidden">

                                <input type="hidden" name="course_id" value="<?= $value["course_id"] ?>">

                                <button type="submit"
                                    class="absolute inset-0 w-full h-full p-0 m-0 bg-transparent border-0 cursor-pointer">

                                    <img src="./Uploads/Courses/<?= $value["course_image"] ?? "" ?>"
                                        class="w-full h-full object-cover transition-all duration-300 rounded-2xl group-hover:opacity-60">

                                    <div class="absolute inset-0 flex items-center justify-center 
                    opacity-0 group-hover:opacity-100 
                    transition-all duration-300">
                                        <div class="bg-white/80 backdrop-blur-sm p-3 rounded-full shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 24 24" class="w-8 h-8 text-neutral-900">
                                                <path d="M8 5v14l11-7z" />
                                            </svg>
                                        </div>
                                    </div>

                                </button>
                            </form>

                            <!-- TEXT INFO -->
                            <div class="ms-4">
                                <a href="?page=course_detail&id=<?= $value["course_id"] ?>">
                                    <h3 class="text-sm font-semibold mt-4 md:text-xl w-full text-justify"><?= $value["course_name"] ?></h3>
                                </a>
                                <form action="?page=teacher_profile" method="post"
                                    class="mt-2 text-gray-600 flex items-center gap-1">
                                    <input type="hidden" name="teacher_id" value="<?= $value["teacher_id"] ?>">

                                    <span class="text-nowrap sm:text-xs md:text-sm">
                                        Giảng viên:
                                    </span>

                                    <button type="submit"
                                        class="cursor-pointer font-bold sm:text-xs md:text-sm text-blue-600
                                        hover:underline hover:text-blue-700 transition">
                                        <?= htmlspecialchars($value['teacher_name']) ?>
                                    </button>
                                </form>
                                <p class="mt-2">
                                    <span class="text-sm text-gray-500 sm:text-xs md:text-sm">
                                        Đánh giá: <?= $value["course_rating"] ?? 0 ?>
                                    </span>
                                    <i class="bi bi-star-fill text-yellow-500 ms-2"></i>
                                </p>
                            </div>
                        </div>

                        <!-- PROGRESS BAR -->
                        <div class="sm:w-1/3 md:h-1/5">
                            <div class="w-full max-w-lg mt-10">
                                <div class="h-2 w-full bg-neutral-100 rounded-full overflow-hidden">
                                    <div class="h-2 bg-linear-to-r from-purple-600 via-blue-400 to-purple-600 rounded-full transition-all duration-700 ease-out"
                                        style="width: <?= $value["progress_percent"] ?? 1 ?>%;"></div>
                                </div>
                                <div class="flex justify-end gap-2 mt-2">
                                    <span class="text-xs uppercase tracking-wide text-neutral-500">hoàn thành</span>
                                    <span class="text-sm font-semibold text-neutral-900"><?= $value["progress_percent"] ?? 1 ?>%</span>
                                </div>
                            </div>
                        </div>

                        <!-- BUTTON TIẾP TỤC HỌC -->
                        <div class="flex items-start text-nowrap mt-8">
                            <form action="?page=lesson_player" method="POST">
                                <input type="hidden" name="course_id" value="<?= $value["course_id"] ?>">
                                <button class="border-2 p-3 rounded-xl text-purple-900 text-sm font-bold 
                    hover:bg-purple-500 hover:text-white transition-colors duration-300 text-xs md:text-sm">
                                    Tiếp tục học
                                </button>
                            </form>
                        </div>
                    </div>

                <?php
                endforeach;
            else:
                ?>
                <p class="ms-5">Chưa có khóa học nào</p>

            <?php
            endif;
            ?>
            <!-- End Foreach -->
        </div>
        <div class="border border-gray-300 bg-white shadow mt-6 rounded-2xl p-4">
            <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                <span class="w-3 h-3 rounded-full"></span>
                Khóa hoàn thành
            </h2>
            <div class="grid sm:grid-cols-4 gap-4">
                <?php
                if (count($enrollCourseDone) > 0):
                    foreach ($enrollCourseDone as $valueDone):
                ?>
                        <div class="sm:col-span-2 md:col-span-1">
                            <div class="border border-gray-300 bg-white shadow rounded-2xl p-4">

                                <!-- FORM POST ẢNH + HOVER -->
                                <form action="?page=lesson_player" method="POST" class="group relative w-full h-[150px] rounded-xl overflow-hidden">
                                    <input type="hidden" name="course_id" value="<?= $valueDone["course_id"] ?>">

                                    <button type="submit"
                                        class="absolute inset-0 w-full h-full p-0 m-0 border-0 bg-transparent cursor-pointer">

                                        <!-- IMAGE -->
                                        <img src="./Uploads/Courses/<?= $valueDone["course_image"] ?? "" ?>"
                                            class="w-full h-full object-cover transition-all duration-300 rounded-xl group-hover:opacity-60">

                                        <!-- HOVER PLAY ICON -->
                                        <div class="absolute inset-0 flex items-center justify-center 
                        opacity-0 group-hover:opacity-100 
                        transition-all duration-300">

                                            <div class="bg-white/80 backdrop-blur-sm p-3 rounded-full shadow-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24" class="w-8 h-8 text-neutral-900">
                                                    <path d="M8 5v14l11-7z" />
                                                </svg>
                                            </div>
                                        </div>

                                    </button>
                                </form>

                                <!-- INFO -->
                                <a href="?page=course_detail&id=<?= $valueDone["course_id"] ?>">
                                    <h3 class="text-xl font-semibold mt-4 w-full text-justify">
                                        <?= $valueDone["course_name"] ?>
                                    </h3>
                                </a>

                                <form action="?page=teacher_profile" method="post"
                                    class="mt-2 text-gray-600 flex items-center gap-1">
                                    <input type="hidden" name="teacher_id" value="<?= $valueDone['teacher_id'] ?>">

                                    <span class="text-nowrap sm:text-xs md:text-sm">
                                        Giảng viên:
                                    </span>

                                    <button type="submit"
                                        class="cursor-pointer font-bold sm:text-xs md:text-sm text-blue-600
               hover:underline hover:text-blue-700 transition">
                                        <?= htmlspecialchars($valueDone['teacher_name']) ?>
                                    </button>
                                </form>

                                <p class="mt-2">
                                    <span class="text-sm text-gray-500">Đánh giá: <?= $valueDone["course_rating"] ?></span>
                                    <i class="bi bi-star-fill text-yellow-500 ms-2"></i>
                                </p>

                                <!-- PROGRESS BAR -->
                                <div class="w-full max-w-lg mt-3">
                                    <div class="h-2 w-full bg-neutral-100 rounded-full overflow-hidden">
                                        <div class="h-2 bg-gradient-to-r from-green-500 to-green-300 rounded-full transition-all duration-700 ease-out"
                                            style="width: 100%;">
                                        </div>
                                    </div>
                                    <div class="flex justify-end gap-2 mt-2">
                                        <span class="text-sm font-semibold text-neutral-900">100%</span>
                                    </div>
                                    <div class="flex justify-start gap-1">
                                        <?php
                                        if ($this->checkHasReview($_SESSION["client"]["id"], $valueDone['course_id']) == false):
                                        ?>
                                            <button onclick="openReviewModal(<?= $valueDone['course_id'] ?>)" class="border-2 py-2 px-2 rounded-md text-blue-600 text-sm font-bold 
                                                hover:bg-blue-500 hover:text-white transition-colors duration-300 text-xs md:text-sm cursor-pointer">
                                                Đánh giá
                                            </button>
                                        <?php
                                        endif;
                                        ?>
                                        <form action="?page=lesson_player" method="post">
                                            <input type="hidden" name="course_id" value="<?= $valueDone['course_id'] ?>">
                                            <button class="border-2 py-2 px-2 rounded-md text-purple-600 text-sm font-bold 
                                                hover:bg-purple-500 hover:text-white transition-colors duration-300 text-xs md:text-sm cursor-pointer">
                                                Tiếp tục học
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach;
                else:
                    ?>
                    <p class="ms-5">Chưa có khóa học nào</p>
                <?php
                endif;
                ?>
            </div>
        </div>
</section>

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<!-- MODAL REVIEW -->
<div id="reviewModal"
    class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center">
    <div class="bg-white w-full max-w-xl rounded-xl shadow-lg p-6 relative">

        <!-- Close -->
        <button onclick="closeReviewModal()"
            class="absolute top-3 right-3 text-gray-400 hover:text-black">
            <i class="bi bi-x-lg"></i>
        </button>

        <h2 class="text-2xl font-bold mb-4 text-center">
            Nhận xét khóa học
        </h2>

        <form id="reviewForm" method="POST"
            action="?page=review-action">

            <!-- Hidden -->
            <input type="hidden" name="course_id" id="modal_course_id">
            <input type="hidden" name="rating" id="ratingInput" value="0">

            <!-- STAR -->
            <div class="flex justify-center gap-2 mb-4" id="starRating">
                <i class="bi bi-star text-3xl cursor-pointer text-gray-300" data-star="1"></i>
                <i class="bi bi-star text-3xl cursor-pointer text-gray-300" data-star="2"></i>
                <i class="bi bi-star text-3xl cursor-pointer text-gray-300" data-star="3"></i>
                <i class="bi bi-star text-3xl cursor-pointer text-gray-300" data-star="4"></i>
                <i class="bi bi-star text-3xl cursor-pointer text-gray-300" data-star="5"></i>
            </div>

            <p class="text-center text-sm text-gray-500 mb-4">
                Chọn số sao đánh giá
            </p>

            <!-- CKEditor -->
            <textarea name="content" id="reviewContent"
                class="w-full border rounded-lg p-3"
                placeholder="Chia sẻ cảm nhận của bạn..."></textarea>

            <div class="flex justify-end gap-3 mt-5">
                <button type="button" onclick="closeReviewModal()"
                    class="px-4 py-2 border rounded-lg">
                    Hủy
                </button>

                <button type="submit"
                    class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Gửi đánh giá
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let editor;
    let selectedRating = 0;

    // CKEditor
    ClassicEditor
        .create(document.querySelector('#reviewContent'))
        .then(e => editor = e)
        .catch(err => console.error(err));

    // OPEN MODAL + SET COURSE ID
    function openReviewModal(courseId) {
        document.getElementById('modal_course_id').value = courseId;
        document.getElementById('reviewModal').classList.remove('hidden');

        console.log(document.getElementById('modal_course_id').value)
        resetReviewForm();
    }

    // CLOSE
    function closeReviewModal() {
        document.getElementById('reviewModal').classList.add('hidden');
    }

    // RESET FORM KHI MỞ
    function resetReviewForm() {
        selectedRating = 0;
        document.getElementById('ratingInput').value = 0;

        document.querySelectorAll('#starRating i').forEach(star => {
            star.classList.remove('bi-star-fill', 'text-yellow-400');
            star.classList.add('bi-star', 'text-gray-300');
        });

        if (editor) editor.setData('');
    }

    // STAR CLICK
    document.querySelectorAll('#starRating i').forEach(star => {
        star.addEventListener('click', function() {
            selectedRating = this.dataset.star;
            document.getElementById('ratingInput').value = selectedRating;

            document.querySelectorAll('#starRating i').forEach((s, index) => {
                if (index < selectedRating) {
                    s.classList.add('bi-star-fill', 'text-yellow-400');
                    s.classList.remove('bi-star');
                } else {
                    s.classList.add('bi-star', 'text-gray-300');
                    s.classList.remove('bi-star-fill', 'text-yellow-400');
                }
            });
        });
    });
</script>