<?php
require_once "Database.php";

class Auth
{
    private $_table = "users";
    private $_connect;

    public function __construct()
    {
        $database = new Database();
        $this->_connect = $database->getConnect();
    }

    // Gửi mã reset cho email
    public function resetToken($email)
    {
        try {
            // Tạo mã reset gồm 6 số
            $reset_token = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $reset_token_expiry = date('Y-m-d H:i:s', time() + 600); // 10 phút

            // Lưu mã vào DB
            $stmt = $this->_connect->prepare("
                UPDATE {$this->_table}
                SET reset_token = :reset_token, reset_token_expiry = :expiry
                WHERE email = :email
            ");

            $stmt->execute([
                'reset_token' => $reset_token,
                'expiry' => $reset_token_expiry,
                'email' => $email
            ]);

            // Gửi email
            require_once __DIR__ . '/../Assets/PHPMailer-6.10.0/src/PHPMailer.php';
            require_once __DIR__ . '/../Assets/PHPMailer-6.10.0/src/SMTP.php';
            require_once __DIR__ . '/../Assets/PHPMailer-6.10.0/src/Exception.php';

            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'phamxuanbac28102003@gmail.com';
            $mail->Password = 'dpkv opvj ulyv ovtc';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('phamxuanbac28102003@gmail.com', 'LEARNIX Support');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Mã xác nhận đặt lại mật khẩu';
$mail->Body = '
<div style="font-family: Arial, sans-serif; background-color:#f3f4f6; padding:32px;">

    <div style="
        max-width:520px;
        margin:0 auto;
        background:white;
        border-radius:16px;
        padding:32px;
        box-shadow:0 8px 30px rgba(0,0,0,0.08);
        border:1px solid #e5e7eb;
    ">

        <!-- Logo -->
        <div style="text-align:center; margin-bottom:24px;">
            <img src="https://res.cloudinary.com/dfmoftnpw/image/upload/v1765528592/logo_sajaxq.jpg" 
                 alt="Logo" 
                 style="width:100px; opacity:0.95;">
        </div>

        <h1 style="
            font-size:24px;
            font-weight:700;
            text-align:center;
            margin-bottom:16px;
            color:#111827;
        ">
            Yêu cầu đặt lại mật khẩu
        </h1>

        <p style="
            font-size:16px;
            color:#374151;
            text-align:center;
            margin-bottom:24px;
            line-height:1.6;
        ">
            Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu từ bạn.<br>
            Dưới đây là mã xác nhận của bạn:
        </p>

        <!-- Token Box -->
        <div style="
            background:#111827;
            color:white;
            padding:20px;
            font-size:32px;
            font-weight:700;
            text-align:center;
            border-radius:12px;
            letter-spacing:4px;
            margin-bottom:24px;
            box-shadow:0 4px 12px rgba(0,0,0,0.15);
        ">
            ' . $reset_token . '
        </div>

        <!-- Warning Box -->
        <div style="
            background:#fef3c7;
            border-left:6px solid #f59e0b;
            padding:16px;
            margin-bottom:24px;
            border-radius:8px;
            color:#92400e;
            font-size:15px;
        ">
            Mã này sẽ hết hạn trong <strong>10 phút</strong>. 
            Vui lòng không chia sẻ mã với bất kỳ ai.
        </div>

        <p style="
            font-size:15px;
            color:#6b7280;
            line-height:1.6;
            margin-bottom:32px;
        ">
            Nếu bạn không thực hiện yêu cầu này, vui lòng bỏ qua email. 
            Tài khoản của bạn vẫn được đảm bảo an toàn.
        </p>

        <div style="text-align:center; color:#9ca3af; font-size:13px;">
            © ' . date("Y") . ' Learnix. All rights reserved.
        </div>

    </div>
</div>
';


            $mail->send();

            return $reset_token;

        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Auth.log");
        }
    }

    //    Lấy thời gian hết hạn token
    public function getTokenInfo($email, $token)
    {
        try {
            $stmt = $this->_connect->prepare("
            SELECT reset_token_expiry
            FROM {$this->_table}
            WHERE email = :email AND reset_token = :token
        ");

            $stmt->execute([
                'email' => $email,
                'token' => $token
            ]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Auth.log");
        }
    }

    // Đổi mật khẩu
    public function resetPassword($email, $newPassword)
    {
        try {
            $stmt = $this->_connect->prepare("
                UPDATE {$this->_table}
                SET password = :password,
                    reset_token = NULL,
                    reset_token_expiry = NULL
                WHERE email = :email
            ");

            $stmt->execute([
                'password' => password_hash($newPassword, PASSWORD_DEFAULT),
                'email' => $email
            ]);

            return true;

        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Auth.log");
        }
    }

    // Lấy thông tin user bằng email
    public function getInfoByEmail($email)
    {
        try {
            $stmt = $this->_connect->prepare("
            SELECT * FROM {$this->_table} WHERE email = :email
        ");
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Auth.log");
        }
    }
}
