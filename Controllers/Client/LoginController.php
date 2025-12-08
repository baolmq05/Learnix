<?php

use PSpell\Config;

require_once 'Models/Login.php';
require_once 'Models/Register.php';
class LoginController
{
    public function viewLogin()
    {
        $config = require_once 'Config/config.php';
        $googleURL = "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query([
            "client_id" => $config['client_id'],
            "redirect_uri" => $config['redirect_uri'],
            "response_type" => "code",
            "scope" => "email profile",
            "access_type" => "offline",
            "prompt" => "consent select_account"
        ]);
        include './Views/Client/Pages/login.php';
    }

    public function handleGoogleCallback()
    {
        if (!isset($_GET['code'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $code = $_GET['code'];
        $config = require 'Config/config.php';

        // Lấy access token
        $curl = curl_init("https://oauth2.googleapis.com/token");
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'code' => $code,
                'client_id' => $config['client_id'],
                'client_secret' => $config['client_secret'],
                'redirect_uri' => $config['redirect_uri'],
                'grant_type' => 'authorization_code'
            ],
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $tokenResponse = curl_exec($curl);
        $tokenData = json_decode($tokenResponse, true);

        if (!isset($tokenData['access_token'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $accessToken = $tokenData['access_token'];

        $curl2 = curl_init("https://www.googleapis.com/oauth2/v2/userinfo");
        curl_setopt_array($curl2, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ["Authorization: Bearer $accessToken"],
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $userInfoResponse = curl_exec($curl2);
        $userInfo = json_decode($userInfoResponse, true);

        if (!$userInfo || !isset($userInfo['email'])) {
            $_SESSION['loginError'] = 'Không thể lấy thông tin Google!';
            header('Location: index.php?page=login');
            exit;
        }

        $email = $userInfo['email'];
        $name = $userInfo['name'];

        $registerModel = new Register();

        if ($registerModel->isEmailExists($email)) {

            $existingUser = $registerModel->getUserByEmail($email);

            if ($existingUser['status'] == 0) {
                $_SESSION['error']['loginError'] = 'Tài khoản đã bị khóa!';
                header('Location: index.php?page=login');
                exit;
            }

            $_SESSION['client'] = $existingUser;
            $_SESSION['login_success'] = 'Đăng nhập thành công';
            header('Location: index.php?page=home');
            exit;
        }

        $randomPassword = rand(100000, 999999);
        $registerModel->createUser($name, $email, $randomPassword);

        $newUser = $registerModel->getUserByEmail($email);

        $_SESSION['client'] = $newUser;

        $_SESSION['login_success'] = 'Đăng nhập thành công';
        header('Location: index.php?page=home');
        exit;
    }


    public function handleLogin()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $error = [];

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'Vui lòng nhập email hợp lệ!';
        }
        if (empty($password)) {
            $error['password'] = 'Vui lòng nhập mật khẩu!';
        }

        if (!empty($error)) {
            $_SESSION['error'] = $error;
            header('Location: ?page=login');
            exit;
        }

        $userModel = new Login();
        $user = $userModel->checkLogin($email, $password);

        if ($user == 'locked') {
            $_SESSION['error']['loginError'] = 'Tài khoản đã bị khóa!';
            header('Location: ?page=login');
            exit;
        } elseif ($user === false) {
            $_SESSION['error']['loginError'] = 'Đăng nhập thất bại!';
            $_SESSION['error']['message'] = 'Email hoặc mật khẩu không đúng!';
            header('Location: ?page=login');
            exit;
        } else {
            $_SESSION['client'] = $user;
            if (isset($user['role']) && $user['role'] === 2) {
                if (!isset($_SESSION['client']['information']) || !isset($_SESSION['client']['bank_name']) || !isset($_SESSION['client']['bank_number'])) {
                    $_SESSION['login_success'] = 'Đăng nhập thành công';
                    header('Location: index.php?page=teacher&action=editProfile');
                    exit;
                }
                $_SESSION['login_success'] = 'Đăng nhập thành công';
                header('Location: index.php?page=teacher&action=index');
            } else {
                $_SESSION['login_success'] = 'Đăng nhập thành công';
                header('Location: index.php?login=success');
            }
            exit;
        }
    }
}
