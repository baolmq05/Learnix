<?php
class UserController
{
    public function __construct() {}

    public function viewIndex()
    {
        include "./Views/Admin/Pages/User/index.php";
    }

    public function viewCreate()
    {
        include "./Views/Admin/Pages/User/create.php";
    }

    public function viewEdit()
    {
        include "./Views/Admin/Pages/User/edit.php";
    }
}
