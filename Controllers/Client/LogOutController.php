<?php

class LogOutController{
    public function handleLogOut(){
        unset($_SESSION['client']);
        header('Location: ?page=home');

    }
}
?>