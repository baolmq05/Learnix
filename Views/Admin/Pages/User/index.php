<?php
$success = $_SESSION['student_success'] ?? $_SESSION['teacher_success'] ?? $_SESSION['admin_success'] ?? $_SESSION['user_success'] ?? null;
$danger = $_SESSION['user_danger'] ?? null;
unset($_SESSION['student_success'], $_SESSION['teacher_success'], $_SESSION['admin_success'], $_SESSION['user_success'])
?>
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <?php if (!empty($success)): ?>
                <div id="alert_success" class="alert alert-success d-flex align-items-center" role="alert">
                    <div class="text-nowrap">
                        <?= $success ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Quản lí người dùng</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Thống kê</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Quản lý người dùng</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <a class="btn btn-primary" href="?page=user&action=create">Thêm người dùng</a>
                </div>
                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Học viên</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Giảng viên</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Quản trị viên</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <table class="table table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên học viên</th>
                                    <th>Email</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $index = 1;
                                $isStudentError = isset($_SESSION['open_modal'], $_SESSION['user_type']) && $_SESSION['user_type'] === 'student';
                                foreach ($students as $student) :
                                    $isCurrentStudentError = $isStudentError && $_SESSION['open_modal'] == $student['id'];
                                ?>
                                    <tr>
                                        <td><?= $index++ ?></td>
                                        <td><?= htmlspecialchars($student['name']) ?></td>
                                        <td><?= htmlspecialchars($student['email']) ?></td>
                                        <td>
                                            <span class="badge <?= $student['status'] == '1' ? 'bg-success' : 'bg-danger'; ?>">
                                                <?= $student['status'] == '1' ? 'Hoạt động' : 'Đã khóa'; ?>
                                            </span>
                                            <div class="modal-warning me-1 mb-1 d-inline-block">
                                                <button type="button" class="btn btn-warning d-inline-flex align-items-center p-2"
                                                    data-bs-toggle="modal" data-bs-target="#warning-student-<?= $student['id'] ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <div class="modal fade text-left" id="warning-student-<?= $student['id'] ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="myModalLabel140"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-warning">
                                                                <h5 class="modal-title white" id="myModalLabel140">
                                                                    Chỉnh sửa trạng thái học viên <?= htmlspecialchars($student['name']) ?>
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <form action="?page=user&action=update&id=<?= $student['id'] ?>" method="post" class="form form-vertical">
                                                                <input type="hidden" name="user_type" value="student">
                                                                <div class="modal-body">
                                                                    <div class="col-12 mb-3">
                                                                        <div class="form-group">
                                                                            <label for="student_status_<?= $student['id'] ?>">Trạng thái</label>
                                                                            <select onchange="chooseRole(<?= $student['id'] ?>, 'student')"
                                                                                id="student_status_<?= $student['id'] ?>"
                                                                                name="status" class="form-select">
                                                                                <?php
                                                                                $selectedStatus = $isCurrentStudentError ? ($_SESSION['status_old'] ?? $student['status']) : $student['status'];
                                                                                ?>
                                                                                <option value="1" <?= $selectedStatus == '1' ? 'selected' : '' ?>>Hoạt động</option>
                                                                                <option value="0" <?= $selectedStatus == '0' ? 'selected' : '' ?>>Vô hiệu</option>
                                                                            </select>
                                                                            <?php if ($isCurrentStudentError && isset($_SESSION['status_error'])): ?>
                                                                                <small class="text-danger"><?= $_SESSION['status_error'] ?></small>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <?php
                                                                        $statusDisplay = $isCurrentStudentError ? ($_SESSION['status_old'] ?? $student['status']) : $student['status'];
                                                                        // Lấy lý do khóa cũ nếu có lỗi
                                                                        $lockReason = $isCurrentStudentError ? ($_SESSION['lock_reason_old'] ?? $student['lock_reason'] ?? '') : ($student['lock_reason'] ?? '');
                                                                        ?>
                                                                        <div class="form-group" id="lock_reason_student_<?= $student['id'] ?>" style="display:<?= $statusDisplay == '0' ? 'block' : 'none'; ?>;">
                                                                            <label for="lock_reason">Lý do khóa</label>
                                                                            <textarea name="lock_reason" class="form-control"><?= htmlspecialchars($lockReason) ?></textarea>
                                                                            <?php if ($isCurrentStudentError && isset($_SESSION['lock_reason_error'])): ?>
                                                                                <small class="text-danger"><?= $_SESSION['lock_reason_error'] ?></small>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-light-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Đóng</span>
                                                                    </button>
                                                                    <button type="submit" name="updateUser" class="btn btn-warning ml-1">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Cập nhật</span>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="?page=user&action=edit&id=<?= $student['id'] ?>" class="btn btn-outline-info d-inline-flex align-items-center p-2"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <table class="table table-hover" id="teacher_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên giảng viên</th>
                                    <th>Email</th>
                                    <th>Ngân hàng</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $index = 1;
                                $isTeacherError = isset($_SESSION['open_modal'], $_SESSION['user_type']) && $_SESSION['user_type'] === 'teacher';
                                foreach ($teachers as $teacher) :
                                    $isCurrentTeacherError = $isTeacherError && $_SESSION['open_modal'] == $teacher['id'];
                                ?>
                                    <tr>
                                        <td><?= $index++ ?></td>
                                        <td><?= htmlspecialchars($teacher['name']) ?></td>
                                        <td><?= htmlspecialchars($teacher['email']) ?></td>
                                        <td><?= !empty($teacher['bank_name']) ? $teacher['bank_name'] : "Chưa cập nhật" ?></td>
                                        <td>
                                            <span class="badge <?= $teacher['status'] == '1' ? 'bg-success' : 'bg-danger'; ?>">
                                                <?= $teacher['status'] == '1' ? 'Hoạt động' : 'Đã khóa'; ?>
                                            </span>
                                            <div class="modal-warning me-1 mb-1 d-inline-block">
                                                <button type="button" class="btn btn-warning d-inline-flex align-items-center p-2"
                                                    data-bs-toggle="modal" data-bs-target="#warning-teacher-<?= $teacher['id'] ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <div class="modal fade text-left" id="warning-teacher-<?= $teacher['id'] ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="myModalLabel140"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-warning">
                                                                <h5 class="modal-title white" id="myModalLabel140">
                                                                    Chỉnh sửa trạng thái giảng viên <?= htmlspecialchars($teacher['name']) ?>
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <form action="?page=user&action=update&id=<?= $teacher['id'] ?>" method="post" class="form form-vertical">
                                                                <input type="hidden" name="user_type" value="teacher">
                                                                <div class="modal-body">
                                                                    <div class="col-12 mb-3">
                                                                        <div class="form-group">
                                                                            <label for="teacher_status_<?= $teacher['id'] ?>">Trạng thái</label>
                                                                            <select onchange="chooseRole(<?= $teacher['id'] ?>, 'teacher')"
                                                                                id="teacher_status_<?= $teacher['id'] ?>"
                                                                                name="status" class="form-select">
                                                                                <?php
                                                                                $selectedStatus = $isCurrentTeacherError ? ($_SESSION['status_old'] ?? $teacher['status']) : $teacher['status'];
                                                                                ?>
                                                                                <option value="1" <?= $selectedStatus == '1' ? 'selected' : '' ?>>Hoạt động</option>
                                                                                <option value="0" <?= $selectedStatus == '0' ? 'selected' : '' ?>>Vô hiệu</option>
                                                                            </select>
                                                                            <?php if ($isCurrentTeacherError && isset($_SESSION['status_error'])): ?>
                                                                                <small class="text-danger"><?= $_SESSION['status_error'] ?></small>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <?php
                                                                        $statusDisplay = $isCurrentTeacherError ? ($_SESSION['status_old'] ?? $teacher['status']) : $teacher['status'];
                                                                        $lockReason = $isCurrentTeacherError ? ($_SESSION['lock_reason_old'] ?? $teacher['lock_reason'] ?? '') : ($teacher['lock_reason'] ?? '');
                                                                        ?>
                                                                        <div class="form-group" id="lock_reason_teacher_<?= $teacher['id'] ?>" style="display:<?= $statusDisplay == '0' ? 'block' : 'none'; ?>;">
                                                                            <label for="lock_reason">Lý do khóa</label>
                                                                            <textarea name="lock_reason" class="form-control"><?= htmlspecialchars($lockReason) ?></textarea>
                                                                            <?php if ($isCurrentTeacherError && isset($_SESSION['lock_reason_error'])): ?>
                                                                                <small class="text-danger"><?= $_SESSION['lock_reason_error'] ?></small>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-light-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Đóng</span>
                                                                    </button>
                                                                    <button type="submit" name="updateUser" class="btn btn-warning ml-1">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Cập nhật</span>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="?page=user&action=edit&id=<?= $teacher['id'] ?>" class="btn btn-outline-info d-inline-flex align-items-center p-2"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <table class="table table-hover" id="admin_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên quản trị viên</th>
                                    <th>Email</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $index = 1;
                                foreach ($admins as $admin) : ?>
                                    <tr>
                                        <td><?= $index++ ?></td>
                                        <td><?= htmlspecialchars($admin['name']) ?></td>
                                        <td><?= htmlspecialchars($admin['email']) ?></td>
                                        <td>
                                            <span class="badge <?= $admin['status'] == '1' ? 'bg-success' : 'bg-danger'; ?>">
                                                <?= $admin['status'] == '1' ? 'Hoạt động' : 'Đã khóa'; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="?page=user&action=edit&id=<?= $admin['id'] ?>" class="btn btn-outline-info d-inline-flex align-items-center p-2"><i class="bi bi-eye"></i></a>
                                        </td>
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

