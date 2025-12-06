<?php
require_once 'Models/Category.php';
require_once 'Models/Cart.php';
class CategoryNavigationController
{
    private $_categoryModel;
    private $_cartModel;
    public function __construct()
    {
        $this->_categoryModel = new Category();
        $categories = $this->_categoryModel->getAllByStatus();
        $this->_cartModel = new Cart();
        $user_id = $_SESSION['client']['id'] ?? '';
        $cartItems = $this->_cartModel->getAllCart($user_id);
        include "Views/Client/Layout/header.php";
    }
}
