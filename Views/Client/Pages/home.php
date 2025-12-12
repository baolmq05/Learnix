<?php
$success = $_SESSION['login_success'] ?? '';
$logOutSuccess = $_SESSION['logout_success'] ?? '';
unset($_SESSION['login_success']);
unset($_SESSION['logout_success']);
?>
<?php if (!empty($success)): ?>
    <div id="alert_success" class="flex items-center w-full p-4 mb-4 text-green-800 bg-green-100 rounded-lg z-11"
        role="alert">
        <div>
            <?= $success ?>
        </div>
    </div>
<?php endif ?>
<?php if (!empty($logOutSuccess)): ?>
    <div id="alert_success" class="flex items-center w-full p-4 mb-4 text-red-800 bg-red-100 rounded-lg z-11" role="alert">
        <div>
            <?= $logOutSuccess ?>
        </div>
    </div>
<?php endif ?>
<main class="px-5">

    <?php if ($_SESSION['client'] ?? false): ?>
        <section class="flex gap-5 my-10 items-center">
            <div class=" bg-black text-white px-5 box-border font-bold text-2xl py-5 rounded-[50%]">LX</div>
            <div class="p-3 background-">
                <h3 class="text-2xl font-bold">Chào mừng bạn trở lại <span
                        class="font-bold text-blue-600"><?php echo $_SESSION['client']['name'] ?? ''; ?></span>!</h3>
            </div>
        </section>
    <?php endif; ?>
    <section class="mb-10">
        <div class="lg:h-[600px] h-[450px] sm:h-[400px] basis-5xl">
            <img id="slider" class="h-full w-full object-cover rounded-md"
                src="https://i.pinimg.com/1200x/86/03/1e/86031ee63ebece19314575d1e47f5599.jpg" alt="">
        </div>
    </section>

    <section class="mb-10">
        <div class="flex justify-between">
            <h2 class="text-2xl font-bold">Hãy bắt đầu học nào</h2>
            <a class="py-1 px-2 border text-purple-600 font-bold rounded-sm" href="?page=course_learning">Học tập</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mt-3">
            <?php
            if (!$userId):
                ?>
                <p class=" text-xl">Vui lòng đăng nhập để xem khóa học đã mua</p>
                <?php
            elseif (!empty($courses)):
                foreach ($courses as $course):
                    ?>
                    <div class="item flex border border-[#ccc] rounded-sm hover:shadow-2xl">
                        <div class="image-box h-[120px] w-[160px] overflow-hidden">
                            <form action="?page=lesson_player" method="POST" class="h-full w-full">
                                <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                                <button type="submit" class="h-full w-full p-0 m-0 border-0 bg-transparent cursor-pointer">
                                    <img class="h-full w-full object-cover" src="Uploads/Courses/<?= $course['image'] ?>"
                                        alt="Ảnh lỗi">
                                </button>
                            </form>
                        </div>
                        <div class="p-2 flex justify-start flex-col">
                            <form action="?page=lesson_player" method="POST">
                                <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                                <button type="submit" class="text-left p-0 m-0 bg-transparent hover:underline">
                                    <?= htmlspecialchars($course['course_name']) ?>
                                </button>
                            </form>
                            <p class="font-bold">Bài giảng: <?= $course['percent_completed'] ?>%</p>
                            <p class="justify-self-end mt-auto">
                                <?= htmlspecialchars($course['total_length'] ?? 0) ?> Giờ
                            </p>
                        </div>
                    </div>
                    <?php
                endforeach;
            else:
                ?>
                <p class="text-xl">Hãy mua thêm khóa học</p>
                <?php
            endif;

            ?>
        </div>
    </section>

    <?php if ($userIdRoll != 2): ?>
        <section class="mb-10 bg-black rounded-md p-3 flex items-center justify-between">
            <p class="text-white">Bạn muốn đăng bán khóa học?</p>
            <a href="<?= (
                !$userId
                ? '?page=login'
                :
                '?page=about_teacher') ?>" class="bg-white p-2 rounded-md">Làm giảng viên</a>
        </section>
    <?php endif; ?>
    <section class="mb-10">
        <h2 class="text-2xl font-bold">Khóa học nổi bật</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5 mt-3">
            <?php
            foreach ($result as $course):
                ?>
                <div class="item rounded-sm hover:scale-[1.05] transition-all overflow-hidden ">
                    <div class="image-box h-[300px] lg:h-[200px]">
                        <a href="?page=course_detail&id=<?= $course["course_id"] ?>">
                            <img class="h-full w-full object-cover" src="./Uploads/Courses/<?= htmlspecialchars($course['image'] ?? '') ?>"
                                alt="">
                        </a>
                    </div>
                    <div class="p-2 flex border border-[#ccc] justify-start flex-col">
                        <a href="?page=course_detail">
                            <p class="font-bold mb-2 truncate"><a class="text-decoration-none" href="?page=course_detail&id=<?= $course["course_id"] ?>"><?= htmlspecialchars($course['course_name'] ?? '') ?></a></p>
                        </a>
                        <p class="opacity-[0.8] text-xs mb-2"><?= htmlspecialchars($course['instructor'] ?? '') ?></p>
                        <p class="mb-2">
                            <?= htmlspecialchars($course['rating'] == 0 ? 'Chưa có đánh giá' : $course['rating']) ?><i
                                class="ml-1 text-yellow-400 bi bi-star-fill"></i>
                        </p>
                        <p class="justify-self-end mt-auto font-bold mb-2">
                            <?= htmlspecialchars(number_format($course['sale_price'] ?? 0)) ?> đ <span
                                class="ml-1 font-medium line-through opacity-[0.7]"><?= htmlspecialchars(number_format($course['regular_price'] ?? 0)) ?>
                                đ</span>
                        </p>
                    </div>
                </div>
                <?php
            endforeach;
            ?>
        </div>
    </section>

    <section class="mb-10">
        <h2 class="text-2xl font-bold">Khóa học bán chạy nhất</h2>
        <div
            class="rounded-md mx-auto container border-[#ccc] grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-4 border py-5 px-8 gap-6">
            <div class="image-box h-[400px] hover:opacity-[0.8]">
                <a href="?page=course_detail&id=<?= $top1[0]["course_id"] ?>">

                    <img class="w-full h-full" src="./Uploads/Courses/<?= htmlspecialchars($top1[0]['image'] ?? '') ?>" alt="">
                </a>
            </div>

            <div class="flex flex-col justify-between">
                <div>
                    <a href="?page=course_detail&id=<?= $top1[0]["course_id"] ?>">
                        <h3 class="font-bold text-2xl mb-3"><?= htmlspecialchars($top1[0]['course_name'] ?? '') ?></h3>
                    </a>
                    <p class="mb-3">Mô tả: <?= html_entity_decode($top1[0]['description'] ?? '') ?></p>
                    <p class="text-sm mb-3"><?= htmlspecialchars($top1[0]['instructor'] ?? '') ?></p>
                    <p class="mb-2">Đánh giá: (<?= htmlspecialchars($top1[0]['rating'] ?? 'Chưa có đánh giá') ?>)<i
                            class="ml-1 text-yellow-400 bi bi-star-fill"></i></p>
                </div>

                <h3 class="text-xl font-bold"><?= htmlspecialchars(number_format($top1[0]['sale_price'] ?? 0)) ?> đ
                    <span
                        class="font-normal opacity-[0.8] line-through"><?= htmlspecialchars(number_format($top1[0]['regular_price'] ?? 0)) ?>
                        đ</span>
                </h3>
            </div>
        </div>
    </section>

    <section class="mb-10">
        <h2 class="text-2xl font-bold">Khóa học giảm giá</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5 mt-3">
            <?php
            foreach ($top10Sale as $top):
                ?>
                <div class="relative item rounded-sm hover:scale-[1.05] transition-all overflow-hidden">
                    <div class="absolute bg-red-400 font-bold text-white top-0 left-0 p-2 border-l-0 rounded-l-none px-4">
                        <?= htmlspecialchars(round($top['discount_percent'] ?? 0)) ?>%
                    </div>
                    <div class="image-box h-[300px] lg:h-[200px]">
                        <a href="?page=course_detail&id=<?= $top["id"] ?>">
                            <img class="h-full w-full object-cover" src="./Uploads/Courses/<?= htmlspecialchars($top['image'] ?? '') ?>"
                                alt="">
                        </a>
                    </div>
                    <div class="p-2 flex border border-[#ccc] justify-start flex-col">
                        <a href="?page=course_detail&id=<?= $top["id"] ?>">
                            <p class="font-bold mb-2 truncate"><?= htmlspecialchars($top['course_name'] ?? '') ?></p>
                        </a>
                        <p class="opacity-[0.8] text-xs mb-2"><?= htmlspecialchars($top['instructor'] ?? '') ?></p>
                        <p class="mb-2">Đánh giá: (<?= htmlspecialchars($top['rating'] ?? 'Chưa có đánh giá') ?>)<i
                                class="ml-1 text-yellow-400 bi bi-star-fill"></i></p>
                        <p class="justify-self-end mt-auto font-bold mb-2">
                            <?= htmlspecialchars(number_format($top['sale_price'] ?? 0)) ?> đ <span
                                class="ml-1 font-medium line-through opacity-[0.7]"><?= htmlspecialchars(number_format($top['regular_price'] ?? 0)) ?>
                                đ</span>
                        </p>
                    </div>
                </div>
                <?php
            endforeach;
            ?>
        </div>
    </section>

    <section class="rounded-md p-2 mb-10 bg-gray-100">
        <h3 class="text-center text-xl">Được hơn 17.000 công ty và hàng triệu học viên trên khắp thế giới tin dùng</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-5 mt-3 p-3">
            <div class="image-box h-[50px]">
                <img class="h-full w-full object-contain"
                    src="https://cms-images.udemycdn.com/96883mtakkm8/3E0eIh3tWHNWADiHNBmW4j/3444d1a4d029f283aa7d10ccf982421e/volkswagen_logo.svg"
                    alt="">
            </div>
            <div class="image-box h-[50px]">
                <img class="h-full w-full object-contain"
                    src="https://cms-images.udemycdn.com/96883mtakkm8/2pNyDO0KV1eHXk51HtaAAz/090fac96127d62e784df31e93735f76a/samsung_logo.svg"
                    alt="">
            </div>

            <div class="image-box h-[50px]">
                <img class="h-full w-full object-contain"
                    src="https://cms-images.udemycdn.com/96883mtakkm8/3YzfvEjCAUi3bKHLW2h1h8/ec478fa1ed75f6090a7ecc9a083d80af/cisco_logo.svg"
                    alt="">
            </div>
            <div class="image-box h-[50px]">
                <img class="h-full w-full object-contain"
                    src="https://cms-images.udemycdn.com/96883mtakkm8/1UUVZtTGuvw23MwEnDPUr3/2683579ac045486a0aff67ce8a5eb240/procter_gamble_logo.svg"
                    alt="">
            </div>

            <div class="image-box h-[50px]">
                <img class="h-full w-full object-contain"
                    src="https://cms-images.udemycdn.com/96883mtakkm8/23XnhdqwGCYUhfgIJzj3PM/77259d1ac2a7d771c4444e032ee40d9e/vimeo_logo_resized-2.svg"
                    alt="">
            </div>

            <div class="image-box h-[50px]">
                <img class="h-full w-full object-contain"
                    src="https://cms-images.udemycdn.com/96883mtakkm8/7guDRVYa2DZD0wD1SyxREP/b704dfe6b0ffb3b26253ec36b4aab505/ericsson_logo.svg"
                    alt="">
            </div>
        </div>
    </section>

    <section class="flex justify-center mb-10">
        <div class="flex justify-between lg:flex-row flex-col-reverse items-center">
            <div class="mb-5">
                <h3 class="text-3xl font-bold mb-5">
                    AI dành cho Nhà lãnh đạo doanh nghiệp
                </h3>
                <p class="mb-5">
                    Xây dựng thói quen AI cho bạn và đội nhóm của bạn để có được các kỹ năng thực hành giúp bạn lãnh đạo
                    hiệu quả.
                </p>
                <a class="py-3 px-4 mb-4 border text-purple-600 font-bold rounded-sm" href="?page=category_product">Học
                    tập</a>
            </div>
            <div class="overflow-hidden h-[400px] lg:h-[600px]">
                <img class="w-full h-full object-contain lg:object-cover"
                    src="https://cms-images.udemycdn.com/96883mtakkm8/32egVZ5YRgjxrz5mr45EwO/2328193d64d64dd0ab01b6019791da22/ai_for_business_leaders_photo__1_.png"
                    alt="">
            </div>
        </div>
    </section>
    </section>

</main>