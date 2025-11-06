<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<style>
    #bank_name {
        display: none;
    }

    #bank_number {
        display: none;
    }
</style>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Chỉnh sửa người dùng</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Thống kê</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa người dùng</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical">
                        <div class="form-body">
                            <div class="row ">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Tên học viên</label>
                                        <input type="text" id="first-name-vertical" class="form-control" name="fname"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Email</label>
                                        <input type="text" id="first-name-vertical" class="form-control" name="fname"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Số điện thoại</label>
                                        <input type="text" id="first-name-vertical" class="form-control" name="fname"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Địa chỉ</label>
                                        <input type="text" id="first-name-vertical" class="form-control" name="fname"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Vai trò</label>
                                        <select onchange="chooseRole()" name="" id="role" class="form-select">
                                            <option value="0">Học viên</option>
                                            <option value="1">Giảng viên</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12" id="bank_name">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Ngân hàng</label>
                                        <input type="text" id="first-name-vertical" class="form-control" name="fname"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="col-12" id="bank_number">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Số tài khoản</label>
                                        <input type="text" id="first-name-vertical" class="form-control" name="fname"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Trạng thái</label>
                                        <select name="" id="" class="form-select">
                                            <option value="">Hoạt động</option>
                                            <option value="">Vô hiệu</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Cập nhật</button>
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
<script>
    function chooseRole() {
        let role = document.querySelector("#role");

        if (role.value == 0) {
            document.querySelector("#bank_number").style.display = "none";
            document.querySelector("#bank_name").style.display = "none";
        } else if (role.value == 1) {
            document.querySelector("#bank_number").style.display = "block";
            document.querySelector("#bank_name").style.display = "block";
        }
    }
</script>