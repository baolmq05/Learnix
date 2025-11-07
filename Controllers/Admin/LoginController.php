<?php
require_once 'Models/Login.php';
class LoginController{
    private $_login;
    public function viewLogin(){
        include 'Views/Admin/Pages/Login/index.php';
    }
}
?>