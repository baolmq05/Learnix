<!DOCTYPE html>
<html lang="en">
<?php
$success = $_SESSION['register_success'] ?? '';
$loginError = $_SESSION['error']['loginError'] ?? '';
$msgError = $_SESSION['error']['message'] ?? $_SESSION['error']['login_password'] ?? $_SESSION['error']['login_email'] ?? '';
unset($_SESSION['register_success']);
unset($_SESSION['error']['loginError']);
unset($_SESSION['error']['message']);
?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="./Assets/Client/css/Alert.css" />
    <title>Login</title>
</head>

<body>
    <?php if (!empty($success)): ?>
        <div id="alert_success" class="flex items-center w-full p-4 mb-4 text-green-800 bg-green-100 rounded-lg"
            role="alert">
            <div>
                <?= $success ?>
            </div>
        </div>
    <?php endif ?>
    <?php if (!empty($loginError)): ?>
        <div id="alert_success" class="flex items-center w-full p-4 mb-4 text-red-800 bg-red-100 rounded-lg" role="alert">
            <div>
                <?= $loginError ?>
            </div>
        </div>

    <?php endif ?>


    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="relative flex flex-col m-6 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0">
            <a href="/index.php?page=home"
                class="absolute left-4 top-4 md:left-6 md:top-6 z-20 inline-flex items-center justify-center gap-2 p-2 ">
                <i class="bi bi-arrow-left text-2xl"></i>
                <span class="font-medium">Quay lại</span>
            </a>
            <div class="flex flex-col justify-center p-8 md:p-14">
                <span class="mb-3 text-4xl font-bold text-center">Đăng nhập</span>
                <span class="font-light text-gray-400 mb-4">
                    Chào mừng bạn trở lại! Vui lòng nhập thông tin chi tiết!
                </span>
                <div class="w-full text-red-800 text-sm min-h-[20px]">
                    <?= $msgError ?? '' ?>
                </div>
                <form action="?page=login&action=handleLogin" name="login" method="POST">
                    <div class="py-4">
                        <span class="mb-2 text-md">Email</span>
                        <input type="email"
                            class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500"
                            name="email" id="email"  value="<?= $_SESSION['error']['old_login_email'] ?? '' ?>" />
                    </div>
                    <div class="py-4">
                        <span class="mb-2 text-md">Mật khẩu</span>
                        <input type="password" name="password" id="password"
                            class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" />
                    </div>
                    <div class="w-full py-4 text-right">
                        <a href="/index.php?page=forgot_password&action=index" class="font-bold text-md" href="">Quên mật khẩu?</a>
                    </div>
                    <button type="submit" name="login"
                        class="w-full bg-black text-white p-2 rounded-lg mb-6 hover:opacity-[0.8] hover:text-white">
                        Đăng nhập
                    </button>
                </form>
                <a href="<?= $googleURL ?>"
                    class="text-center w-full border border-gray-300 text-md p-2 rounded-lg mb-6 hover:bg-black hover:text-white">
                    <img src="./Assets/Client/Images/google.svg" alt="img" class="w-6 h-6 inline mr-2" />
                    Đăng nhập với google
                </a>
                <div class="text-center text-gray-400">
                    Bạn chưa có tài khoản?
                    <a href="/index.php?page=register" class="font-bold text-black">Vui lòng đăng ký</a>
                </div>
            </div>
            <div class="relative">
                <img src="./Assets/Client/Images/login.png" alt="img"
                    class="w-[400px] h-full hidden rounded-r-2xl md:block object-cover" />
                <div
                    class="absolute hidden bottom-10 right-8 p-6 bg-white bg-opacity-30 backdrop-blur-sm rounded drop-shadow-lg md:block">
                    <span class="text-white text-xl">Learnix giúp chúng tôi khởi đầu <br />mọi dự án học tập mới và
                        không<br />
                        thể thiếu được!"
                    </span>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const alertSuccess = document.getElementById('alert_success');

            if (alertSuccess) {
                alertSuccess.addEventListener('animationend', function() {
                    this.style.opacity = '1';
                    this.style.animation = 'none';
                }, {
                    once: true
                });

                setTimeout(() => {
                    alertSuccess.style.opacity = '0';
                    setTimeout(() => {
                        alertSuccess.style.display = 'none';
                    }, 500);
                }, 3000);
            }
        });

        let loginError = sessionStorage.getItem('loginError');
        if (loginError) {
            sessionStorage.removeItem('loginError');
        }
    </script>

</body>
<?php
unset($_SESSION['error']);
?>
</html>