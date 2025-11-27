<!DOCTYPE html>
<html lang="en">
<?php
$showRegisterSuccess = isset($_GET['register']) && $_GET['register'] === 'success';
?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <title>Document</title>
</head>

<body>
    <div id="alert_success" role="alert" style="display:none;"
        class="fixed top-6 right-6 z-50 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg shadow-lg opacity-0 pointer-events-none transform transition-all duration-300 translate-x-full">
        <i class="bi bi-check-circle-fill"></i>
        <div class="text-sm font-medium">Đăng ký thành công</div>
    </div>

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
                <form action="?page=login&action=handleLogin" name="login" method="POST">
                    <div class="py-4">
                        <span class="mb-2 text-md">Email</span>
                        <input type="text"
                            class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500"
                            name="email" id="email" />
                    </div>
                    <div class="py-4">
                        <span class="mb-2 text-md">Mật khẩu</span>
                        <input type="password" name="password" id="password"
                            class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" />
                    </div>
                    <div class="w-full py-4 text-right">
                        <a class="font-bold text-md" href="">Quên mật khẩu?</a>
                    </div>
                    <button type="submit" name="login"
                        class="w-full bg-black text-white p-2 rounded-lg mb-6 hover:opacity-[0.8] hover:text-white">
                        Đăng nhập
                    </button>
                </form>
                <button
                    class="w-full border border-gray-300 text-md p-2 rounded-lg mb-6 hover:bg-black hover:text-white">
                    <img src="./Assets/Client/Images/google.svg" alt="img" class="w-6 h-6 inline mr-2" />
                    Đăng nhập với google
                </button>
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
        (function () {
            const key = "register_success";
            if (!sessionStorage) return;
            const showFromQuery = <?php echo $showRegisterSuccess ? 'true' : 'false'; ?>;
            if (sessionStorage.getItem(key) || showFromQuery) {
                const el = document.getElementById('alert_success');
                if (!el) return;
                el.style.display = 'flex';
                requestAnimationFrame(() => {
                    el.classList.remove('opacity-0', 'pointer-events-none', 'translate-x-full');
                    el.classList.add('opacity-100', 'translate-x-0');
                });

                setTimeout(() => {
                    el.classList.remove('opacity-100', 'translate-x-0');
                    el.classList.add('opacity-0', 'translate-x-full');
                    setTimeout(() => {
                        el.style.display = 'none';
                        sessionStorage.removeItem(key);
                        if (showFromQuery && window.history && window.history.replaceState) {
                            const cleanUrl = window.location.pathname;
                            window.history.replaceState({}, document.title, cleanUrl);
                        }
                    }, 300);
                }, 4000);
            }
        })();
    </script>
</body>

</html>