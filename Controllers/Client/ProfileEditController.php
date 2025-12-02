<?php

require_once 'Models/Profile.php';

class ProfileEditController
{

    private $profileModel;

    public function __construct()
    {
        $this->profileModel = new Profile();
    }

    public function viewProfileEdit()
    {
        $studentId = $_GET['id'] ?? null;
        $student = null;
        if ($studentId) {
            $student = $this->profileModel->getUserById($studentId);
        }
        $errors = [];
        if (isset($_SESSION['error']) && is_array($_SESSION['error'])) {
            $errors = $_SESSION['error'];
            unset($_SESSION['error']);
        }
        $old = [];
        if (isset($_SESSION['old']) && is_array($_SESSION['old'])) {
            $old = $_SESSION['old'];
            unset($_SESSION['old']);
        }
        include './Views/Client/Pages/profileDetail.php';
    }

    public function updateUserProfile()
    {
        $userId = $_POST['id'] ?? null;
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $currentPassword = $_POST['current-password'] ?? '';
        $newPassword = $_POST['new-password'] ?? '';
        $confirmPassword = $_POST['confirm-password'] ?? '';
        $error = [];

        if (empty($name)) {
            $error['name'] = 'Tên không được để trống!';
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'Email không hợp lệ!';
        }
        // kiểm tra trùng mail
        $existingUser = $this->profileModel->isEmailExistsForOtherUser($email, $userId);
        if ($existingUser) {
            $error['email'] = 'Email đã tồn tại!';
        }
        $avatarName = null;
        $oldAvatar = null;
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
            $avatar = $_FILES['avatar'];

            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!in_array($avatar['type'], $allowedTypes)) {
                $error['avatar'] = 'Chỉ chấp nhận file JPG, PNG, GIF!';
            }

            if ($avatar['size'] > 2 * 1024 * 1024) {
                $error['avatar'] = 'File ảnh quá lớn! Tối đa 2MB.';
            }

            if (empty($error)) {
                $uploadDir = 'Uploads/Avatar/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $extension = pathinfo($avatar['name'], PATHINFO_EXTENSION);
                $avatarName = 'avatar_' . $userId . '_' . time() . '.' . $extension;
                $uploadPath = $uploadDir . $avatarName;

                // Move uploaded file
                if (!move_uploaded_file($avatar['tmp_name'], $uploadPath)) {
                    $error['avatar'] = 'Lỗi khi upload ảnh!';
                }
            }
        }
        if (!empty($error)) {
            $_SESSION['error'] = $error;
            // preserve old input so the form can be re-populated
            $_SESSION['old'] = $_POST;
            header('Location: ?page=profile_edit&id=' . $userId);
            exit;
        }
        // If user requested password change, validate provided passwords
        $wantChangePassword = strlen(trim($newPassword)) > 0;
        if ($wantChangePassword) {
            // Need current password
            if (empty($currentPassword)) {
                $error['current_password'] = 'Vui lòng nhập mật khẩu hiện tại để thay đổi mật khẩu.';
            }
            if (strlen($newPassword) < 6) {
                $error['new_password'] = 'Mật khẩu mới phải có ít nhất 6 ký tự.';
            }
            if ($newPassword !== $confirmPassword) {
                $error['confirm_password'] = 'Mật khẩu xác nhận không khớp.';
            }

            // Verify current password matches stored hash
            if (empty($error)) {
                $existingUser = $this->profileModel->getUserById($userId);
                $storedHash = $existingUser['password'] ?? null;
                if (!$storedHash || !password_verify($currentPassword, $storedHash)) {
                    $error['current_password'] = 'Mật khẩu hiện tại không đúng.';
                }
            }

            if (!empty($error)) {
                 $_SESSION['error'] = $error;
                 // preserve old input so the form can be re-populated
                 $_SESSION['old'] = $_POST;
                 header('Location: ?page=profile_edit&id=' . $userId);
                exit;
            }
        }
        if ($avatarName) {
            $existing = $this->profileModel->getUserById($userId);
            $oldAvatar = $existing['avatar'] ?? null;
        }
        $isUpdated = $this->profileModel->updateUserProfile($userId, $name, $email, $avatarName);
        if ($isUpdated) {
            $_SESSION['client']['name'] = $name;
            $_SESSION['client']['email'] = $email;
            if ($avatarName) {
                // update session avatar
                $_SESSION['client']['avatar'] = $avatarName;
                // delete old avatar file if exists and is different
                if (!empty($oldAvatar) && $oldAvatar !== $avatarName) {
                    $oldPath = 'Uploads/Avatar/' . $oldAvatar;
                    if (is_file($oldPath)) {
                        @unlink($oldPath);
                    }
                }
            }

            // If user requested password change, attempt to update it now
            if (!empty($newPassword)) {
                $hashed = password_hash($newPassword, PASSWORD_BCRYPT);
                $pwdUpdated = $this->profileModel->updateUserPassword($userId, $hashed);
                if (!$pwdUpdated) {
                    // rollback new avatar file if it was uploaded
                    if ($avatarName) {
                        $newPath = 'Uploads/Avatar/' . $avatarName;
                        if (is_file($newPath)) {
                            @unlink($newPath);
                        }
                        // restore session avatar to old value if existed
                        if (!empty($oldAvatar)) {
                            $_SESSION['client']['avatar'] = $oldAvatar;
                        } else {
                            unset($_SESSION['client']['avatar']);
                        }
                    }
                    $_SESSION['error']['general'] = 'Cập nhật mật khẩu thất bại, vui lòng thử lại!';
                    header('Location: ?page=profile_edit&id=' . $userId);
                    exit;
                }
            }

            $_SESSION['update_success'] = 'Cập nhật thành công!';
            header('Location: ?page=profile');
            exit;
        } else {
            // cleanup uploaded file if update failed
            if ($avatarName) {
                $newPath = 'Uploads/Avatar/' . $avatarName;
                if (is_file($newPath)) {
                    @unlink($newPath);
                }
            }
            $_SESSION['error']['general'] = 'Cập nhật thông tin thất bại, vui lòng thử lại!';
            header('Location: ?page=profile_edit&id=' . $userId);
            exit;
        }
    }

}