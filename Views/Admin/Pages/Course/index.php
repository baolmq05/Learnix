<style>
    .truncate-text {
  max-width: 300px;        /* 👈 độ rộng tối đa của ô */
  white-space: nowrap;     /* không xuống dòng */
  overflow: hidden;        /* ẩn phần vượt quá khung */
  text-overflow: ellipsis; /* hiển thị dấu “...” */
}
</style>
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Quản lý khóa học</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Quản lý khóa học</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover" id="table1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên khóa học</th>
                                        <th>Tên chủ đề</th>
                                        <th>Tên giảng viên</th>
                                        <th>Thời lượng</th>
                                        <th>Giá</th>
                                        <th>Lượt bán</th>
                                        
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td  class="truncate-text">Khóa học lập trình html/css từ zero đến hero</td>
                                        <td>Lập trình web</td>
                                        <td>Phan Văn Tính</td>
                                        <td>24 giờ</td>
                                        <td><?= number_format(200000) ?>đ</td>
                                        <td>200</td>
                                        <td class="text-center">
                                            <span class="badge bg-success">Hiện</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="?page=course&action=view" class="btn btn-outline-info d-inline-flex align-items-center p-2"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>
        </div>
