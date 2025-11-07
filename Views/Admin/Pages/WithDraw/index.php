<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<style>
    #bank_info_modal {
        display: none;
        background-color: rgba(0, 0, 0, 0.3);
    }

    #reason_modal {
        display: none;
        background-color: rgba(0, 0, 0, 0.3);
    }

    textarea {
        width: 100%;
    }
</style>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Quản lý rút tiền</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Thống kê</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Quản lý rút tiền</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Chờ duyệt <span class="badge bg-warning rounded">50</span></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Đã duyệt</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Đã từ chối</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <table class="table table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã rút</th>
                                    <th>Tên giảng viên</th>
                                    <th>Số tiền</th>
                                    <th>Số dư</th>
                                    <th>Thông tin ngân hàng</th>
                                    <th>Thời gian</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>#3402</td>
                                    <td>Nguyễn Văn A</td>
                                    <td>1.200.000 đ</td>
                                    <td class="text-danger">1.200.000 đ</td>
                                    <td>
                                        <button onclick="openBankModal()" class="btn btn-outline-info">Xem chi tiết</button>
                                    </td>
                                    <td>07/11/2025</td>
                                    <td>
                                        <a href="#" class="btn btn-outline-success d-inline-flex align-items-center p-2"><i class="bi bi-check-circle-fill"></i></a>
                                        <a href="#" class="btn btn-outline-danger d-inline-flex align-items-center p-2"><i class="bi bi-x-circle-fill"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>#3402</td>
                                    <td>Nguyễn Văn A</td>
                                    <td>1.200.000 đ</td>
                                    <td class="text-danger">1.200.000 đ</td>
                                    <td>
                                        <button onclick="openBankModal()" class="btn btn-outline-info">Xem chi tiết</button>
                                    </td>
                                    <td>07/11/2025</td>
                                    <td>
                                        <a href="#" class="btn btn-outline-success d-inline-flex align-items-center p-2"><i class="bi bi-check-circle-fill"></i></a>
                                        <a href="#" class="btn btn-outline-danger d-inline-flex align-items-center p-2"><i class="bi bi-x-circle-fill"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>#3402</td>
                                    <td>Nguyễn Văn A</td>
                                    <td>1.200.000 đ</td>
                                    <td class="text-danger">1.200.000 đ</td>
                                    <td>
                                        <button onclick="openBankModal()" class="btn btn-outline-info">Xem chi tiết</button>
                                    </td>
                                    <td>07/11/2025</td>
                                    <td>
                                        <a href="#" class="btn btn-outline-success d-inline-flex align-items-center p-2"><i class="bi bi-check-circle-fill"></i></a>
                                        <a href="#" class="btn btn-outline-danger d-inline-flex align-items-center p-2"><i class="bi bi-x-circle-fill"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>#3402</td>
                                    <td>Nguyễn Văn A</td>
                                    <td>1.200.000 đ</td>
                                    <td class="text-danger">1.200.000 đ</td>
                                    <td>
                                        <button onclick="openBankModal()" class="btn btn-outline-info">Xem chi tiết</button>
                                    </td>
                                    <td>07/11/2025</td>
                                    <td>
                                        <a href="#" class="btn btn-outline-success d-inline-flex align-items-center p-2"><i class="bi bi-check-circle-fill"></i></a>
                                        <a href="#" class="btn btn-outline-danger d-inline-flex align-items-center p-2"><i class="bi bi-x-circle-fill"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <table class="table table-hover" id="admin_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã rút</th>
                                    <th>Tên giảng viên</th>
                                    <th>Số tiền</th>
                                    <th>Số dư</th>
                                    <th>Thông tin ngân hàng</th>
                                    <th>Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>#3402</td>
                                    <td>Nguyễn Văn A</td>
                                    <td>1.200.000 đ</td>
                                    <td class="text-danger">1.200.000 đ</td>
                                    <td>
                                        <button onclick="openBankModal()" class="btn btn-outline-info">Xem chi tiết</button>
                                    </td>
                                    <td>07/11/2025</td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>#3402</td>
                                    <td>Nguyễn Văn A</td>
                                    <td>1.200.000 đ</td>
                                    <td class="text-danger">1.200.000 đ</td>
                                    <td>
                                        <button onclick="openBankModal()" class="btn btn-outline-info">Xem chi tiết</button>
                                    </td>
                                    <td>07/11/2025</td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>#3402</td>
                                    <td>Nguyễn Văn A</td>
                                    <td>1.200.000 đ</td>
                                    <td class="text-danger">1.200.000 đ</td>
                                    <td>
                                        <button onclick="openBankModal()" class="btn btn-outline-info">Xem chi tiết</button>
                                    </td>
                                    <td>07/11/2025</td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>#3402</td>
                                    <td>Nguyễn Văn A</td>
                                    <td>1.200.000 đ</td>
                                    <td class="text-danger">1.200.000 đ</td>
                                    <td>
                                        <button onclick="openBankModal()" class="btn btn-outline-info">Xem chi tiết</button>
                                    </td>
                                    <td>07/11/2025</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <table class="table table-hover" id="teacher_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã rút</th>
                                    <th>Tên giảng viên</th>
                                    <th>Số tiền</th>
                                    <th>Số dư</th>
                                    <th>Thông tin ngân hàng</th>
                                    <th>Lý do</th>
                                    <th>Thời gian</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>#3402</td>
                                    <td>Nguyễn Văn A</td>
                                    <td>1.200.000 đ</td>
                                    <td class="text-danger">1.200.000 đ</td>
                                    <td>
                                        <button onclick="openBankModal()" class="btn btn-outline-info">Xem chi tiết</button>
                                    </td>
                                    <td>
                                        <button onclick="openReasonModal()" class="btn btn-outline-warning">Lý do</button>
                                    </td>
                                    <td>07/11/2025</td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>#3402</td>
                                    <td>Nguyễn Văn A</td>
                                    <td>1.200.000 đ</td>
                                    <td class="text-danger">1.200.000 đ</td>
                                    <td>
                                        <button onclick="openBankModal()" class="btn btn-outline-info">Xem chi tiết</button>
                                    </td>
                                    <td>
                                        <button onclick="openReasonModal()" class="btn btn-outline-warning">Lý do</button>
                                    </td>
                                    <td>07/11/2025</td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>#3402</td>
                                    <td>Nguyễn Văn A</td>
                                    <td>1.200.000 đ</td>
                                    <td class="text-danger">1.200.000 đ</td>
                                    <td>
                                        <button onclick="openBankModal()" class="btn btn-outline-info">Xem chi tiết</button>
                                    </td>
                                    <td>
                                        <button onclick="openReasonModal()" class="btn btn-outline-warning">Lý do</button>
                                    </td>
                                    <td>07/11/2025</td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>#3402</td>
                                    <td>Nguyễn Văn A</td>
                                    <td>1.200.000 đ</td>
                                    <td class="text-danger">1.200.000 đ</td>
                                    <td>
                                        <button onclick="openBankModal()" class="btn btn-outline-info">Xem chi tiết</button>
                                    </td>
                                    <td>
                                        <button onclick="openReasonModal()" class="btn btn-outline-warning">Lý do</button>
                                    </td>
                                    <td>07/11/2025</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>

