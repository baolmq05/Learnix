<?php
require "Models/Order.php";
class OrderController
{
    private $_order;
    public function __construct()
    {
        $this->_order = new Order();
    }
    public function viewIndex()
    {
        $orders = $this->_order->getAllEnrollCourses();
        include "Views/Admin/Pages/Order/index.php";
    }
    public function view()
    {
        $enrollId = $_GET['id'] ?? '';
        if ($enrollId == '') {
            header("Location: ?page=order&action=index");
            exit();
        }
        $order = $this->_order->getEnrollCourseDetail($enrollId);
        include "Views/Admin/Pages/Order/view.php";
    }
    public function delete()
    {
    }
}
