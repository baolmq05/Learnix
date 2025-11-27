<!DOCTYPE html>
<html lang="en">
<!-- Thông báo session đăng nhập -->

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <title>Document</title>
</head>

<body>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="relative flex flex-col m-6 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0">
            <a href="/index.php?page=home"
                class="absolute left-4 top-4 md:left-6 md:top-6 z-20 inline-flex items-center justify-center gap-2 p-2">
                <i class="bi bi-arrow-left text-2xl"></i>
                <span class="font-medium">Quay lại</span>
            </a>
            <div class="flex flex-col w-full md:w-1/2 justify-center p-8 md:p-14">
                <span class="mb-3 text-4xl font-bold text-center block">Đăng ký</span>
                <span class="font-light text-gray-400 mb-3 block text-center">
                    Chào mừng bạn! Vui lòng nhập thông tin chi tiết!
                </span>
                <form action="?page=register&action=handleRegister" name="register" method="POST">
                    <div class="py-2 mb-2">
                        <label class="mb-2 text-md block">Tên</label>
                        <input type="text"
                            class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500"
                            name="name" id="name"
                            value="<?php echo htmlspecialchars($_SESSION['old']['name'] ?? '', ENT_QUOTES); ?>" />
                                
                    </div>
                    <div class="py-2 mb-2 relative">
                        <label class="mb-2 text-md block">Email</label>
                        <input type="text"
                            class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500"
                            name="email" id="email"
                            value="<?php echo htmlspecialchars($_SESSION['old']['email'] ?? '', ENT_QUOTES); ?>" />
                            <small class="text-red-600 absolute left-0 -bottom-5 text-sm"><?php echo $_SESSION['error']['email'] ?? ''; ?></small>
                        </div>
                    <div class="py-2 mb-2 relative">
                        <label class="mb-2 text-md block">Mật khẩu</label>
                        <input type="password" name="password" id="password"
                            class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" />
                            <small class="text-red-600 absolute left-0 -bottom-5 text-sm"><?php echo $_SESSION['error']['password'] ?? ''; ?></small>
                    </div>
                    <button type="submit"
                        class="w-full bg-black text-white p-2 rounded-lg my-6 hover:opacity-[0.8] hover:text-white">
                        Đăng ký
                    </button>
                </form>
                <div class="text-center text-gray-400">
                    Bạn đã có tài khoản?
                    <a href="/index.php?page=login"><span class="font-bold text-black">Vui lòng đăng nhập</span></a>
                </div>
            </div>
            <div class="relative hidden md:block w-1/2">
                <img src="./Assets/Client/Images/register.png" alt="img"
                    class="w-[400px] h-full rounded-r-2xl md:block object-cover" />
                <div
                    class="absolute hidden bottom-10 right-11 p-8 bg-white bg-opacity-30 backdrop-blur-sm rounded drop-shadow-lg md:block">
                    <span class="text-white text-xl">Learnix giúp chúng tôi khởi đầu <br />mọi dự án học tập mới và
                        không<br />
                        thể thiếu được!"
                    </span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['old']);
?>