<section class="section mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0 text-white"><i class="bi bi-person-circle me-2"></i>Hồ sơ cá nhân</h4>
        </div>
        <div class="card-body mt-5">
            <div class="row">
                <!-- Ảnh đại diện -->
                <div class="col-md-3 text-center border-end">
                    <img src="Assets/Admin/images/faces/1.jpg" class="rounded-circle mb-3" width="120" height="120" alt="Avatar">
                    <h5 class="mb-1">John Duck</h5>
                    <p class="text-muted">Quản trị viên</p>
                    <button class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i> Cập nhật ảnh</button>
                </div>

                <!-- Thông tin cá nhân -->
                <div class="col-md-9">
                    <form action="#" method="POST">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Họ và tên</label>
                                <input type="text" class="form-control" value="John Duck">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control" value="john@example.com">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Số điện thoại</label>
                                <input type="text" class="form-control" value="0123456789">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Chức vụ</label>
                                <input type="text" class="form-control" value="Admin">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Giới thiệu bản thân</label>
                            <textarea class="form-control" rows="3">Xin chào, tôi là quản trị viên hệ thống!</textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-save"></i> Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Đổi mật khẩu -->
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0"><i class="bi bi-shield-lock-fill me-2"></i>Đổi mật khẩu</h4>
        </div>
        <div class="card-body mt-5">
            <form action="#" method="POST">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Mật khẩu hiện tại</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Mật khẩu mới</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control">
                    </div>
                </div>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-warning px-4 text-white">
                    Cập nhật mật khẩu
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>