<?php
session_start();
require_once '../../../Models/Course.php';
$courseModel = new Course();
$rating = isset($_GET['rating']) ? floatval($_GET['rating']) : 0;
$durationMin = isset($_GET['durationMin']) ? floatval($_GET['durationMin']) : 0;
$durationMax = isset($_GET['durationMax']) ? floatval($_GET['durationMax']) : 1000;
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : '';
$reset = isset($_GET['reset']) ? $_GET['reset'] : '';
$page_number = isset($_GET['page_number']) ? intval($_GET['page_number']) : 1;

if ($sort == 'rating_asc') {
    $sort = 'ASC';
    $dataSort = 'rating';
} elseif ($sort == 'rating_desc') {
    $sort = 'DESC';
    $dataSort = 'rating';
} elseif ($sort == 'price_asc') {
    $sort = 'ASC';
    $dataSort = 'regular_price';
} elseif ($sort == 'price_desc') {
    $sort = 'DESC';
    $dataSort = 'regular_price';
}

if ($category_id) {
    $courses = $courseModel->getCourseByCategory($category_id, ($page_number - 1) * 5, $rating, $durationMin, $durationMax, $sort, $dataSort);
    $totalCourse = $courseModel->getTotalCoursesByCategory($category_id, $rating, $durationMin, $durationMax);
} else {
    $courses = $courseModel->getAllCourse(($page_number - 1) * 5, $rating, $durationMin, $durationMax, $sort, $dataSort);
    $totalCourse = $courseModel->getTotalCourses($rating, $durationMin, $durationMax);
}
$items_per_page = 5;
$range = 2; // Số trang hiển thị trước/sau trang hiện tại
$total_pages = ceil($totalCourse / 5);
// Tính toán phạm vi
$start = max(1, $page_number - $range);
$end = min($total_pages, $page_number + $range);


?>
<div class="text-sm text-gray-600 text-right">
    <span id="results-count"><?= $totalCourse ?> kết quả</span>
</div>
<div class="space-y-6">
    <?php if (empty($courses)): ?>
        <p class="text-center text-gray-500 mt-20">Không có khóa học nào phù hợp với bộ lọc của bạn.</p>
    <?php else: ?>
        <?php foreach ($courses as $course): ?>
            <article class="flex items-center gap-4 border-b py-3 min-w-0">
                <a href="?page=course_detail&id=<?= $course['id'] ?>" class="flex items-center gap-3 flex-1 group min-w-0">
                    <div class="flex-shrink-0 w-20 h-14 md:w-56 md:h-32 bg-gray-100 overflow-hidden rounded-sm">
                        <img src="./Uploads/Courses/<?= $course['image'] ?>" alt="<?= htmlspecialchars($course['image']) ?>"
                            class="object-cover w-full h-full" />
                    </div>

                    <div class="flex-1 min-w-0">
                        <h3
                            class="text-sm md:text-base font-semibold text-gray-900 whitespace-nowrap overflow-hidden text-ellipsis truncate group-hover:text-primary">
                            <?= htmlspecialchars($course['course_name']) ?>
                        </h3>
                        <p
                            class="mt-1 text-xs md:text-sm text-gray-600 whitespace-nowrap overflow-hidden text-ellipsis truncate">
                            <?= htmlspecialchars($course['instructor']) ?> · <span
                                class="text-yellow-600"><?= $course['rating'] == 0 ? 'Chưa có' : $course['rating'] ?>&nbsp;<i
                                    class="bi bi-star-fill text-xs"></i></span>
                        </p>
                        <p class="mt-1 text-xs text-gray-500 hidden md:block"> Tổng thời lượng :
                            <?= $course['total_length'] ?? '0' ?> giờ
                        </p>
                    </div>
                </a>

                <div class="w-24 flex-shrink-0 text-right">
                    <div class="text-sm md:text-lg font-semibold text-gray-900 truncate">
                        <?= number_format($course['sale_price'] == 0 ? $course['regular_price'] : $course['sale_price']) ?>₫
                    </div>
                    <?php if (!empty($course['sale_price'])): ?>
                        <div class="text-xs text-gray-400 line-through truncate"><?= $course['regular_price'] ?>₫</div>
                    <?php endif; ?>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
    <div class="flex justify-center mt-3">
        <nav>
            <ul class="pagination flex gap-2">

                <!-- Nút Trang đầu -->
                <li class="page-item ">
                    <button
                        class="w-10 h-10 flex items-center <?= ($page_number == 1) ? 'bg-gray-100' : '' ?> justify-center border rounded-lg hover:bg-gray-100"
                        onclick="first()">Đầu</button>
                </li>

                <!-- Nút Trang trước -->
                <li class="page-item">
                    <button class="w-10 h-10 flex items-center justify-center border rounded-lg  <?= ($page_number == 1) ? 'bg-gray-100' : '' ?> hover:bg-gray-100"
                        onclick="previous()">&lsaquo;</button>
                </li>

                <!-- Các số trang -->
                <?php for ($i = $start; $i <= $end; $i++): ?>
                    <li class="page-item">
                        <button
                            class="w-10 h-10 flex <?= ($i == $page_number) ? 'bg-purple-600 text-white' : 'bg-white' ?> items-center justify-center border rounded-lg  hover:bg-purple-400 hover:text-white"
                            onclick="goToPage(<?= $i ?>)"><?= $i ?></button>
                    </li>
                <?php endfor; ?>

                <!-- Nút Trang sau -->
                <li class="page-item">
                    <button
                        class="w-10 h-10 flex items-center justify-center border rounded-lg  <?= ($page_number == $total_pages) ? 'bg-gray-100' : '' ?> hover:bg-gray-100"
                        onclick="next()">&rsaquo;</button>
                </li>

                <!-- Nút Trang cuối -->
                <li class="page-item ">
                    <button
                        class="w-10 h-10 flex items-center justify-center border rounded-lg  <?= ($page_number == $total_pages) ? 'bg-gray-100' : '' ?> hover:bg-gray-100"
                        onclick="last()">Cuối
                    </button>
                </li>

            </ul>
        </nav>
    </div>
<?php endif; ?>