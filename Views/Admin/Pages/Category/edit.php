<?php 
$error = $_SESSION['error'] ?? [];
unset($_SESSION['error']);
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Chỉnh sửa chủ đề</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa chủ đề</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="?page=category&action=update" method="post" class="form form-vertical">
                        <div class="form-body">
                            <div class="row ">
                                <div class="col-12">
                                    <div class="form-group">    
                                        <input type="hidden" class="form-control" name="id" id="id" value="<?= $result['id'] ?>" readonly>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Tên chủ đề...</label>
                                        <input type="text" id="first-name-vertical" class="form-control" name="name" value="<?= $result['name']?>"
                                            placeholder="Tên chủ đề">
                                            <small class="form-text text-danger"><?= $error['name_mess'] ?? '' ?></small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="form-group">
                                            <textarea id="editor" name="description" placeholder="Mô tả..."><?=$result['description']?></textarea>
                                            <small class="form-text text-danger"><?= $error['description_mess'] ?? '' ?></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <fieldset class="form-group">
                                        <label for="status">Trạng thái</label>
                                        <select class="form-select" name="status" id="status">
                                            <option value="" selected disabled <?= ($result['status']) ? 'selected' : '' ?>>Vui lòng chọn...</option>
                                            <option value="1" <?= ($result['status']== 1) ? 'selected' : '' ?>>Hiển thị</option>
                                            <option value="0" <?= ($result['status']== 0) ? 'selected' : '' ?>>Ẩn</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1" name="update">Cập nhật</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Làm mới</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#editor'));
</script>