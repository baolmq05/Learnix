<?php
require_once "Models/Category.php";

class CategoryController
{
    private $_category;
    public function __construct()
    {
        $this->_category = new Category();
    }
    public function index()
    {
        include "Views/Admin/Pages/Category/index.php";
    }
    public function create()
    {
       include "Views/Admin/Pages/Category/create.php";
    }
    public function edit()
    {
       include "Views/Admin/Pages/Category/edit.php";
    }
}

?>