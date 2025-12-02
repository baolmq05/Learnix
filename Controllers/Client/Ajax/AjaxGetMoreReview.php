<?php 
session_start();
require_once '../../../Models/Review.php';
$reviewModel = new Review();
$courseId = isset($_GET['courseId']);
$start = isset($_GET['start']) ? intval($_GET['start']) : 3;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 3;
$reviews = $reviewModel->getAllReviewsByCourseId($courseId, $start, $limit); 
if (empty($reviews)) {
    echo '<p class="mt-3 text-justify" id="no-more-reviews">Không còn bình luận nào để hiển thị.</p>';
    exit;
}
?>
 <?php foreach ($reviews as $review): ?>
                    <div class="border w-full p-5">
                        <div class="flex gap-5">
                            <div class="w-15 h-15">
                                <img class="rounded-full" src="Uploads/Avatar/<?= $review['avatar'] ?? 'default.webp' ?>"
                                    alt="" />
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
                        <button class="font-bold hover:cursor-pointer" onclick="toggleContent(<?= $review['id'] ?>)">Xem thêm</button>
                    </div>
                <?php endforeach; ?>