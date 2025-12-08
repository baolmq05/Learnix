<?php
$errors = $_SESSION["errors"] ?? [];
$old_data = $_SESSION["old_data"] ?? [];
unset($_SESSION["errors"], $_SESSION["old_data"]);
?>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="./Assets/Client/css/Alert.css" />
    <title>Change Password</title>
</head>
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-lg mx-auto bg-white shadow-lg rounded-2xl p-8">
            
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-4">Quên mật khẩu</h2>

            <p class="text-gray-600 text-center mb-8">
                Nhập tên người dùng và email của bạn để nhận liên kết đặt lại mật khẩu.
            </p>

            <form id="forgotPasswordForm" method="post" action="?page=forgot_password&action=handle" class="space-y-5">
                <!-- Email -->
                <div>
                    <label for="email" class="block font-medium text-gray-700 mb-2">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email"
                        placeholder="Nhập email của bạn"
                        value="<?= htmlspecialchars($old_data["email"] ?? '') ?>"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <?php if (isset($errors["email"])): ?>
                        <p class="text-red-500 text-sm mt-1"><?= $errors["email"] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Submit -->
                <button 
                    type="submit" 
                    name="forgot_password"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg flex items-center justify-center gap-2 transition"
                >
                    <i class="bi bi-send"></i>
                    Gửi mã xác nhận
                </button>

            </form>

            <!-- Links -->
            <div class="text-center mt-6 text-gray-600">
                <a href="?page=login" class="text-blue-600 hover:underline">Quay lại đăng nhập</a>
                <span class="mx-2">|</span>
                <a href="?page=register" class="text-blue-600 hover:underline">Đăng ký tài khoản mới</a>
            </div>

        </div>
    </div>
</section>
