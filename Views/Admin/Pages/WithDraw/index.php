<?php
$success = $_SESSION['withDraw_success'] ?? null;
$reject = $_SESSION['withDraw_reject'] ?? null;
unset($_SESSION['withDraw_success']);
unset($_SESSION['withDraw_reject']);
?>
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<style>
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
             <?php if (!empty($reject)): ?>
                <div id="alert_success" class="alert alert-danger d-flex align-items-center" role="alert">
                    <div>
                        <?= $reject ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Quản lý rút tiền</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Thống kê</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Quản lý rút tiền</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">Chờ duyệt <span
                                class="badge bg-warning rounded"><?= $count0 ?></span></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">Đã duyệt <span
                                class="badge bg-success rounded"><?= $count1 ?></span></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                            type="button" role="tab" aria-controls="contact" aria-selected="false">Đã từ chối <span
                                class="badge bg-danger rounded"><?= $count2 ?></span></button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <table class="table table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã rút</th>
                                    <th>Tên giảng viên</th>
                                    <th>Số tiền rút</th>
                                    <th>Số dư</th>
                                    <th>Thông tin ngân hàng</th>
                                    <th>Thời gian</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($withDrawRequestsStatus0 as $item): ?>
                                    <tr>
                                        <td><?= $count++; ?></td>
                                        <td><?= htmlspecialchars($item['transaction_code']); ?></td>
                                        <td><?= htmlspecialchars($item['user_name']); ?></td>
                                        <td><?= number_format($item['amount'], 0, ',', '.') ?> đ</td>
                                        <td class="text-danger"><?= number_format($item['current_balance'], 0, ',', '.') ?>
                                            đ</td>
                                        <td>
                                            <button onclick="openBankModal(this)" data-bank="<?= $item["bank_name"] ?>"
                                                data-account="<?= $item["account_name"] ?>"
                                                data-number="<?= $item["bank_number"] ?>" class="btn btn-outline-info">Xem
                                                chi
                                                tiết</button>
                                        </td>
                                        <td><?= htmlspecialchars($item['created_at']); ?></td>
                                        <td>
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#modalEdit<?= $item['id'] ?>"
                                                class="btn btn-outline-success d-inline-flex align-items-center p-2"><i
                                                    class="bi bi-check-circle-fill"></i></button>
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#modalReject<?= $item['id'] ?>"
                                                class="btn btn-outline-danger d-inline-flex align-items-center p-2"><i
                                                    class="bi bi-x-circle-fill"></i></button>
                                        </td>
                                    </tr>
                                    <!-- Modal Accept Edit -->
                                    <div class="modal fade" id="modalEdit<?= $item['id'] ?>" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content shadow-lg border-0 rounded-4">
                                                <form action="?page=withdraw&action=accept&id=<?= $item['id'] ?>"
                                                    method="post">
                                                    <input type="hidden" name="return" value="index">
                                                    <input type="hidden" name="status" value="1">
                                                    <div class="modal-header bg-warning text-dark rounded-top-4 border-0">
                                                        <h5 class="modal-title fw-bold">Cập nhật trạng thái</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center py-4">
                                                        <i class="bi bi-check-circle-fill text-warning fs-1 mb-3"></i>
                                                        <h5 class="fw-semibold mb-3">Bạn có chắc chắn duyệt yêu cầu rút tiền
                                                            này?</h5>
                                                    </div>
                                                    <div class="modal-footer justify-content-between px-4 pb-3 border-0">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">
                                                            Trở về
                                                        </button>
                                                        <button type="submit" class="btn btn-warning text-white px-4">
                                                            Duyệt
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal reject Edit -->
                                    <div class="modal fade modal-reject" id="modalReject<?= $item['id'] ?>" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content shadow-lg border-0 rounded-4">
                                                <form action="?page=withdraw&action=reject&id=<?= $item['id'] ?>"
                                                    method="post">
                                                    <input type="hidden" name="return" value="index">
                                                    <input type="hidden" name="status" value="1">
                                                    <div class="modal-header  text-dark rounded-top-4 border-0">
                                                        <h5 class="modal-title fw-bold text-white">Cập nhật trạng thái</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center py-4">
                                                        <i
                                                            class="bi bi-exclamation-triangle-fill text-danger fs-1 mb-3"></i>
                                                        <h5 class="fw-semibold mb-3">Bạn có chắc chắn từ chối yêu cầu rút
                                                            tiền này?</h5>
                                                        <div class="mb-3 text-start">
                                                            <label for="rejectionReasonText"
                                                                class="form-label fw-semibold">Lý do từ chối</label>
                                                            <textarea class="form-control" id="rejectionReasonText"
                                                                name="reason" rows="4" placeholder="Nhập lý do từ chối..."
                                                                required></textarea>
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
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <table class="table table-hover" id="admin_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã rút</th>
                                    <th>Tên giảng viên</th>
                                    <th>Số tiền</th>
                                    <th>Số dư</th>
                                    <th>Thông tin ngân hàng</th>
                                    <th>Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($withDrawRequestsStatus1 as $item): ?>
                                    <tr>
                                        <td><?= $count++; ?></td>
                                        <td><?= htmlspecialchars($item['transaction_code']); ?></td>
                                        <td><?= htmlspecialchars($item['user_name']); ?></td>
                                        <td><?= number_format($item['amount'], 0, ',', '.') ?> đ</td>
                                        <td class="text-danger"><?= number_format($item['current_balance'], 0, ',', '.') ?>
                                            đ</td>
                                        <td>
                                            <button onclick="openBankModal(this)" data-bank="<?= $item["bank_name"] ?>"
                                                data-account="<?= $item["account_name"] ?>"
                                                data-number="<?= $item["bank_number"] ?>" class="btn btn-outline-info">Xem
                                                chi
                                                tiết</button>
                                        </td>
                                        <td><?= htmlspecialchars($item['created_at']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <table class="table table-hover" id="teacher_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã rút</th>
                                    <th>Tên giảng viên</th>
                                    <th>Số tiền</th>
                                    <th>Số dư</th>
                                    <th>Thông tin ngân hàng</th>
                                    <th>Lý do</th>
                                    <th>Thời gian</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($withDrawRequestsStatus2 as $item): ?>
                                    <tr>
                                        <td><?= $count++; ?></td>
                                        <td><?= htmlspecialchars($item['transaction_code']); ?></td>
                                        <td><?= htmlspecialchars($item['user_name']); ?></td>
                                        <td><?= number_format($item['amount'], 0, ',', '.') ?> đ</td>
                                        <td class="text-danger"><?= number_format($item['current_balance'], 0, ',', '.') ?>
                                            đ</td>
                                        <td>
                                            <button onclick="openBankModal(this)" data-bank="<?= $item["bank_name"] ?>"
                                                data-account="<?= $item["account_name"] ?>"
                                                data-number="<?= $item["bank_number"] ?>" class="btn btn-outline-info">Xem
                                                chi
                                                tiết</button>
                                        </td>
                                        <td>
                                            <button onclick="openReasonModal(this)" data-reason="<?= $item["reason"] ?>" class="btn btn-outline-warning">Lý
                                                do</button>
                                        <td><?= htmlspecialchars($item['created_at']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>

<!-- Modal -->
<div id="bank_info_modal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông tin ngân hàng</h5>
                <button onclick="closeBankModal()" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Số tài khoản</label>
                        <input type="text" class="form-control" id="bank_number" aria-describedby="emailHelp" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tên chủ tài khoản</label>
                        <input type="text" class="form-control" id="account_name" aria-describedby="emailHelp" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Ngân hàng</label>
                        <input type="text" class="form-control" id="bank_name" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- <div id="reason_modal" class="modal" tabindex="-1"> -->
<div id="reason_modal" class="modal" tabindex="-1" aria-labelledby="rejectionReasonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content modal-custom">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectionReasonModalLabel">
                    Lý do từ chối rút tiền
                </h5>
                <button onclick="closeReasonModal()" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="rejectionForm">
                    <div class="mb-3">
                        <label for="reason" class="form-label">Nội dung từ chối</label>
                        <textarea class="form-control" id="reason" name="reason" rows="4"
                            placeholder="" required></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-info" form="rejectionForm">Xác nhận</button>
            </div>

        </div>
    </div>
</div>
<!-- </div> -->

<script>
    function openBankModal(btn) {
        document.getElementById("bank_number").value = btn.dataset.number;
        document.getElementById("account_name").value = btn.dataset.account;
        document.getElementById("bank_name").value = btn.dataset.bank;
        // let bankModal = document.querySelector("#bank_info_modal");
        document.querySelector("#bank_info_modal").style.display = "block";
    }

    function closeBankModal() {
        let bankModal = document.querySelector("#bank_info_modal");
        bankModal.style.display = "none";
    }

    function openReasonModal(btn) {
        document.getElementById("reason").value = btn.dataset.reason;
        let reasonModal = document.querySelector("#reason_modal");
        reasonModal.style.display = "block";
    }

    function closeReasonModal() {
        let reasonModal = document.querySelector("#reason_modal");
        reasonModal.style.display = "none";
    }
</script>