<!-- Modal -->
<div id="bank_info_modal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông tin ngân hàng</h5>
                <button onclick="closeBankModal()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Số tài khoản</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tên chủ tài khoản</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Ngân hàng</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- <div id="reason_modal" class="modal" tabindex="-1"> -->
<div id="reason_modal" class="modal" tabindex="-1" aria-labelledby="rejectionReasonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content modal-custom">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectionReasonModalLabel">
                    Lý do từ chối rút tiền
                </h5>
                <button onclick="closeReasonModal()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="rejectionForm">
                    <div class="mb-3">
                        <label for="rejectionReasonText" class="form-label">Nội dung từ chối</label>
                        <textarea class="form-control" id="rejectionReasonText" name="rejectionReason" rows="4" placeholder="" required></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-info" form="rejectionForm">Xác nhận</button>
            </div>

        </div>
    </div>
</div>
<!-- </div> -->

<script>
    function openBankModal() {
        let bankModal = document.querySelector("#bank_info_modal");
        bankModal.style.display = "block";
    }

    function closeBankModal() {
        let bankModal = document.querySelector("#bank_info_modal");
        bankModal.style.display = "none";
    }

    function openReasonModal() {
        let reasonModal = document.querySelector("#reason_modal");
        reasonModal.style.display = "block";
    }

    function closeReasonModal() {
        let reasonModal = document.querySelector("#reason_modal");
        reasonModal.style.display = "none";
    }
</script>