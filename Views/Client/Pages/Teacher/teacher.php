<style>
    body {
        display: flex;
        flex-direction: column;
        height: 100vh;
        justify-content: space-between;
    }
</style>

<?php
$success = $_SESSION['login_success'] ?? '';
unset($_SESSION['login_success']);
?>
<?php if (!empty($success)): ?>
    <div id="alert_success" class="flex items-center w-full p-4 mb-4 text-green-800 bg-green-100 rounded-lg" role="alert">
        <div>
            <?= $success ?>
        </div>
    </div>
<?php endif ?>

<section class="max-w-screen-2xl px-4 py-8 flex-1">
    <div class="flex items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-semibold text-gray-900">Khóa học của tôi</h1>
            <p class="mt-1 text-sm text-gray-600">Danh sách các khóa học bạn đã tạo</p>
        </div>

        <div class="flex items-center gap-2">
            <a href="index.php?page=teacher&action=viewCreateCourse"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium shadow-sm">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Thêm khóa học</span>
            </a>
        </div>
    </div>

    <div class="mt-6 border-b border-gray-200">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="courseTabs" role="tablist">
            <li class="mr-2" role="presentation">
                <button id="tab-approved" data-target="content-approved"
                    onclick="changeTabs(1)"
                    class="tab-btn inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-blue-400 text-blue-400 hover:border-gray-300"
                    type="button" role="tab" aria-selected="false">
                    Công khai
                    <span class="ms-2 inline-flex items-center justify-center 
                    w-6 h-6 rounded-full 
                    bg-green-100 text-green-700 
                    text-xs font-semibold">
                        <?= $countCourseObj["approved_count"] ?? 0 ?>
                    </span>
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button id="tab-pending" data-target="content-pending"
                    onclick="changeTabs(2)"
                    class="tab-btn inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-blue-400 hover:border-gray-300"
                    type="button" role="tab" aria-selected="false">
                    Chờ duyệt
                    <span class="ms-2 inline-flex items-center justify-center 
                    w-6 h-6 rounded-full 
                    bg-yellow-100 text-yellow-700 
                    text-xs font-semibold">
                        <?= $countCourseObj["pending_count"] ?? 0 ?>
                    </span>
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button id="tab-editing" data-target="content-editing"
                    onclick="changeTabs(0)"
                    class="tab-btn inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-blue-400 hover:border-gray-300"
                    type="button" role="tab" aria-selected="false">
                    Đang chỉnh sửa
                    <span class="ms-2 inline-flex items-center justify-center 
                    w-6 h-6 rounded-full 
                    bg-blue-100 text-blue-700 
                    text-xs font-semibold">
                        <?= $countCourseObj["editing_count"] ?? 0 ?>
                    </span>
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button id="tab-disabled" data-target="content-disabled"
                    onclick="changeTabs(3)"
                    class="tab-btn inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-blue-400 hover:border-gray-300"
                    type="button" role="tab" aria-selected="false">
                    Đã ẩn
                    <span class="ms-2 inline-flex items-center justify-center 
                    w-6 h-6 rounded-full 
                    bg-gray-100 text-gray-700 
                    text-xs font-semibold">
                        <?= $countCourseObj["disabled_count"] ?? 0 ?>
                    </span>
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button id="tab-reject" data-target="content-reject"
                    onclick="changeTabs(4)"
                    class="tab-btn inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-blue-400 hover:border-gray-300"
                    type="button" role="tab" aria-selected="false">
                    Bị từ chối
                    <span class="ms-2 inline-flex items-center justify-center 
                    w-6 h-6 rounded-full 
                    bg-red-100 text-red-700 
                    text-xs font-semibold">
                        <?= $countCourseObj["rejected_count"] ?? 0 ?>
                    </span>
                </button>
            </li>
        </ul>
    </div>
    <div class="mt-6">
        <div id="content-approved" class="tab-content">
            <?php if (empty($courseApproved) || count($courseApproved) == 0): ?>
                <div class="rounded-md border border-dashed border-gray-200 p-8 text-center text-gray-600">
                    Bạn chưa có khóa học nào trong mục này
                </div>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach ($courseApproved as $course): ?>
                        <article class="flex items-center gap-4 border-b pb-4">
                            <a href="?page=course_detail&id=<?= $course["course_id"] ?>" class="flex items-center gap-4 flex-1 min-w-0">
                                <div class="flex-shrink-0 w-32 h-20 bg-gray-100 overflow-hidden rounded-sm">
                                    <img src="./Uploads/Courses/<?= $course['course_image'] ?>" alt="<?= htmlspecialchars($course['course_name']) ?>"
                                        class="w-full h-full object-cover" />
                                </div>

                                <div class="min-w-0">
                                    <h3 class="text-md font-semibold text-gray-900 truncate">
                                        <?= htmlspecialchars($course['course_name']) ?></h3>
                                    <p class="mt-1 text-sm truncate">
                                        <span
                                            class="inline-flex items-center text-xs font-medium px-2 py-0.5 rounded-full bg-green-100 text-green-800"><?= $course['student_quantity'] ?>
                                            học viên</span>
                                    </p>
                                    <p class="text-sm mt-1">
                                        <span class="text-yellow-600"><?= $course['rating'] ?>&nbsp;<i
                                                class="bi bi-star-fill text-xs"></i></span>
                                    </p>
                                </div>
                            </a>

                            <div class="flex flex-col items-end gap-2">
                                <div class="text-lg font-semibold text-gray-900"><?= $course['sale_price'] >= 0 ? number_format($course['sale_price']) : number_format($course['regular_price']) ?>₫</div>
                                <div class="flex items-center gap-2">
                                    <form action="?page=teacher&action=viewEditCourse" method="post">
                                        <input type="hidden" name="course_id" value="<?= $course["course_id"] ?>">
                                        <button class="inline-block text-xs px-3 py-3 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200">Chỉnh sửa</button>
                                    </form>
                                    
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div id="content-pending" class="tab-content hidden">
            <?php if (empty($coursePending) || count($coursePending) == 0): ?>
                <div class="rounded-md border border-dashed border-gray-200 p-8 text-center text-gray-600">
                    Bạn chưa có khóa học nào trong mục này
                </div>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach ($coursePending as $course): ?>
                        <article class="flex items-center gap-4 border-b pb-4">
                            <a class="flex items-center gap-4 flex-1 min-w-0">
                                <div class="flex-shrink-0 w-32 h-20 bg-gray-100 overflow-hidden rounded-sm">
                                    <img src="./Uploads/Courses/<?= $course['course_image'] ?>" alt="<?= htmlspecialchars($course['course_name']) ?>"
                                        class="w-full h-full object-cover" />
                                </div>

                                <div class="min-w-0">
                                    <h3 class="text-md font-semibold text-gray-900 truncate">
                                        <?= htmlspecialchars($course['course_name']) ?></h3>
                                    <p class="mt-1 text-sm truncate">
                                        <span
                                            class="inline-flex items-center text-xs font-medium px-2 py-0.5 rounded-full bg-green-100 text-green-800"><?= $course['student_quantity'] ?>
                                            học viên</span>
                                    </p>
                                    <p class="text-sm mt-1">
                                        <span class="text-yellow-600"><?= $course['rating'] ?>&nbsp;<i
                                                class="bi bi-star-fill text-xs"></i></span>
                                    </p>
                                </div>
                            </a>

                            <div class="flex flex-col items-end gap-2">
                                <div class="text-lg font-semibold text-gray-900"><?= $course['sale_price'] >= 0 ? number_format($course['sale_price']) : number_format($course['regular_price']) ?>₫</div>
                                <div class="flex items-center gap-2">
                                    <form action="?page=teacher&action=viewEditCourse" method="post">
                                        <input type="hidden" name="course_id" value="<?= $course["course_id"] ?>">
                                        <button class="inline-block text-xs px-3 py-3 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200">Chỉnh sửa</button>
                                    </form>
                                    
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div id="content-editing" class="tab-content hidden">
            <?php if (empty($courseEditing) || count($courseEditing) == 0): ?>
                <div class="rounded-md border border-dashed border-gray-200 p-8 text-center text-gray-600">
                    Bạn chưa có khóa học nào trong mục này
                </div>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach ($courseEditing as $course): ?>
                        <article class="flex items-center gap-4 border-b pb-4">
                            <a class="flex items-center gap-4 flex-1 min-w-0">
                                <div class="flex-shrink-0 w-32 h-20 bg-gray-100 overflow-hidden rounded-sm">
                                    <img src="./Uploads/Courses/<?= $course['course_image'] ?>" alt="<?= htmlspecialchars($course['course_name']) ?>"
                                        class="w-full h-full object-cover" />
                                </div>

                                <div class="min-w-0">
                                    <h3 class="text-md font-semibold text-gray-900 truncate">
                                        <?= htmlspecialchars($course['course_name']) ?></h3>
                                    <p class="mt-1 text-sm truncate">
                                        <span
                                            class="inline-flex items-center text-xs font-medium px-2 py-0.5 rounded-full bg-green-100 text-green-800"><?= $course['student_quantity'] ?>
                                            học viên</span>
                                    </p>
                                    <p class="text-sm mt-1">
                                        <span class="text-yellow-600"><?= $course['rating'] ?>&nbsp;<i
                                                class="bi bi-star-fill text-xs"></i></span>
                                    </p>
                                </div>
                            </a>

                            <div class="flex flex-col items-end gap-2">
                                <div class="text-lg font-semibold text-gray-900"><?= $course['sale_price'] >= 0 ? number_format($course['sale_price']) : number_format($course['regular_price']) ?>₫</div>
                                <div class="flex items-center gap-2">
                                    <form action="?page=teacher&action=viewEditCourse" method="post">
                                        <input type="hidden" name="course_id" value="<?= $course["course_id"] ?>">
                                        <button class="inline-block text-xs px-3 py-3 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200">Chỉnh sửa</button>
                                    </form>
                                    
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div id="content-disabled" class="tab-content hidden">
            <?php if (empty($courseDisabled) || count($courseDisabled) == 0): ?>
                <div class="rounded-md border border-dashed border-gray-200 p-8 text-center text-gray-600">
                    Bạn chưa có khóa học nào trong mục này
                </div>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach ($courseDisabled as $course): ?>
                        <article class="flex items-center gap-4 border-b pb-4">
                            <a class="flex items-center gap-4 flex-1 min-w-0">
                                <div class="flex-shrink-0 w-32 h-20 bg-gray-100 overflow-hidden rounded-sm">
                                    <img src="./Uploads/Courses/<?= $course['course_image'] ?>" alt="<?= htmlspecialchars($course['course_name']) ?>"
                                        class="w-full h-full object-cover" />
                                </div>

                                <div class="min-w-0">
                                    <h3 class="text-md font-semibold text-gray-900 truncate">
                                        <?= htmlspecialchars($course['course_name']) ?></h3>
                                    <p class="mt-1 text-sm truncate">
                                        <span
                                            class="inline-flex items-center text-xs font-medium px-2 py-0.5 rounded-full bg-green-100 text-green-800"><?= $course['student_quantity'] ?>
                                            học viên</span>
                                    </p>
                                    <p class="text-sm mt-1">
                                        <span class="text-yellow-600"><?= $course['rating'] ?>&nbsp;<i
                                                class="bi bi-star-fill text-xs"></i></span>
                                    </p>
                                </div>
                            </a>

                            <div class="flex flex-col items-end gap-2">
                                <div class="text-lg font-semibold text-gray-900"><?= $course['sale_price'] >= 0 ? number_format($course['sale_price']) : number_format($course['regular_price']) ?>₫</div>
                                <div class="flex items-center gap-2">
                                    <form action="?page=teacher&action=viewEditCourse" method="post">
                                        <input type="hidden" name="course_id" value="<?= $course["course_id"] ?>">
                                        <button class="inline-block text-xs px-3 py-3 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200">Chỉnh sửa</button>
                                    </form>
                                    
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div id="content-reject" class="tab-content hidden">
            <?php if (empty($courseReject) || count($courseReject) == 0): ?>
                <div class="rounded-md border border-dashed border-gray-200 p-8 text-center text-gray-600">
                    Bạn chưa có khóa học nào trong mục này
                </div>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach ($courseReject as $course): ?>
                        <article class="flex items-center gap-4 border-b pb-4">
                            <a class="flex items-center gap-4 flex-1 min-w-0">
                                <div class="flex-shrink-0 w-32 h-20 bg-gray-100 overflow-hidden rounded-sm">
                                    <img src="./Uploads/Courses/<?= $course['course_image'] ?>" alt="<?= htmlspecialchars($course['course_name']) ?>"
                                        class="w-full h-full object-cover" />
                                </div>

                                <div class="min-w-0">
                                    <h3 class="text-md font-semibold text-gray-900 truncate">
                                        <?= htmlspecialchars($course['course_name']) ?></h3>
                                    <p class="mt-1 text-sm truncate">
                                        <span
                                            class="inline-flex items-center text-xs font-medium px-2 py-0.5 rounded-full bg-green-100 text-green-800"><?= $course['student_quantity'] ?>
                                            học viên</span>
                                    </p>
                                    <p class="text-sm mt-1">
                                        <span class="text-yellow-600"><?= $course['rating'] ?>&nbsp;<i
                                                class="bi bi-star-fill text-xs"></i></span>
                                    </p>
                                </div>
                            </a>

                            <div class="flex flex-col items-end gap-2">
                                <div class="text-lg font-semibold text-gray-900"><?= $course['sale_price'] >= 0 ? number_format($course['sale_price']) : number_format($course['regular_price']) ?>₫</div>
                                <div class="flex items-center gap-2">
                                    <form action="?page=teacher&action=viewEditCourse" method="post">
                                        <input type="hidden" name="course_id" value="<?= $course["course_id"] ?>">
                                        <button class="inline-block text-xs px-3 py-3 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200">Chỉnh sửa</button>
                                    </form>
                                    
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
    function changeTabs(type) {
        // Mapping trạng thái → id tab + id content
        const tabMap = {
            1: {
                tab: "tab-approved",
                content: "content-approved"
            },
            2: {
                tab: "tab-pending",
                content: "content-pending"
            },
            0: {
                tab: "tab-editing",
                content: "content-editing"
            },
            3: {
                tab: "tab-disabled",
                content: "content-disabled"
            },
            4: {
                tab: "tab-reject",
                content: "content-reject"
            },
        };

        const current = tabMap[type];

        // Lấy tất cả tab và content
        const allTabs = document.querySelectorAll(".tab-btn");
        const allContents = document.querySelectorAll(".tab-content");

        // Reset toàn bộ tab
        allTabs.forEach(btn => {
            btn.classList.remove("text-blue-400", "border-blue-400");
            btn.classList.add("border-transparent");
        });

        // Reset toàn bộ content
        allContents.forEach(content => content.classList.add("hidden"));

        // Active tab được chọn
        const selectedTab = document.getElementById(current.tab);
        selectedTab.classList.add("text-blue-400", "border-blue-400");

        // Show content
        const selectedContent = document.getElementById(current.content);
        selectedContent.classList.remove("hidden");
    }
</script>

<script src="/Assets/Client/js/alert.js"></script>
