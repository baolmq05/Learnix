<?php
require_once 'Models/CategoryProduct.php';
 class CategoryProductController {
    private $categoryProductModel;
     public function __construct() {
         $this->categoryProductModel = new CategoryProduct();
     }

     public function index() {
         include 'Views/Client/Pages/categoryProduct.php';
     }
 }      
?>