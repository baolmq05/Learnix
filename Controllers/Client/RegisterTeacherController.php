<?php
require_once 'Models/RegisterTeacher.php';
class RegisterTeacherController
{
    public function viewStepRegister($index)
    {
        if ($index == 1) {
            include_once "./Views/Client/Pages/RegisterTeacherStep/registerTeacherStep1.php";
        } else if ($index == 2) {
            include_once "./Views/Client/Pages/RegisterTeacherStep/registerTeacherStep2.php";
        } else {
            include_once "./Views/Client/Pages/RegisterTeacherStep/registerTeacherStep3.php";
        }
    }

    public function handleTeacherRegister()
    {
        if (isset($_POST['buttonRegister'])) {
            $registerTeacherModel = new RegisterTeacher();

            $userId = $_SESSION['client']['id'];
            $isTeacherCreated = $registerTeacherModel->createTeacher($userId);
            if ($isTeacherCreated) {
                $_SESSION['client']['role'] = 2;
                header('Location: ?page=teacher&action=editProfile');
                exit;
            } else {
                $_SESSION['error']['general'] = 'Đăng ký giáo viên thất bại, vui lòng thử lại!';
                header('Location: ?page=registerTeacherStep&index=1');
                exit;
            }
        }

    }
}
