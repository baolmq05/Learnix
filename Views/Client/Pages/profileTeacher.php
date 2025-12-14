<!-- ================= TEACHER DETAIL PAGE ================= -->
<div class="bg-slate-50">
    <div class="max-w-7xl mx-auto px-6 py-10">
        <!-- Back button -->
        <div class="mb-6">
            <a href="javascript:history.back()"
                class="inline-flex items-center gap-2 text-lg font-medium text-slate-600
               hover:text-blue-600 transition">
                <i class="bi bi-arrow-left"></i>
                Trở về
            </a>
        </div>

        <!-- Teacher Header -->
        <div class="bg-white rounded-2xl shadow p-8 mb-10">
            <div class="flex flex-col md:flex-row gap-8">

                <!-- Avatar -->
                <img src="<?= (isset($teacherObj["avatar"]) && !empty($teacherObj["avatar"])) ? "./Uploads/Avatar/" . $teacherObj["avatar"] : "./Uploads/Avatar/default.webp" ?>"
                    class="w-40 h-40 rounded-full object-cover border mx-auto md:mx-0">

                <!-- Info -->
                <div class="flex-1 flex flex-col justify-center">
                    <h1 class="text-3xl font-bold text-slate-800">
                        <?= $teacherObj["name"] ?>
                    </h1>
                    <div>
                        <span class="font-semibold text-slate-800"><?= $teacherObj['rating'] ?></span> <i class="bi bi-star-fill text-yellow-400"></i>
                    </div>
                    <div>
                        <span class="font-semibold text-slate-800"><?= $teacherObj['students'] ?></span> học viên
                    </div>
                    <div>
                        <span class="font-semibold text-slate-800"><?= $teacherObj['courses'] ?></span> khóa học
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <!-- LEFT -->
            <div class="lg:col-span-2 space-y-10">

                <!-- About -->
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-xl font-semibold text-slate-800 mb-4">
                        Giới thiệu giảng viên
                    </h2>
                    <p class="text-slate-700 leading-relaxed">
                        <?= html_entity_decode($teacherObj["information"]) ?>
                    </p>
                </div>

                <!-- Courses -->
                <div>
                    <h2 class="text-xl font-semibold text-slate-800 mb-6">
                        Khóa học của giảng viên
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <?php
                        foreach ($teacherCourse as $courseItem):
                        ?>
                            <!-- Course item -->
                            <a href="?page=course_detail&id=<?= $courseItem["course_id"] ?>"
                                class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                                <img src="./Uploads/Courses/<?= $courseItem["course_image"] ?>"
                                    class="w-full h-44 object-cover">

                                <div class="p-4">
                                    <h3 class="font-semibold text-slate-800 line-clamp-2">
                                        <?= $courseItem["course_name"] ?>
                                    </h3>

                                    <p class="text-sm text-slate-500 mt-1">
                                        <?= $courseItem["student_quantity"] ?> học viên • <i class="bi bi-star-fill text-yellow-400"></i> <?= $courseItem["rating"] ?>
                                    </p>

                                    <div class="mt-3 flex items-center gap-2">
                                        <?php
                                        if ($courseItem["sale_price"] != 0):
                                        ?>
                                            <span class="font-bold text-slate-800"><?= number_format($courseItem["sale_price"]) ?>đ</span>
                                            <span class="text-sm text-gray-400 line-through"><?= number_format($courseItem["regular_price"]) ?>đ</span>
                                        <?php
                                        else:
                                        ?>
                                            <span class="font-bold text-slate-800">499.000₫</span>

                                        <?php
                                        endif;
                                        ?>
                                    </div>
                                </div>
                            </a>
                        <?php
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="space-y-8">

                <!-- Stats -->
                <div class="bg-white rounded-2xl shadow p-6">
                    <h3 class="font-semibold text-slate-800 mb-4">
                        Thống kê
                    </h3>

                    <ul class="space-y-3 text-sm text-slate-700">
                        <li class="flex justify-between">
                            <span>Học viên</span>
                            <span class="font-medium"><?= $teacherObj['students'] ?></span>
                        </li>
                        <li class="flex justify-between">
                            <span>Khóa học</span>
                            <span class="font-medium"><?= $teacherObj['courses'] ?></span>
                        </li>
                        <li class="flex justify-between">
                            <span>Đánh giá trung bình</span>
                            <span class="font-medium"><?= $teacherObj['rating'] ?> <i class="bi bi-star-fill text-yellow-400"></i></span>
                        </li>
                    </ul>
                </div>

                <!-- CTA -->
                <div class="bg-gradient-to-r from-purple-500 to-blue-500 rounded-2xl p-6 text-white">
                    <h3 class="font-semibold text-lg">
                        Học cùng giảng viên này
                    </h3>
                    <p class="text-sm opacity-90 mt-2">
                        Truy cập các khóa học chất lượng cao và thực tế.
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- ================= END TEACHER DETAIL PAGE ================= -->