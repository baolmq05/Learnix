<?php
/** @var array $order */
?>
<style>
    .img {
        height: 150px;
        width: 150px;
        overflow: hidden;
    }

    .img img {
        height: 100%;
        width: 100%;
        object-fit: cover;
    }
</style>
<div class="page-heading">
    <div class="page-title mb-4">
        <h3 class="fw-bold text-dark">Khóa học đã tham gia</h3>
        <p class="text-secondary">Thông tin chi tiết đơn hàng và khóa học của học viên</p>
    </div>

    <section class="section">
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="fw-bold text-dark mb-1">Mã đơn hàng</h6>
                        <h4 class="text-secondary"><?= htmlspecialchars($order['transaction_code']) ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="fw-bold text-dark mb-1">Trạng thái thanh toán</h6>
                        <span class="badge bg-success px-3 py-2 fs-6 fw-bold">Đã thanh toán</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="fw-bold text-dark mb-1">Ngày thanh toán</h6>
                        <h5 class="text-secondary"><?= htmlspecialchars($order['created_at']) ?></h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 p-md-5">
                <div class="row d-flex align-items-stretch"> 
                    <div class="col-md-4 mb-4 mb-md-0 border-end border-light">
                        <h5 class="fw-bold mb-4 text-dark">Thông tin học viên</h5>
                        
                        <dl class="row mb-0">
                            <dt class="col-sm-4 fw-bold text-dark">Họ tên:</dt>
                            <dd class="col-sm-8 text-dark"><?= htmlspecialchars($order['user_name']) ?></dd>
                            
                            <dt class="col-sm-4 fw-bold text-dark">Email:</dt>
                            <dd class="col-sm-8 text-dark"><?= htmlspecialchars($order['user_email']) ?></dd>
                            
                        </dl>
                    </div>
                    <div class="col-md-8 ps-md-5">
                        <h5 class="fw-bold mb-4 text-dark">Chi tiết khóa học</h5>

                        <div class="row align-items-center">
                            <div class="col-md-3 col-4 mb-3 mb-md-0 overflow-hidden">
                                <div class="img">
                                    <img src="./Uploads/Courses/<?= htmlspecialchars($order['course_image']) ?>"
                                    class="rounded shadow object-fit-cover" 
                                    height="150px" 
                                    width="150px" 
                                    alt="<?= htmlspecialchars($order['course_name']) ?>">
                                </div>
                            </div>

                            <div class="col-md-9 col-8">
                                <h4 class="fw-bold mb-1 text-dark">
                                    <a href="#" class="text-decoration-none text-dark">
                                        <?= htmlspecialchars($order['course_name']) ?>
                                    </a>
                                </h4>

                                <div class="d-flex align-items-center mb-2">
                                    <span class="me-2 fw-bold text-dark small">Đánh giá:</span>
                                    <span class="fw-bold text-dark"><?= htmlspecialchars($order['rating']) ?></span>
                                    <i class="bi bi-star-fill text-warning ms-1 small"></i>
                                </div>

                                <p class="mb-1 small fw-bold text-dark">Giảng viên: <span class="text-dark"><?= htmlspecialchars($order['teacher_name']) ?></span></p>

                                <p class="mt-3 mb-1">
                                    <span class="fw-bolder fs-4 text-danger"><?= number_format($order['price']) ?> VND</span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