<script>
    function chooseRole(id, type) {
        let status = document.querySelector(`#${type}_status_${id}`);
        let reasonBox = document.querySelector(`#lock_reason_${type}_${id}`);

        if (reasonBox) {
            if (status.value == 1) {
                reasonBox.style.display = "none";
            } else {
                reasonBox.style.display = "block";
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
            button.addEventListener('click', function() {
                let modals = document.querySelectorAll('.modal.show');
                modals.forEach(modalElement => {
                    let modalInstance = bootstrap.Modal.getInstance(modalElement);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                });
            });
        });

        <?php if (isset($_SESSION['open_modal'], $_SESSION['user_type'])): 
            $userType = $_SESSION['user_type']; 
            $modalId = "warning-" . $userType . "-" . $_SESSION['open_modal'];
            
            $tabId = '';
            if ($userType === 'teacher') {
                $tabId = 'profile-tab'; 
            } elseif ($userType === 'student') {
                $tabId = 'home-tab'; 
            }
        ?>
            let tabButton = document.getElementById("<?= $tabId ?>");
            if (tabButton) {
                let tab = new bootstrap.Tab(tabButton);
                tab.show();
            }

            let modalElLoi = document.getElementById("<?= $modalId ?>");
            if (modalElLoi) {
                let myModal = new bootstrap.Modal(modalElLoi);
                myModal.show();
                chooseRole(<?= $_SESSION['open_modal'] ?>, '<?= $userType ?>');
            }
            <?php
            unset($_SESSION['open_modal'], $_SESSION['user_type']);
            ?>
        <?php endif; ?>
    });
</script>
<?php
unset($_SESSION['status_old'], $_SESSION['lock_reason_old'], $_SESSION['lock_reason_error'], $_SESSION['status_error']);
?>