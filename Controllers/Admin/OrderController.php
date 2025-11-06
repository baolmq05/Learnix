<?php
require "Models/Order.php";
class OrderController
{
    private $_order;
    public function __construct()
    {
        $this->_order = new Order();
    }
    public function index()
    {
        include "Views/Admin/Pages/Order/index.php";
    }
    public function view()
    {
        include "Views/Admin/Pages/Order/view.php";
    }
    public function delete()
    {
    }
}
