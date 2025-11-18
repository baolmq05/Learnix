<?php
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
}
