<?php
$success = $_SESSION['comment_success'] ?? null;
unset($_SESSION['comment_success']);
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <?php if (!empty($success)): ?>
                <div id="alert_success" class="alert alert-success d-flex align-items-center" role="alert">
                    <div>
                        <?= $success ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Quản lý bình luận</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Quản lý bình luận</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên người dùng</th>
                            <th>Tên khóa học</th>
                            <th>Nội dung bình luận</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; ?>
                        <?php foreach ($comments as $comment): ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= htmlspecialchars($comment['user_name']) ?></td>
                                <td class="text-truncate" style="max-width: 200px;">
                                    <?= htmlspecialchars($comment['course_name']) ?>
                                </td>
                                <td class="text-truncate" style="max-width: 500px;">
                                    <?= htmlspecialchars($comment['content']) ?>
                                </td>
                                <td>
                                    <span class="badge <?= ($comment['status'] == 1) ? 'bg-success' : 'bg-danger' ?>">
                                        <?= ($comment['status'] == 1) ? 'Hiển thị' : 'Ẩn' ?></span>
                                </td>
                                <td>
                                    <a href="?page=comment&action=detail&id=<?= $comment['id'] ?>"
                                        class="btn btn-outline-info d-inline-flex align-items-center p-2"><i
                                            class="bi bi-eye"></i></a>
                                    <button type="button" class="btn btn-warning d-inline-flex align-items-center p-2"
                                        data-bs-toggle="modal" data-bs-target="#modalEdit<?= $comment['id'] ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- modal edit -->
                            <div class="modal fade" id="modalEdit<?= $comment['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="?page=comment&action=edit&id=<?= $comment['id'] ?>" method="post">
                                            <input type="hidden" name="return" value="index">
                                            <div class="modal-header bg-warning">
                                                <h5 class="modal-title">Cập nhật trạng thái</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <select name="status" id="status" class="form-control mb-3" required>
                                                    <option value="1" <?= ($comment['status'] == 1) ? 'selected' : '' ?>>Hiển
                                                        thị
                                                    </option>
                                                    <option value="0" <?= ($comment['status'] == 0) ? 'selected' : '' ?>>Ẩn
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Trở
                                                    về</button>
                                                <button type="submit" class="btn btn-primary">Sửa</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
</div>