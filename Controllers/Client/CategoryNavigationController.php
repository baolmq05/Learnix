<?php
require_once 'Models/Category.php';
 class CategoryNavigationController {
    private $_categoryModel;
     public function __construct() {
         $this->_categoryModel = new Category();
         $categories = $this->_categoryModel->getAllByStatus();
         include "Views/Client/Layout/header.php";
     }
 }      
?>