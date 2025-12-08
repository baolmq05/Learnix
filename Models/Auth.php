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
            $mail->Body = "
                Mã xác nhận đặt lại mật khẩu của bạn là:
                <h2>{$reset_token}</h2>
                Mã này hết hạn trong 10 phút.
            ";

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
