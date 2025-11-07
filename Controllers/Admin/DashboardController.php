<?php
require 'Models/Dashboard.php';
class DashboardController
{
    private $_dashboard;
    public function __construct()
    {
        $this->_dashboard = new Dashboard();
    } 
    function index()
    {
        require 'Views/Admin/Pages/dashboard.php';
    }
}
?>