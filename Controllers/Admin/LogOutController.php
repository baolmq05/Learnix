<?php

class LogOutController
{
    public function handleLogOutAdmin()
    {
        unset($_SESSION['admin']);
        $_SESSION['logout_success'] = 'Đăng xuất thành công!';
        header('Location: admin.php?page=login');
    }
}
?>