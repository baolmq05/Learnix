<!doctype html>
<html lang="en">

<head>
    <title>Đăng nhập</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <!-- Library -->
    <link rel="stylesheet" href="./Assets/Admin/css/bootstrap.css">

    <link rel="stylesheet" href="./Assets/Admin/vendors/iconly/bold.css">

    <link rel="stylesheet" href="./Assets/Admin/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="./Assets/Admin/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="./Assets/Admin/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="./Assets/Admin/css/app.css">
    <link rel="shortcut icon" href="./Assets/Admin/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <main>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <img src="https://frontends.udemycdn.com/components/auth/desktop-illustration-step-2-x2.webp"
                        class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                        alt="">
                </div>
                <div class="col-lg-4 col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h3 class="text-center">Đăng nhập</h3>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form action="?page=login&action=handleLogin" method="POST" class="form form-vertical">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="email">Email</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" placeholder="Email"
                                                            name="email" id="email">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-envelope"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group has-icon-left">
                                                    <label for="password">Mật khẩu</label>
                                                    <div class="position-relative">
                                                        <input type="password" class="form-control"
                                                            placeholder="Mật khẩu" name="password" id="password">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-lock"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class='form-check'>
                                                    <div class="checkbox mt-2">
                                                        <input type="checkbox" id="remember-me-v"
                                                            class='form-check-input' checked>
                                                        <label for="remember-me-v">Ghi nhớ đăng nhập</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Đăng
                                                    nhập</button>
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
    </main>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>