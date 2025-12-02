<?php
$success = $_SESSION['update_success'] ?? '';
unset($_SESSION['update_success']);
?>
<?php if (!empty($success)): ?>
    <div id="alert_success" class="alert alert-success d-flex align-items-center" role="alert">
        <div>
            <?= $success ?>
        </div>
    </div>
<?php endif; ?>
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Thông tin tài khoản</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thông tin tài khoản</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="section mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0 text-white"><i class="bi bi-person-circle me-2"></i>Hồ sơ cá nhân</h4>
        </div>
        <div class="card-body mt-5">
            <form action="?page=profile&action=updateProfile" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id"
                    value="<?= htmlspecialchars($profile['id'] ?? $_SESSION['admin']['id'] ?? '') ?>" />
                <div class="row">
                    <!-- Ảnh đại diện -->
                    <div class="col-md-3 text-center border-end">
                        <img id="avatarPreview"
                            src="<?= 'Uploads/Avatar/' . htmlspecialchars($profile['avatar'] ?? 'default.webp') ?>"
                            class="rounded-circle mb-3" width="120" height="120" alt="Avatar">
                        <h5 class="mb-1"><?= htmlspecialchars($profile['name'] ?? '') ?></h5>
                        <p class="text-muted">Quản trị viên</p>
                        <label
                            class="btn btn-outline-primary btn-sm mt-2 d-inline-flex align-items-center cursor-pointer">
                            <i class="bi bi-pencil me-1"></i>
                            <span>Thay đổi ảnh</span>
                            <input id="avatarInput" type="file" name="avatar" accept="image/*"
                                class="visually-hidden" />
                        </label>
                        <?php if (!empty($errors['avatar'])): ?>
                            <small
                                class="text-sm text-danger d-block mt-2"><?= htmlspecialchars($errors['avatar']) ?></small>
                        <?php endif; ?>
                    </div>

                    <!-- Thông tin cá nhân -->
                    <div class="col-md-9">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Họ và tên</label>
                                <input type="text" name="name" class="form-control"
                                    value="<?= htmlspecialchars($profile['name'] ?? '') ?>">
                                <?php if (!empty($errors['name'])): ?>
                                    <small
                                        class="text-sm text-danger d-block mt-1"><?= htmlspecialchars($errors['name']) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="<?= htmlspecialchars($profile['email'] ?? '') ?>">
                                <?php if (!empty($errors['email'])): ?>
                                    <small
                                        class="text-sm text-danger d-block mt-1"><?= htmlspecialchars($errors['email']) ?></small>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Thông tin</label>
                            <textarea id="editor" name="information"
                                placeholder="Mô tả..."><?= htmlspecialchars($profile['information'] ?? '') ?></textarea>
                            <?php if (!empty($errors['information'])): ?>
                                <small
                                    class="text-sm text-danger d-block mt-1"><?= htmlspecialchars($errors['information']) ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-save"></i> Lưu thay đổi
                            </button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <!-- Đổi mật khẩu -->
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0"><i class="bi bi-shield-lock-fill me-2"></i>Đổi mật khẩu</h4>
            <div class="text-sm text-secondary">Vui lòng để trống nếu không muốn đổi mật khẩu</div>
        </div>
        

        <div class="card-body mt-5">
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Mật khẩu hiện tại</label>
                    <input type="password" name="current_password" class="form-control">
                    <?php if (!empty($errors['current_password'])): ?>
                        <small
                            class="text-sm text-danger d-block mt-1"><?= htmlspecialchars($errors['current_password']) ?></small>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Mật khẩu mới</label>
                    <input type="password" name="new_password" class="form-control">
                    <?php if (!empty($errors['new_password'])): ?>
                        <small
                            class="text-sm text-danger d-block mt-1"><?= htmlspecialchars($errors['new_password']) ?></small>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Xác nhận mật khẩu</label>
                    <input type="password" name="confirm_password" class="form-control">
                    <?php if (!empty($errors['confirm_password'])): ?>
                        <small
                            class="text-sm text-danger d-block mt-1"><?= htmlspecialchars($errors['confirm_password']) ?></small>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Password will be changed if new_password is provided when saving -->
        </div>
    </div>
    </form>
</section>
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#editor'));
</script>
<script>
    // Avatar preview for admin profile
    (function () {
        const input = document.getElementById('avatarInput');
        const preview = document.getElementById('avatarPreview');
        if (!input || !preview) return;

        let currentObjectUrl = null;

        input.addEventListener('change', function (e) {
            const file = input.files && input.files[0];
            if (!file) return;
            if (!file.type.startsWith('image/')) return;

            if (currentObjectUrl) {
                URL.revokeObjectURL(currentObjectUrl);
                currentObjectUrl = null;
            }

            const objectUrl = URL.createObjectURL(file);
            currentObjectUrl = objectUrl;
            preview.src = objectUrl;

            preview.onload = function () {
                if (currentObjectUrl) {
                    URL.revokeObjectURL(currentObjectUrl);
                    currentObjectUrl = null;
                }
            };
        });
    })();
</script>