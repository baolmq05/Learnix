<?php
$success = $_SESSION['category_success'] ?? null;
unset($_SESSION['category_success']);
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
                <h3>Quản lý chủ đề</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Quản lý chủ đề</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="mb-3"><a class="btn btn-primary" href="?page=category&action=create">Thêm chủ đề</a></div>
                <table class="table table-hover" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên chủ đề</th>
                            <th>Mô tả</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; ?>
                        <?php foreach ($result as $r): ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= $r['name'] ?></td>
                                <td>...</td>
                                <td>
                                    <?php if ($r['status'] == 1): ?>
                                        <span class="badge bg-success">Hiện</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Ẩn</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="?page=category&action=edit&id=<?= $r['id'] ?>"
                                        class="btn btn-outline-warning d-inline-flex align-items-center p-2"><i
                                            class="bi bi-pencil"></i></a>
                                    <button type="button"
                                        class="btn btn-outline-danger d-inline-flex align-items-center p-2"
                                        data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                        data-id="<?= $r['id'] ?>">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa danh mục này không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <form id="deleteForm" method="post" style="display:inline;">
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const deleteModal = document.getElementById('confirmDeleteModal');
    deleteModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const form = document.getElementById('deleteForm');
        form.action = `?page=category&action=delete&id=${id}`;
    });
</script>