<?php

class LogOutController{
    public function handleLogOut(){
        unset($_SESSION['client']);
        $_SESSION['logout_success'] = 'Đăng xuất thành công!';
        header('Location: ?page=home');

    }
}
?>