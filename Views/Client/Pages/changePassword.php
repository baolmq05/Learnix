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

            <h2 class="text-3xl font-bold text-gray-800 text-center mb-4">Đặt lại mật khẩu</h2>

            <p class="text-gray-600 text-center mb-8">
                Nhập thông tin bên dưới để đặt lại mật khẩu mới cho tài khoản của bạn.
            </p>

            <form id="resetPasswordForm" method="post" action="?page=change_password&action=handleChangePassword"  class="space-y-5">
                <!-- Reset Token -->
                <div>
                    <label for="reset_token" class="block font-medium text-gray-700 mb-2">Mã xác thực</label>
                    <input type="text" value="<?=$old_data['reset_token'] ?? ''?>" name="reset_token" placeholder="Nhập mã xác thực từ email"
                        class="w-full p-3 border rounded focus:ring-2 focus:ring-blue-500">
                    <?php if (isset($errors["token"])): ?>
                        <p class="text-red-500 text-sm mt-1"><?= $errors["token"] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Passwords -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block font-medium text-gray-700 mb-2">Mật khẩu mới</label>
                        <input type="password" name="password" placeholder="Nhập mật khẩu mới"
                            class="w-full p-3 border rounded focus:ring-2 focus:ring-blue-500">
                        <?php if (isset($errors["password"])): ?>
                            <p class="text-red-500 text-sm mt-1"><?= $errors["password"] ?></p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="confirm" class="block font-medium text-gray-700 mb-2">Xác nhận mật khẩu mới</label>
                        <input type="password" name="confirm" placeholder="Nhập lại mật khẩu mới"
                            class="w-full p-3 border rounded focus:ring-2 focus:ring-blue-500">
                        <?php if (isset($errors["confirm"])): ?>
                            <p class="text-red-500 text-sm mt-1"><?= $errors["confirm"] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Submit Button -->
                <button type="submit"  name="change_password"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 rounded-lg flex items-center justify-center gap-2 transition">
                    <i class="bi bi-check-lg"></i>
                    Đặt lại mật khẩu
                </button>

            </form>

            <!-- Links -->
            <div class="text-center mt-6 text-gray-600">
                <a href="?page=login" class="text-blue-600 hover:underline">Quay lại đăng nhập</a>
                <span class="mx-2">|</span>
                <a href="?page=forgot_password&&action=index" class="text-blue-600 hover:underline">Gửi lại mã xác
                    thực</a>
            </div>

        </div>
    </div>
</section>