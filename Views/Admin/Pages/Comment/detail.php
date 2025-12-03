<?php
/** @var array $comment */
?>
<?php
$success = $_SESSION['comment_success'] ?? null;
unset($_SESSION['comment_success']);
?>
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Xem chi tiết bình luận</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Xem chi tiết bình luận</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="container py-4">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <a class="btn btn-outline-secondary d-inline-flex align-items-center p-2" href="?page=comment&action=index"><i
                    class="bi bi-arrow-left"></i></a>
            <form action="?page=comment&action=edit&id=<?= $comment['id'] ?>" method="post">
                <input type="hidden" name="return" value="detail">
                <div class="row">
                    <?php if (!empty($success)): ?>
                        <div id="alert_success" class="alert alert-success d-flex align-items-center" role="alert">
                            <div>
                                <?= $success ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-md-6 mt-3">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Người bình luận</label>
                            <input type="text" class="form-control"
                                value="<?= htmlspecialchars($comment['student_name']) ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Rating</label>
                            <div class="fs-5 text-warning">
                                <?php
                                $rating = (int) $comment['rating'];
                                for ($i = 0; $i < 5; $i++) {
                                    if ($i < $rating) {
                                        echo '<i class="bi bi-star-fill"></i>';
                                    } else {
                                        echo '<i class="bi bi-star"></i>';
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Trạng thái</label><br>
                            <span
                                class="badge fs-6 px-3 py-2 <?= ($comment['status'] == 1) ? 'bg-success' : 'bg-danger' ?>">
                                <?= ($comment['status'] == 1) ? 'Hiển thị' : 'Ẩn' ?>
                            </span>
                        </div>

                        <div class="mb-3">
                            <label for="status">Trạng thái</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1" <?= ($comment['status'] == 1) ? 'selected' : '' ?>>Hiển thị</option>
                                <option value="0" <?= ($comment['status'] == 0) ? 'selected' : '' ?>>Ẩn</option>
                            </select>
                            <div class="col-12 d-flex justify-content-start mt-3">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 mt-3">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Khóa học</label>
                            <input type="text" class="form-control"
                                value="<?= htmlspecialchars($comment['course_name']) ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Giảng viên</label>
                            <input type="text" class="form-control"
                                value="<?= htmlspecialchars($comment['teacher_name']) ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ngày tạo</label>
                            <input type="text" class="form-control"
                                value="<?= htmlspecialchars($comment['created_at']) ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ngày cập nhật</label>
                            <input type="text" class="form-control"
                                value="<?= htmlspecialchars($comment['updated_at']) ?>" readonly>
                        </div>
                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nội dung bình luận</label>
                    <textarea class="form-control mb-3" rows="4"
                        readonly><?= htmlspecialchars($comment['content']) ?></textarea>
                    <a href="/index.php?page=course_detail&id=<?= $comment['course_id'] ?>#comment-<?= $comment['id'] ?>"
                        target="_blank" class="btn btn-primary">
                        Xem comment bên kia
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>