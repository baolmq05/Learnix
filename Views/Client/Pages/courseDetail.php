<main>
    <div class="bg-[#16161d] text-white py-15 grid grid-cols-10 gap-20">
        <div class="lg:col-start-2 lg:col-span-5 col-span-8 col-start-2">
            <h1 class="text-4xl">
                <b><?= $course['course_name'] ?></b>
            </h1>
            <p class="text-justify mt-5 leading-7">
                <?= html_entity_decode($course['description']) ?>
            </p>
            <p class="flex mt-5">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-6 text-yellow-300 me-1">
                    <path fill-rule="evenodd"
                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                        clip-rule="evenodd" />
                </svg>
                <?= $course['rating'] == 0 ? 'Chưa có' : $course['rating'] ?> (<?= $course['total_review'] ?> lượt đánh
                giá) · <?= $course['total_enroll'] ?>
                lượt bán
            </p>
            <p class="mt-2">
                Được đăng bởi
                <a href="#" class="text-[#c0c4fc] ms-1"><?= $course['instructor'] ?></a>
            </p>
            <p class="mt-5 flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 me-1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                Cập nhật lần cuối: <?= $course['updated_at'] ?>
            </p>
        </div>
        <div class="lg:col-span-3 col-span-6 col-start-3">
            <div class="p-2 rounded-sm bg-white text-black">
                <div class="w-full">
                    <img class="object-cover" src="Uploads/Courses/<?= $course['image'] ?? 'Hello' ?>" alt=""
                        width="100%" />
                </div>
                <div class="flex items-center">
                    <h3 class="font-bold text-2xl mx-4 mt-4">
                        <?= number_format($course['sale_price'] != 0 ? $course['sale_price'] : $course['regular_price']) ?>₫
                    </h3>
                    <h3 class="text-lg mt-4 line-through">
                        <?= $course['sale_price'] != 0 ? number_format($course['regular_price']) . '₫' : '' ?>
                    </h3>
                </div>
                <?php if (!$enrollments): ?>
                    <div class="mx-4 mt-4">
                        <button onclick="addToCart()"
                            class="bg-[#6d28d2] hover:bg-purple-400 hover:cursor-pointer font-bold text-[1.2rem] rounded-[5px] text-white px-2 py-3 w-full">
                            Thêm vào giỏ
                        </button>
                    </div>
                    <div class="mx-4 mt-2">
                        <form action="?page=checkout&action=viewCheckout" method="POST">
                            <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                            <button type="submit"
                                class="text-[#6d28d2] border-[#6d28d2] border hover:bg-purple-100 hover:cursor-pointer font-bold text-[1.2rem] rounded-[5px] px-10 py-3 w-full">
                                Mua ngay
                            </button>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="mx-4 mt-4">
                        <form action="?page=lesson_player" method="POST">
                            <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                            <button type="submit"
                                class="bg-purple-500 hover:bg-purple-600 hover:cursor-pointer font-bold text-[1.2rem] rounded-[5px] text-white px-2 py-3 w-full">
                                Tiếp tục học
                            </button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="py-15 grid grid-cols-10 gap-20">
        <div class="lg:col-start-2 lg:col-span-5 col-span-8 col-start-2">
            <div class="border border-[#6d28d2] p-5">
                <h2 class="text-2xl font-medium col-span-2 mb-5">
                    Sau khi hoàn thành khóa học, bạn sẽ:
                </h2>
                <div class="grid grid-cols-2 gap-3">
                    <?php foreach ($benefit as $b): ?>
                        <div class="flex">
                            <p>
                                <i class="fa-solid fa-square-check text-green-500 me-2"></i>
                            </p>
                            <p><?= $b ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="lg:hidden block">
                <div class="h-max p-4">
                    <div>
                        <h3 class="text-[1.2rem] mb-3">Khóa học này bao gồm:</h3>
                        <div class="flex flex-col gap-y-2">
                            <p><i class="w-8 fa-solid fa-video"></i><?= $course['total_length'] ?> giờ video</p>
                            <p><i class="w-8 fa-solid fa-book"></i><?= $course['total_lesson'] ?> bài học</p>
                            <p>
                                <i class="w-8 fa-solid fa-mobile-screen"></i>Truy cập trên
                                di động và máy tính
                            </p>
                            <p>
                                <i class="w-8 fa-solid fa-infinity"></i>Truy cập trọn đời
                            </p>
                            <p>
                                <i class="w-8 fa-solid fa-trophy"></i>Chứng nhận hoàn thành
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="font-bold text-2xl mt-10 mb-4">Nội dung khóa học</h2>
            <p><?= $course['total_section'] ?> phần • <?= $course['total_lesson'] ?> bài giảng • Tổng thời lượng
                <?= $course['total_length'] ?> giờ
            </p>
            <?php foreach ($sections as $section => $value): ?>
                <details class="group">
                    <summary class="flex justify-between border p-3 mt-3 select-none bg-gray-100">
                        <h4 class="font-bold">
                            <i
                                class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"></i><?= $value['section_name'] ?>
                        </h4>
                        <p class="text-sm"><?= $value['total_lesson'] ?> bài giảng •
                            <?php if ($value['total_length'] < 1) {
                                echo round($value['total_length'] * 60) . ' phút';
                            } else {
                                echo (int) ($value['total_length']) . ' giờ ' . round(($value['total_length'] - (int) ($value['total_length'])) * 60) . ' phút';
                            } ?>
                        </p>
                    </summary>
                    <div class="border-x border-b p-4">
                        <?php foreach ($lessons as $lesson => $lessonValue):
                            if ($value['section_id'] == $lessonValue['section_id']): ?>
                                <div class="flex justify-between mt-2">
                                    <h4><?= $lessonValue['lesson_name'] ?></h4>
                                    <p><?= $lessonValue['lesson_length'] ?></p>
                                </div>
                            <?php endif;
                        endforeach; ?>
                    </div>
                </details>
            <?php endforeach; ?>
            <div>
                <h3 class="text-2xl font-bold mt-5">Phù hợp cho ai:</h3>
                <ul class="list-disc ps-5 mt-3 space-y-1">
                    <?php foreach ($customer_object as $c): ?>
                        <li><?= $c ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <h3 class="text-2xl font-bold mt-5">Khóa học tương tự</h3>
            <?php if (!empty($relatedCourses)):
                foreach ($relatedCourses as $relatedCourse): ?>
                    <a href="?page=course_detail&id=<?= $relatedCourse['id'] ?>">
                        <div class="flex mt-5 gap-6 items-center">
                            <div class="min-w-[20%] min-h-20 w-[20%] h-20">
                                <img class="object-cover w-full h-full" src="<?= $relatedCourse['image'] ?>" width="100%"
                                    alt="" />
                            </div>
                            <div class="flex flex-col justify-center w-[40%] min-w-[40%]">
                                <p class="font-medium text-lg two-line-ellipsis">
                                    <?= $relatedCourse['course_name'] ?>
                                </p>
                                <p class="text-sm"><?= $relatedCourse['total_length'] ?> giờ học</p>
                                <p class="text-sm">Cập nhật lần cuối
                                    <?= date('d/m/Y', strtotime($relatedCourse['updated_at'])) ?>
                                </p>
                            </div>
                            <div class="flex min-w-[10%]">
                                <p><?= $relatedCourse['rating'] == 0 ? '' : $relatedCourse['rating'] ?></p>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6 text-<?= $relatedCourse['rating'] == 0 ? 'gray' : 'yellow' ?>-300 me-1">
                                    <path fill-rule="evenodd"
                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="flex gap-2 text-sm min-w-[10%]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>
                                <p><?= $relatedCourse['total_enroll'] ?></p>
                            </div>
                            <div class="flex flex-col justify-center text-sm min-w-[20%]">
                                <s><?= $relatedCourse['sale_price'] == 0 ? '' : number_format($relatedCourse['regular_price']) . '₫' ?></s>
                                <p class="font-medium">
                                    <?= $relatedCourse['sale_price'] ? number_format($relatedCourse['sale_price']) : number_format($relatedCourse['regular_price']) ?>₫
                                </p>
                            </div>
                        </div>
                    </a>
                <?php endforeach;
            else: ?>
                <p>Không có khóa học liên quan.</p>
            <?php endif; ?>
            <h3 class="text-2xl font-bold mt-5 mb-3">Giảng viên</h3>
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="w-20 h-20">
                        <img class="rounded-full object-cover h-20 w-20"
                            src="Uploads/Avatar/<?= $course['avatar'] ?? 'default.webp' ?>" width="100%" height="100%"
                            alt="" />
                    </div>
                    <p class="font-bold text-2xl ms-5">
                        <a href="#"><?= $course['instructor'] ?></a>
                    </p>
                </div>
                <div class="me-10">
                    <p><i class="bi bi-star"></i> <?= $avgRating ?> sao đánh giá</p>
                    <p><i class="bi bi-people"></i> <?= number_format($course['total_enroll']) ?> học viên</p>
                    <p><i class="bi bi-play-circle"></i> <?= number_format($totalCourses['course_count']) ?> khóa học
                    </p>
                </div>
            </div>
            <p class="mt-8 mb-2 text-lg font-bold">
                <i class="bi bi-star-fill text-yellow-400"></i> • <?= $course['total_review'] ?> đánh giá
            </p>
            <div class="flex flex-wrap gap-5" id="review">
                <?php foreach ($reviews as $review): ?>
                    <div class="border w-full p-5">
                        <div class="flex gap-5">
                            <div class="w-15 h-15">
                                <img class="rounded-full w-full h-full object-cover"
                                    src="Uploads/Avatar/<?= $review['avatar'] ?? 'default.webp' ?>" alt="" width="100%"
                                    height="100%" />
                            </div>
                            <div>
                                <p><?= htmlspecialchars($review['name']) ?></p>
                                <p class="text-xs mt-3">
                                    <i class="bi bi-star<?= $review['rating'] >= 1 ? '-fill' : '' ?> text-yellow-400"></i>
                                    <i class="bi bi-star<?= $review['rating'] >= 2 ? '-fill' : '' ?> text-yellow-400"></i>
                                    <i class="bi bi-star<?= $review['rating'] >= 3 ? '-fill' : '' ?> text-yellow-400"></i>
                                    <i class="bi bi-star<?= $review['rating'] >= 4 ? '-fill' : '' ?> text-yellow-400"></i>
                                    <i class="bi bi-star<?= $review['rating'] >= 5 ? '-fill' : '' ?> text-yellow-400"></i>
                                    <span class="ms-2"><?= $review['updated_at'] ?></span>
                                </p>
                            </div>
                        </div>
                        <p class="mt-3 text-justify two-line-ellipsis" id="<?= $review['id'] ?>">
                            <?= htmlspecialchars($review['content']) ?>
                        </p>
                        <button class="font-bold hover:cursor-pointer" onclick="toggleContent(<?= $review['id'] ?>)">Xem
                            thêm</button>
                    </div>
                <?php endforeach; ?>
            </div>
            <button onclick="getMoreReview()" id="buttonGetMoreReview"
                class="text-[#6d28d2] border-[#6d28d2] border hover:bg-purple-100 hover:cursor-pointer font-bold rounded-[5px] px-10 py-2 mt-5">
                Xem thêm bình luận
            </button>
            <h3 class="text-2xl font-bold mt-5">Các khóa học của thầy <a href="#"
                    class="text-purple-600"><?= htmlspecialchars($course['instructor']) ?></a></h3>
            <?php if (!empty($coursesByTeacher)):
                foreach ($coursesByTeacher as $courseByTeacher): ?>
                    <a href="?page=course_detail&id=<?= $courseByTeacher['id'] ?>">
                        <div class="flex mt-5 gap-6 items-center">
                            <div class="min-w-[20%] min-h-20 w-[20%] h-20">
                                <img class="object-cover w-full h-full" src="<?= $courseByTeacher['image'] ?>" width="100%"
                                    alt="" />
                            </div>
                            <div class="flex flex-col justify-center w-[40%] min-w-[40%]">
                                <p class="font-medium text-lg two-line-ellipsis">
                                    <?= $courseByTeacher['course_name'] ?>
                                </p>
                                <p class="text-sm"><?= $courseByTeacher['total_length'] ?> giờ học</p>
                                <p class="text-sm">Cập nhật lần cuối
                                    <?= date('d/m/Y', strtotime($courseByTeacher['updated_at'])) ?>
                                </p>
                            </div>
                            <div class="flex min-w-[10%]">
                                <p><?= $courseByTeacher['rating'] == 0 ? '' : $courseByTeacher['rating'] ?></p>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6 text-<?= $courseByTeacher['rating'] == 0 ? 'gray' : 'yellow' ?>-300 me-1">
                                    <path fill-rule="evenodd"
                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="flex gap-2 text-sm min-w-[10%]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>
                                <p><?= $courseByTeacher['total_enroll'] ?></p>
                            </div>
                            <div class="flex flex-col justify-center text-sm min-w-[20%]">
                                <s><?= $courseByTeacher['sale_price'] == 0 ? '' : number_format($courseByTeacher['regular_price']) . '₫' ?></s>
                                <p class="font-medium">
                                    <?= $courseByTeacher['sale_price'] ? number_format($courseByTeacher['sale_price']) : number_format($courseByTeacher['regular_price']) ?>₫
                                </p>
                            </div>
                        </div>
                    </a>
                <?php endforeach;
            else: ?>
                <p>Không có khóa học liên quan.</p>
            <?php endif; ?>
        </div>
        <div class="col-span-3 hidden lg:block">
            <div class="sticky top-4 h-max p-4 shadow-md">
                <div>
                    <h3 class="text-[1.2rem] mb-3">Khóa học này bao gồm:</h3>
                    <div class="grid grid-cols-10 gap-y-2">
                        <p class="col-span-1"><i class="fa-solid fa-video"></i></p>
                        <p class="col-span-9"><?= $course['total_length'] ?> giờ video</p>
                        <p class="col-span-1"><i class="fa-solid fa-book"></i></p>
                        <p class="col-span-9"><?= $course['total_lesson'] ?> bài học</p>
                        <p class="col-span-1">
                            <i class="fa-solid fa-mobile-screen"></i>
                        </p>
                        <p class="col-span-9">Truy cập trên di động và máy tính</p>
                        <p class="col-span-1"><i class="fa-solid fa-infinity"></i></p>
                        <p class="col-span-9">Truy cập trọn đời</p>
                        <p class="col-span-1"><i class="fa-solid fa-trophy"></i></p>
                        <p class="col-span-9">Chứng nhận hoàn thành</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let start = <?= count($reviews) ?>;
    let limit = 3;
    let courseId = <?= $course['id'] ?>;

    function getMoreReview() {
        $.ajax({
            url: 'Controllers/Client/Ajax/AjaxGetMoreReview.php',
            type: 'GET',
            data: {
                courseId: courseId,
                start: start,
                limit: limit
            },
            success: function (response) {
                $('#review').append(response);
                start += limit;
                document.getElementById('buttonGetMoreReview').scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                if ($('#no-more-reviews').length) {
                    document.getElementById('buttonGetMoreReview').style.display = 'none';
                }
                checkContentHeight();
                console.log('Đã tải thêm bình luận thành công');
            },
            error: function (xhr, status, error) {
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

    function checkContentHeight() {
        //Kiểm tra xem bình luận có hơn 2 dòng hay không để hiển thị nút "Xem thêm"
        document.querySelectorAll('.two-line-ellipsis').forEach(paragraph => {
            const lineHeight = parseFloat(getComputedStyle(paragraph).lineHeight);
            const maxHeight = lineHeight * 2; // Giới hạn 2 dòng

            if (paragraph.scrollHeight <= maxHeight) {
                const button = paragraph.nextElementSibling;
                button.style.display = 'none';
            }
        });
    }
    checkContentHeight();

    function showToast(message, type = "success") {
        const toast = document.createElement("div");

        toast.id = type === "success" ? "alert_success" : "alert_danger";

        toast.style.background = type === "success" ? "#22c55e" : "#ef4444";

        toast.className =
            "fixed top-5 right-5 max-w-[80vw] px-4 py-2 text-white rounded-lg shadow-lg z-[9999] break-words";

        toast.style.transition = "opacity 0.5s ease";

        toast.innerText = message;

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = "0";
        }, 2500);

        setTimeout(() => toast.remove(), 3000);
    }

    const style = document.createElement("style");
    style.innerHTML = `
        @keyframes slideIn {
            from { transform: translateX(150%); opacity: 0; }
            to   { transform: translateX(0); opacity: 1; }
        }
        .animate-slideIn {
            animation: slideIn 0.3s ease-out;
        }
    `;
    document.head.appendChild(style);


    function addToCart() {
        let userId = <?= $_SESSION['client']['id'] ?? 'null' ?>;
        let courseId = <?= $course['id'] ?>;
        console.log("User ID:", userId);
        console.log("Course ID:", courseId);

        let formData = new FormData();
        formData.append("userId", userId);
        formData.append("courseId", courseId);

        if (!userId) {
            showToast("Vui lòng đăng nhập để thêm vào giỏ hàng!", "error");
            sessionStorage.setItem('loginError', 'Vui lòng đăng nhập để thực hiện chức năng');
            window.location.href = "/index.php?page=login";
            return;
        }

        fetch("Controllers/Client/Ajax/AjaxAddToCart.php", {
            method: "POST",
            body: formData
        })
            .then(res => res.json())
            .then(data => {

                if (data.status === "success") {
                    showToast(data.message, "success");
                    showCartDropdown();
                    loadCartHeader();
                } else {
                    showToast(data.message, "error");
                }
            })
            .catch(err => {
                showToast("Lỗi kết nối server!", "error");
                console.error(err);
            });
    }

    function loadCartHeader() {
        $.ajax({
            url: "Controllers/Client/Ajax/AjaxLoadCartHeader.php",
            method: "GET",
            dataType: "json",
            success: function (data) {

                if (data.status === "error") {
                    $("#cartDropdownItems").html(`
                    <div class="p-3 text-center text-sm text-gray-600">
                    Giỏ hàng trống
                    </div>
                    `);
                    $("#cartCount").text(0);
                    return;
                }

                $("#cartDropdownItems").html(data.html);

                $("#cartCount").text(data.count);
            },
            error: function (xhr, status, error) {
                console.error("Load Cart Error:", error);
            }
        });
    }

    function showCartDropdown() {
        const dropdown = document.getElementById('cart-dropdown');

        dropdown.classList.remove('opacity-0', 'invisible', 'pointer-events-none', 'right-0', 'mt-2');
        dropdown.classList.add('opacity-100', 'visible', 'pointer-events-auto', 'right-0', 'mt-2');

        setTimeout(() => {
            dropdown.classList.add('opacity-0', 'invisible', 'pointer-events-none', 'right-0', 'mt-2');
            dropdown.classList.remove('opacity-100', 'visible', 'pointer-events-auto');
        }, 5000);
    }
</script>