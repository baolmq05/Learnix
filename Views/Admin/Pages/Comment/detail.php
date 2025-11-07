<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Xem chi tiết bình luận</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Xem chi tiết bình luận</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="container py-4">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Người bình luận</label>
                            <input type="text" class="form-control" value="Nguyễn Văn A" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Rating</label>
                            <div class="fs-5 text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Trạng thái</label><br>
                            <span class="badge bg-success fs-6 px-3 py-2">Hiển thị</span>
                        </div>

                        <div class="mb-3">
                            <label for="status">Trạng thái</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1">Duyệt</option>
                                <option value="0">Không duyệt</option>
                            </select>
                            <div class="col-12 d-flex justify-content-start mt-3">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 mt-3">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Khóa học</label>
                            <input type="text" class="form-control" value="Lập trình PHP căn bản" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Giảng viên</label>
                            <input type="text" class="form-control" value="Thầy Phan Văn Tính" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ngày tạo</label>
                            <input type="text" class="form-control" value="2025-11-06 14:30" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ngày cập nhật</label>
                            <input type="text" class="form-control" value="2025-11-06 16:00" readonly>
                        </div>
                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nội dung bình luận</label>
                    <textarea class="form-control" rows="4" readonly>Khóa học rất hay và dễ hiểu!</textarea>
                </div>
            </form>
        </div>
    </div>
</div>