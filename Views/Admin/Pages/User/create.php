<?php
$active = $_SESSION['active_tab'] ?? 'home';
$danger = $_SESSION['student_error'] ?? $_SESSION['teacher_error'] ?? $_SESSION['admin_error'] ?? null;
unset($_SESSION['active_tab']);
unset($_SESSION['student_error'], $_SESSION['teacher_error'], $_SESSION['admin_error']);
?>

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <?php if (!empty($danger)): ?>
                <div id="alert_success" class="alert alert-danger d-flex align-items-center" role="alert">
                    <div>
                        <?= $danger ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Thêm người dùng</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Thống kê</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm người dùng</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?= $active == 'home' ? 'active' : '' ?>"
                                    data-bs-toggle="tab" data-bs-target="#home">
                                    Học viên
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?= $active == 'profile' ? 'active' : '' ?>"
                                    data-bs-toggle="tab" data-bs-target="#profile">
                                    Giảng viên
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?= $active == 'contact' ? 'active' : '' ?>"
                                    data-bs-toggle="tab" data-bs-target="#contact">
                                    Quản trị viên
                                </button>
                            </li>
                        </ul>
                        <a href="?page=user" class="d-flex btn btn-secondary align-items-center gap-2"><i class="bi bi-arrow-left"></i>Quay lại</a>
                    </div>

                    <div class="tab-content">

                        <div class="tab-pane fade <?= $active == 'home' ? 'show active' : '' ?>" id="home">
                            <form action="?page=user&action=store" method="post" class="form form-vertical">
                                <input type="hidden" name="active_tab" value="home">

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Tên học viên</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="<?= $_SESSION['errors']['name_student_old'] ?? '' ?>">
                                                <small class="text-danger"><?= $_SESSION['errors']['name_student_error'] ?? '' ?></small>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="<?= $_SESSION['errors']['email_student_old'] ?? '' ?>">
                                                <small class="text-danger"><?= $_SESSION['errors']['email_student_error'] ?? '' ?></small>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Làm mới</button>
                                            <button type="submit" class="btn btn-primary me-1 mb-1" name="createStudent">Thêm</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade <?= $active == 'profile' ? 'show active' : '' ?>" id="profile">
                            <form action="?page=user&action=store" method="post" class="form form-vertical">
                                <input type="hidden" name="active_tab" value="profile">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Tên giảng viên</label>
                                                <input type="text" class="form-control" name="name" value="<?= $_SESSION['errors']['name_teacher_old'] ?? '' ?>">
                                                <small class="text-danger"><?= $_SESSION['errors']['name_teacher_error'] ?? '' ?></small>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" name="email" value="<?= $_SESSION['errors']['email_teacher_old'] ?? '' ?>">
                                                <small class="text-danger"><?= $_SESSION['errors']['email_teacher_error'] ?? '' ?></small>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Ngân hàng</label>
                                                <input type="text" class="form-control" name="bank_name" value="<?= $_SESSION['errors']['bank_name_teacher_old'] ?? '' ?>">
                                                <small class="text-danger"><?= $_SESSION['errors']['bank_name_teacher_error'] ?? '' ?></small>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Số tài khoản</label>
                                                <input type="text" class="form-control" name="bank_number" value="<?= $_SESSION['errors']['bank_number_teacher_old'] ?? '' ?>">
                                                <small class="text-danger"><?= $_SESSION['errors']['bank_number_teacher_error'] ?? '' ?></small>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Làm mới</button>
                                            <button type="submit" class="btn btn-primary me-1 mb-1" name="createTeacher">Thêm</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade <?= $active == 'contact' ? 'show active' : '' ?>" id="contact">
                            <form action="?page=user&action=store" method="post" class="form form-vertical">
                                <input type="hidden" name="active_tab" value="contact">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Tên quản trị viên</label>
                                                <input type="text" class="form-control" name="name" value="<?= $_SESSION['errors']['name_admin_old'] ?? '' ?>">
                                                <small class="text-danger"><?= $_SESSION['errors']['name_admin_error'] ?? '' ?></small>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" name="email" value="<?= $_SESSION['errors']['email_admin_old'] ?? '' ?>">
                                                <small class="text-danger"><?= $_SESSION['errors']['email_admin_error'] ?? '' ?></small>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Làm mới</button>
                                            <button type="submit" class="btn btn-primary me-1 mb-1" name="createAdmin">Thêm</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php unset($_SESSION['errors']); ?>