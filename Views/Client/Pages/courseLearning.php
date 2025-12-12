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

                                <!-- FORM THAY CHO A - POST KHI CLICK HÌNH -->
                                <form action="?page=lesson_player" method="POST"
                                    class="relative md:w-[200px] md:h-[150px] sm:w-[180px] sm:h-[150px] rounded-xl group overflow-hidden">

                                    <input type="hidden" name="course_id" value="<?= $value["course_id"] ?>">

                                    <button type="submit"
                                        class="absolute inset-0 w-full h-full p-0 m-0 bg-transparent border-0 cursor-pointer">

                                        <!-- IMAGE -->
                                        <img src="./Uploads/Courses/<?= $value["course_image"] ?? "" ?>"
                                            class="w-full h-full object-cover transition-all duration-300 rounded-2xl group-hover:opacity-60">

                                        <!-- HOVER ICON -->
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
                                    <p class="text-gray-600 text-nowrap sm:text-xs md:text-sm mt-2">
                                        Giảng viên: <span class="font-bold sm:text-xs md:text-sm"><?= $value["teacher_name"] ?></span>
                                    </p>
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

                                    <p class="text-gray-600 mt-2">
                                        Giảng viên:
                                        <span class="font-bold text-sm"><?= $valueDone["teacher_name"] ?></span>
                                    </p>

                                    <p class="mt-2">
                                        <span class="text-sm text-gray-500">Đánh giá: (4.6)</span>
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