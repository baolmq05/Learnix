<?php
require_once 'Models/Teacher.php';
require_once 'Models/Profile.php';
class TeacherController
{
    private $teacherModel;
    private $profileModel;

    public function __construct()
    {
        $this->teacherModel = new Teacher();
        $this->profileModel = new Profile();
    }

    public function index()
    {
        include 'Views/Client/Pages/Teacher/teacher.php';
    }

    public function viewDetail()
    {
        include 'Views/Client/Pages/Teacher/courseDetail.php';
    }

    public function statistic()
    {
        include 'Views/Client/Pages/Teacher/statistic.php';
    }

    public function profile()
    {
        $userId = $_SESSION['client']['id'] ?? null;
        $teacher = null;
        if ($userId) {
            $teacher = $this->teacherModel->getById($userId);
            $teacher['courses'] = $this->teacherModel->countCoursesByTeacher($userId);
            $teacher['students'] = $this->teacherModel->countStudentsByTeacher($userId);
            $teacher['rating'] = $this->teacherModel->calRatingByCourse($userId);
        }
        include 'Views/Client/Pages/Teacher/profile.php';
    }
    public function editProfile()
    {
        $userId = $_SESSION['client']['id'] ?? null;
        $teacher = null;
        if ($userId) {
            $teacher = $this->teacherModel->getById($userId);
        }

        // Provide any validation errors and old input to the view (set by updateProfile)
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

        include 'Views/Client/Pages/Teacher/editProfile.php';
    }

    public function updateProfile()
    {
        $userId = $_SESSION['client']['id'];
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $information = $_POST['information'] ?? '';
        $bankName = $_POST['bank_name'] ?? '';
        $bankNumber = $_POST['bank_number'] ?? '';
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        $error = [];
        if (empty($name)) {
            $error['name'] = 'Tên không được để trống!';
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'Email không hợp lệ!';
        }
        if ($this->profileModel->isEmailExistsForOtherUser($email, $userId)) {
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
        // If user requested a password change (filled new password), validate it now
        $wantChangePassword = strlen(trim($newPassword)) > 0;
        if ($wantChangePassword) {
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
        }

        if (!empty($error)) {
            $_SESSION['error'] = $error;
            // preserve old input so the form can be re-populated if needed
            $_SESSION['old'] = $_POST;
            header('Location: ?page=teacher&action=editProfile');
            exit;
        }

        // if a new avatar was uploaded, fetch the existing avatar name so we can delete it after success
        if ($avatarName) {
            $existing = $this->teacherModel->getById($userId);
            $oldAvatar = $existing['avatar'] ?? null;
        }

        $isUpdated = $this->teacherModel->updateTeacherProfile($userId, $name, $email, $information, $avatarName, $bankName, $bankNumber);
        if ($isUpdated) {
            $_SESSION['client']['name'] = $name;
            $_SESSION['client']['email'] = $email;
            $_SESSION['client']['information'] = $information;
            $_SESSION['client']['bank_name'] = $bankName;
            $_SESSION['client']['bank_number'] = $bankNumber;
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
                    header('Location: ?page=teacher&action=editProfile');
                    exit;
                }
            }
            $_SESSION['update_success'] = 'Cập nhật thông tin thành công!';
            header('Location: ?page=teacher&action=profile');
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
            header('Location: ?page=teacher&action=editProfile');
            exit;
        }

    }
    public function viewStudents()
    {
        include 'Views/Client/Pages/Teacher/students.php';
    }
}