
    <?php
    $selectedStatus = $_SESSION['status_old'] ?? $user['status'];
    ?>
    <style>
    #lock_reason {
        display: <?= ($selectedStatus ?? '1') == '0' ? 'block' : 'none' ?>;
    }
</style>
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="text-nowrap">Chi tiết người dùng: <span class="fs-3"><?= htmlspecialchars($user['name'] ?? 'N/A') ?></span></h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="?page=user">Quản lý người dùng</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm border-0">
            <div class="card-header">
                <h4 class="card-title fw-bold mb-0">Thông tin cơ bản</h4>
            </div>

            <div class="card-body">
                <div class="row">

                    <!-- Avatar trái -->
                    <div class="col-md-4 d-flex flex-column align-items-center mb-4">
                        <img src="../../../../Uploads/Avatar/<?= htmlspecialchars($user['avatar'] ?? 'default.webp') ?>"
                            class="rounded-circle shadow-sm mb-3"
                            style="width: 150px; height: 150px; object-fit: cover;" alt="Avatar" />
                        <p class="fw-bold text-center fs-5">
                            <?= htmlspecialchars($user['name'] ?? 'Chưa có dữ liệu') ?>
                        </p>
                    </div>

                    <!-- Thông tin bên phải -->
                    <div class="col-md-8">

                        <div class="mb-3">
                            <label class="fw-bold fs-6">Tên người dùng:</label>
                            <p class="form-control-static fw-semibold">
                                <?= htmlspecialchars($user['name'] ?? 'Chưa có dữ liệu') ?>
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold fs-6">Email:</label>
                            <p class="form-control-static fw-semibold">
                                <?= htmlspecialchars($user['email'] ?? 'Chưa có dữ liệu') ?>
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold fs-6">Vai trò:</label>
                            <p class="form-control-static fw-semibold">
                                <?php
                                $user['role'] == '0' ? $role_text = 'Quản trị viên' : ($user['role'] == '2' ? $role_text = 'Giảng viên' : ($user['role'] == '1' ? $role_text = 'Học viên' : $role_text = 'Chưa xác định'));
                                ?>

                                <?php if (($user['role'] ?? null) == '0'): ?>
                                    <span class="badge bg-secondary"><?= $role_text ?></span>
                                <?php elseif (($user['role'] ?? null) == '2'): ?>
                                    <span class="badge bg-warning text-white"><?= $role_text ?></span>
                                <?php elseif (($user['role'] ?? null) == '1'): ?>
                                    <span class="badge bg-info text-white"><?= $role_text ?></span>
                                <?php endif; ?>
                            </p>
                        </div>

                        <?php if (($user['role'] ?? null) === '2'): ?>
                            <div class="mb-3">
                                <label class="fw-bold fs-6">Ngân hàng:</label>
                                <p class="form-control-static fw-semibold">
                                    <?= htmlspecialchars($user['bank_name'] ?? 'Chưa cập nhật') ?>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold fs-6">Số tài khoản:</label>
                                <p class="form-control-static fw-semibold">
                                    <?= htmlspecialchars($user['bank_number'] ?? 'Chưa cập nhật') ?>
                                </p>
                            </div>
                        <?php endif; ?>
                        <form action="?page=user&action=update&id=<?= $user['id'] ?? '' ?>" method="post">
                            <div class="mb-3">
                                <label class="fw-bold fs-6">Trạng thái:</label>
                                <select class="form-select fw-semibold" name="status" id="status" <?= $user['role'] == 0 ? 'disabled' : '' ?>>
                                    <option value="1" <?= ($selectedStatus == '1') ? 'selected' : '' ?>>Hoạt động</option>
                                    <option value="0" <?= ($selectedStatus == '0') ? 'selected' : '' ?>>Vô hiệu</option>
                                </select>
                            </div>
                            <?php
                            $lockReason = $_SESSION['lock_reason_old'] ?? $user['lock_reason'] ?? '';
                            ?>
                            <div class="mb-3" id="lock_reason">
                                <label class="fw-bold fs-6 text-danger">Lý do khóa:</label>
                                <input type="text" name="lock_reason" class="form-control" value="<?= $lockReason ?? 'Không có lý do khóa' ?>">
                                <small class="text-danger"><?= $_SESSION['lock_reason_error'] ?? '' ?></small>
                            </div>

                            <div class="mt-3 d-flex justify-content-end">
                                <a href="?page=user" class="btn btn-secondary me-2">Quay lại</a>
                                <button type="submit" name="updateUserEdit" class="btn btn-primary">Chỉnh sửa</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
unset($_SESSION['status_old']);
unset($_SESSION['lock_reason_old']);
unset($_SESSION['lock_reason_error']);
?>
<script>
    statusSelect = document.getElementById('status');
    lockReasonDiv = document.getElementById('lock_reason');
    statusSelect.addEventListener('change', function() {
        if (this.value === '0') {
            lockReasonDiv.style.display = 'block';
        } else {
            lockReasonDiv.style.display = 'none';
        }
    });
</script>