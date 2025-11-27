<?php

class LogOutController
{
    public function handleLogOutAdmin()
    {
        unset($_SESSION['admin']);
        header('Location: admin.php?page=login');
    }
}
?>