<!DOCTYPE html>
<html lang="en">

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
                <div class="py-4">
                    <span class="mb-2 text-md">Email</span>
                    <input type="text"
                        class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500"
                        name="email" id="email" />
                </div>
                <div class="py-4">
                    <span class="mb-2 text-md">Mật khẩu</span>
                    <input type="password" name="pass" id="pass"
                        class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" />
                </div>
                <div class="w-full py-4 text-right">
                    <a class="font-bold text-md" href="">Quên mật khẩu?</a>
                </div>
                <button class="w-full bg-black text-white p-2 rounded-lg mb-6 hover:opacity-[0.8] hover:text-white">
                    Đăng nhập
                </button>
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
</body>

</html>