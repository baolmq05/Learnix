<?php
$success = $_SESSION['course_success'] ?? null;
unset($_SESSION['course_success']);
?>
<style>
    .truncate-text {
        max-width: 300px;
        /* 👈 độ rộng tối đa của ô */
        white-space: nowrap;
        /* không xuống dòng */
        overflow: hidden;
        /* ẩn phần vượt quá khung */
        text-overflow: ellipsis;
        /* hiển thị dấu “...” */
    }

    #bank_info_modal {
        display: none;
        background-color: rgba(0, 0, 0, 0.3);
    }

    #reason_modal {
        display: none;
        background-color: rgba(0, 0, 0, 0.3);
    }

    textarea {
        width: 100%;
    }
    /* Header modal từ chối */
.modal-reject .modal-header {
    background: linear-gradient(135deg, #ef4444); /* đỏ dịu, gradient */
    color: #fff;
}

/* Nút Xác nhận */
.modal-reject .btn-danger {
    background: linear-gradient(135deg, #ef4444, #b91c1c);
    border: none;
    color: #fff;
}

.modal-reject .btn-danger:hover {
    background: linear-gradient(135deg, #b91c1c, #991b1b);
}
</style>
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
                <h3>Khóa học chờ duyệt</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Khóa học chờ duyệt</li>
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
                            <th>Tên khóa học</th>
                            <th>Tên chủ đề</th>
                            <th>Tên giảng viên</th>
                            <th>Thời lượng</th>
                            <th>Giá</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; ?>
                        <?php foreach ($courses as $course): ?>
                            <tr>
                                <td><?= $count++; ?></td>
                                <td class="truncate-text"><?= htmlspecialchars($course['course_name']) ?></td>
                                <td><?= htmlspecialchars($course['category_name']) ?></td>
                                <td><?= htmlspecialchars($course['instructor']) ?></td>
                                <td><?= $course['total_length'] ?? 0 ?> giờ</td>
                                <td><?= number_format($course['sale_price']) ?>đ</td>
                                <td class="text-center">
                                    <button type="button"
                                        class="btn btn-outline-success d-inline-flex align-items-center p-2"
                                        data-bs-toggle="modal" data-bs-target="#modalEdit<?= $course['id'] ?>">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </button>
                                    <button type="button" data-bs-toggle="modal"
                                        data-bs-target="#modalReject<?= $course['id'] ?>"
                                        class="btn btn-outline-danger d-inline-flex align-items-center p-2"><i
                                            class="bi bi-x-circle-fill"></i></button>
                                    <a href="?page=course&action=view2&id=<?= $course['id'] ?>" class="btn btn-outline-warning d-inline-flex align-items-center p-2"><i
                                            class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                            <!-- modal edit -->
                            <!-- Modal Edit -->
                            <div class="modal fade" id="modalEdit<?= $course['id'] ?>" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content shadow-lg border-0 rounded-4">
                                        <form action="?page=course&action=update&id=<?= $course['id'] ?>" method="post">
                                            <input type="hidden" name="return" value="index">
                                            <input type="hidden" name="status" value="1">

                                            <div class="modal-header bg-warning text-white rounded-top-4">
                                                <h5 class="modal-title fw-bold">Cập nhật trạng thái</h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body text-center py-4">
                                                <h4 class="fw-semibold mb-3">Bạn có chắc chắn duyệt khóa học này?</h4>
                                            </div>

                                            <div class="modal-footer px-4 pb-3">
                                                <button type="button" class="btn btn-light border" data-bs-dismiss="modal">
                                                    Trở về
                                                </button>
                                                <button type="submit" class="btn btn-primary px-4">
                                                    Duyệt
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal reject Edit -->
                            <div class="modal fade modal-reject" id="modalReject<?= $course['id'] ?>" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content shadow-lg border-0 rounded-4">
                                        <form action="?page=course&action=reject&id=<?= $course['id'] ?>" method="post">
                                            <input type="hidden" name="return" value="index">
                                            <input type="hidden" name="status" value="4">
                                            <div class="modal-header  text-dark rounded-top-4 border-0">
                                                <h5 class="modal-title fw-bold text-white">Cập nhật trạng thái</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center py-4">
                                                <i class="bi bi-exclamation-triangle-fill text-danger fs-1 mb-3"></i>
                                                <h5 class="fw-semibold mb-3">Bạn có chắc chắn từ chối yêu cầu duyệt khóa học
                                                </h5>
                                                <div class="mb-3 text-start">
                                                    <label for="rejectionReasonText" class="form-label fw-semibold">Lý do từ
                                                        chối</label>
                                                    <textarea class="form-control" id="rejectionReasonText" name="reason"
                                                        rows="4" placeholder="Nhập lý do từ chối..." required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between px-4 pb-3 border-0">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    Trở về
                                                </button>
                                                <button type="submit" class="btn btn-danger text-white px-4">
                                                    Xác nhận
                                                </button>
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