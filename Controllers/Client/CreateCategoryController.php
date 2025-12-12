<?php
require_once "./Models/Category.php";

class CreateCategoryController {
    private $_categoryModel;

    public function __construct()
    {
        $this->_categoryModel = new Category();
    }

    public function createCategory() {
        if(isset($_POST["btn_cate_create"])) {
            $cateName = isset($_POST["category_name"]) ? htmlspecialchars($_POST["category_name"]) : '';
            $cateDescription = isset($_POST["category_description"]) ? htmlspecialchars($_POST["category_description"]) : '';
        
            $categoryList = $this->_categoryModel->getAllCate();
            
            $result = $this->_categoryModel->createCate($cateName, $cateDescription, 1);
            
            if($result == 1) {
                $_SESSION["create_cate_success"] = "Thêm thành công";
                header("location: ?page=teacher&action=viewCreateCourse");
                exit;
            }else{
                $_SESSION["create_cate_danger"] = "Thêm thất bại";
                header("location: ?page=teacher&action=viewCreateCourse");
                exit;
            }
        }
    }
}