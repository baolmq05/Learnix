<div class="container py-4">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-chat-dots me-2"></i>Chi tiết bình luận</h5>
            <a href="admin.php?page=comment&action=index"
                class="btn btn-light btn-sm d-inline-flex align-items-center gap-1">
                <i class="bi bi-arrow-left"></i>
                Quay lại
            </a>

        </div>

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
                    </div>


                    <div class="col-md-6 mt-3">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Khóa học</label>
                            <input type="text" class="form-control" value="Lập trình PHP căn bản" readonly>
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

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="?page=comment&action=edit"
                        class="btn btn-outline-warning d-inline-flex align-items-center p-2"><i
                            class="bi bi-pencil"></i></a>
                    <button class="btn btn-outline-danger d-inline-flex align-items-center p-2"><i
                            class="bi bi-trash"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>