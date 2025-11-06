<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Quản lý chủ đề</h3>
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
                                <tr>
                                    <td>1</td>
                                    <td>Bảo</td>
                                    <td>admin@gmail.com</td>
                                    <td>
                                        <span class="badge bg-success">Hoạt động</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-outline-warning d-inline-flex align-items-center p-2"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-outline-danger d-inline-flex align-items-center p-2"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>Bền</td>
                                    <td>admin@gmail.com</td>
                                    <td>
                                        <span class="badge bg-success">Hoạt động</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-outline-warning d-inline-flex align-items-center p-2"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-outline-danger d-inline-flex align-items-center p-2"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>Bắc</td>
                                    <td>admin@gmail.com</td>
                                    <td>
                                        <span class="badge bg-success">Hoạt động</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-outline-warning d-inline-flex align-items-center p-2"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-outline-danger d-inline-flex align-items-center p-2"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>Toàn</td>
                                    <td>admin@gmail.com</td>
                                    <td>
                                        <span class="badge bg-secondary">Vô hiệu</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-outline-warning d-inline-flex align-items-center p-2"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-outline-danger d-inline-flex align-items-center p-2"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
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
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Bảo</td>
                                    <td>admin@gmail.com</td>
                                    <td>
                                        <span class="badge bg-success">Hoạt động</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-outline-warning d-inline-flex align-items-center p-2"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-outline-danger d-inline-flex align-items-center p-2"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>Bền</td>
                                    <td>admin@gmail.com</td>
                                    <td>
                                        <span class="badge bg-success">Hoạt động</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-outline-warning d-inline-flex align-items-center p-2"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-outline-danger d-inline-flex align-items-center p-2"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>Bắc</td>
                                    <td>admin@gmail.com</td>
                                    <td>
                                        <span class="badge bg-success">Hoạt động</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-outline-warning d-inline-flex align-items-center p-2"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-outline-danger d-inline-flex align-items-center p-2"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>Toàn</td>
                                    <td>admin@gmail.com</td>
                                    <td>
                                        <span class="badge bg-secondary">Vô hiệu</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-outline-warning d-inline-flex align-items-center p-2"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-outline-danger d-inline-flex align-items-center p-2"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
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
                                <tr>
                                    <td>1</td>
                                    <td>Bảo</td>
                                    <td>admin@gmail.com</td>
                                    <td>
                                        <span class="badge bg-success">Hoạt động</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-outline-warning d-inline-flex align-items-center p-2"><i class="bi bi-pencil"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>Bền</td>
                                    <td>admin@gmail.com</td>
                                    <td>
                                        <span class="badge bg-success">Hoạt động</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-outline-warning d-inline-flex align-items-center p-2"><i class="bi bi-pencil"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>Bắc</td>
                                    <td>admin@gmail.com</td>
                                    <td>
                                        <span class="badge bg-success">Hoạt động</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-outline-warning d-inline-flex align-items-center p-2"><i class="bi bi-pencil"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>Toàn</td>
                                    <td>admin@gmail.com</td>
                                    <td>
                                        <span class="badge bg-secondary">Vô hiệu</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-outline-warning d-inline-flex align-items-center p-2"><i class="bi bi-pencil"></i></a>
                                    </td>
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