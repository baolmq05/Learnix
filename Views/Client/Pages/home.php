<?php
$showLoginSuccess = isset($_GET['login']) && $_GET['login'] === 'success';
?>
<div id="alert_login_success" role="alert" style="display:none;"
    class="fixed top-6 right-6 z-50 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg shadow-lg opacity-0 pointer-events-none transform transition-all duration-300 translate-x-full">
    <i class="bi bi-check-circle-fill"></i>
    <div class="text-sm font-medium">Đăng nhập thành công</div>
</div>
<main class="px-5">

    <?php if ($_SESSION['client'] ?? false): ?>
        <section class="flex gap-5 my-10 items-center">
            <div class=" bg-black text-white px-5 box-border font-bold text-2xl py-5 rounded-[50%]">LB</div>
            <div class="p-3 background-">
                <h3 class="text-2xl font-bold">Chào mừng bạn trở lại <span
                        class="font-bold text-blue-600"><?php echo $_SESSION['client']['name'] ?? ''; ?></span>!</h3>
            </div>
        </section>
    <?php endif; ?>
    <section class="mb-10">
        <div class="lg:h-[500px] h-[450px] sm:h-[400px] basis-5xl">
            <img id="slider" class="h-full w-full object-cover rounded-md" src="./image/Slider1.png" alt="">
        </div>
    </section>

    <section class="mb-10">
        <div class="flex justify-between">
            <h2 class="text-2xl font-bold">Hãy bắt đầu học nào</h2>
            <a class="py-1 px-2 border text-purple-600 font-bold rounded-sm" href="">Học tập</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mt-3">
            <?php
            for ($i = 0; $i < 3; $i++):
                ?>
                <div class="item flex border border-[#ccc] rounded-sm hover:shadow-2xl">
                    <div class="image-box h-[120px]">
                        <a href="?page=course_detail">
                            <img class="h-full w-full object-cover" src="./image/Slider1.png" alt="">
                        </a>
                    </div>
                    <div class="p-2 flex justify-start flex-col">
                        <a href="?page=course_detail">
                            <p>Tên khóa học 1....</p>
                        </a>
                        <p class="font-bold">47. Bài học 1...</p>
                        <p class="justify-self-end mt-auto">Bài giảng: Số phút</p>
                    </div>
                </div>
                <?php
            endfor;
            ?>
        </div>
    </section>

    <section class="mb-10 bg-black rounded-md p-3 flex items-center justify-between">
        <p class="text-white">Bạn muốn đăng bán khóa học?</p>
        <button class="bg-white p-2 rounded-md">Làm giảng viên</button>
    </section>

    <section class="mb-10">
        <h2 class="text-2xl font-bold">Khóa học nổi bật</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5 mt-3">
            <?php
            for ($i = 0; $i < 10; $i++):
                ?>
                <div class="item rounded-sm hover:scale-[1.05] transition-all overflow-hidden">
                    <div class="image-box h-[300px] lg:h-[200px]">
                        <a href="?page=course_detail">
                            <img class="h-full w-full object-cover" src="./image/Slider1.png" alt="">
                        </a>
                    </div>
                    <div class="p-2 flex border border-[#ccc] justify-start flex-col">
                        <a href="?page=course_detail">
                            <p class="font-bold mb-2">Tên khóa học...</p>
                        </a>
                        <p class="opacity-[0.8] text-xs mb-2">Tên giảng viên</p>
                        <p class="mb-2">Đánh giá: (4.6)<i class="ml-1 text-yellow-400 bi bi-star-fill"></i></p>
                        <p class="justify-self-end mt-auto font-bold mb-2">279.000 đ <span
                                class="ml-1 font-medium line-through opacity-[0.7]">279.000 đ</span></p>
                    </div>
                </div>
                <?php
            endfor;
            ?>
        </div>
    </section>

    <section class="mb-10">
        <h2 class="text-2xl font-bold">Khóa học bán chạy nhất</h2>
        <div
            class="rounded-md mx-auto container border-[#ccc] grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-4 border py-5 px-8 gap-6">
            <div class="image-box h-[400px] hover:opacity-[0.8]">
                <a href="?page=course_detail">

                    <img class="w-full h-full" src="./image/Slider1.png" alt="">
                </a>
            </div>

            <div class="flex flex-col justify-between">
                <div>
                    <a href="?page=course_detail">
                        <h3 class="font-bold text-2xl mb-3">Tên khóa học</h3>
                    </a>
                    <p class="mb-3">Mô tả: Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi nemo quidem
                        ducimus ipsam laborum quo distinctio, illum officiis beatae debitis?</p>
                    <p class="text-sm mb-3">Tên giảng viên</p>
                    <p class="mb-2">Đánh giá: (4.6)<i class="ml-1 text-yellow-400 bi bi-star-fill"></i></p>
                </div>

                <h3 class="text-xl font-bold">Giá: 290.000đ <span
                        class="font-normal opacity-[0.8] line-through">300.000đ</span></h3>
            </div>
        </div>
    </section>

    <section class="mb-10">
        <h2 class="text-2xl font-bold">Khóa học giảm giá</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5 mt-3">
            <?php
            for ($i = 0; $i < 10; $i++):
                ?>
                <div class="relative item rounded-sm hover:scale-[1.05] transition-all overflow-hidden">
                    <div class="absolute bg-red-400 font-bold text-white top-0 left-0 p-2 border-l-0 rounded-l-none px-4">
                        25%</div>
                    <div class="image-box h-[300px] lg:h-[200px]">
                        <a href="?page=course_detail">
                            <img class="h-full w-full object-cover" src="./image/Slider1.png" alt="">
                        </a>
                    </div>
                    <div class="p-2 flex border border-[#ccc] justify-start flex-col">
                        <a href="?page=course_detail">
                            <p class="font-bold mb-2">Tên khóa học...</p>
                        </a>
                        <p class="opacity-[0.8] text-xs mb-2">Tên giảng viên</p>
                        <p class="mb-2">Đánh giá: (4.6)<i class="ml-1 text-yellow-400 bi bi-star-fill"></i></p>
                        <p class="justify-self-end mt-auto font-bold mb-2">279.000 đ <span
                                class="ml-1 font-medium line-through opacity-[0.7]">279.000 đ</span></p>
                    </div>
                </div>
                <?php
            endfor;
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
    <script>
        (function () {
            const key = 'login_success';
            if (!sessionStorage) return;
            const showFromQuery = <?php echo $showLoginSuccess ? 'true' : 'false'; ?>;
            if (sessionStorage.getItem(key) || showFromQuery) {
                const el = document.getElementById('alert_login_success');
                if (!el) return;
                el.style.display = 'flex';
                requestAnimationFrame(() => {
                    el.classList.remove('opacity-0', 'pointer-events-none', 'translate-x-full');
                    el.classList.add('opacity-100', 'translate-x-0');
                });

                setTimeout(() => {
                    el.classList.remove('opacity-100', 'translate-x-0');
                    el.classList.add('opacity-0', 'translate-x-full');
                    setTimeout(() => {
                        el.style.display = 'none';
                        sessionStorage.removeItem(key);
                        if (showFromQuery && window.history && window.history.replaceState) {
                            const cleanUrl = window.location.pathname;
                            window.history.replaceState({}, document.title, cleanUrl);
                        }
                    }, 300);
                }, 4000);
            }
        })();
    </script>
</main>