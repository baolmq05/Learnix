<?php
class DashboardController
{
    private $_dashboard;
    public function __construct()
    {
        $this->_dashboard = new Dashboard();
    }
}
?>