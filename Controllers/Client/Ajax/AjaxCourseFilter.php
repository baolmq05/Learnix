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
if ($category_id) {
    $courses = $courseModel->getCourseByCategory($category_id);
} else {
    $courses = $courseModel->getAllCourse();
}
$filteredCourses = array_filter($courses, function($course) use ($rating, $durationMin, $durationMax) {
    return $course['rating'] >= $rating && $course['total_length'] >= $durationMin && $course['total_length'] <= $durationMax;
});
if ($sort == 'rating_asc') {
    usort($filteredCourses, function($a, $b) {
        return $a['rating'] <=> $b['rating'];
    });
} elseif ($sort == 'rating_desc') {
    usort($filteredCourses, function($a, $b) {
        return $b['rating'] <=> $a['rating'];
    });
} elseif ($sort == 'price_asc') {
    usort($filteredCourses, function($a, $b) {
        return $a['regular_price'] <=> $b['regular_price'];
    });
} elseif ($sort == 'price_desc') {
    usort($filteredCourses, function($a, $b) {
        return $b['regular_price'] <=> $a['regular_price'];
    });
}
?>
            <div class="text-sm text-gray-600 text-right">
                <span id="results-count"><?= count($reset ? $courses : $filteredCourses) ?> kết quả</span>
            </div>
                <div class="space-y-6">
                <?php foreach($reset ? $courses : $filteredCourses as $course): ?>
                        <article class="flex items-center gap-4 border-b py-3 min-w-0">
                            <a href="#" class="flex items-center gap-3 flex-1 group min-w-0">
                                <div class="flex-shrink-0 w-20 h-14 md:w-56 md:h-32 bg-gray-100 overflow-hidden rounded-sm">
                                    <img src="<?= $course['image'] ?>" alt="<?= htmlspecialchars($course['image']) ?>" class="object-cover w-full h-full" />
                                </div>

                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm md:text-base font-semibold text-gray-900 whitespace-nowrap overflow-hidden text-ellipsis truncate group-hover:text-primary"><?= htmlspecialchars($course['course_name']) ?></h3>
                                    <p class="mt-1 text-xs md:text-sm text-gray-600 whitespace-nowrap overflow-hidden text-ellipsis truncate"><?= htmlspecialchars($course['instructor']) ?> · <span class="text-yellow-600"><?= $course['rating'] == 0 ? 'Chưa có' : $course['rating'] ?>&nbsp;<i class="bi bi-star-fill text-xs"></i></span></p>
                                    <p class="mt-1 text-xs text-gray-500 hidden md:block"> Tổng thời lượng : <?= $course['total_length'] ?? '0' ?> giờ</p>
                                </div>
                            </a>

                            <div class="w-24 flex-shrink-0 text-right">
                                <div class="text-sm md:text-lg font-semibold text-gray-900 truncate"><?= number_format($course['regular_price']) ?>₫</div>
                                <?php if(!empty($course['old'])): ?>
                                    <div class="text-xs text-gray-400 line-through truncate"><?= $course['old'] ?>₫</div>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
    </div>
<?php
                    