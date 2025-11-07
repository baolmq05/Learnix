<?php
require "Models/Profile.php";

class ProfileController
{
    private $_profile;
    public function __construct()
    {
        $this->_profile = new Profile();
    }
    public function viewProfile()
    {
        include "Views/Admin/Pages/Profile/index.php";
    }
}
?>