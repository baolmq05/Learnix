<?php
    require_once 'Models/Category.php';
    require_once 'Models/Course.php';
    class CourseController {
        private $_courseModel;
        private $_categoryModel;
    
    public function __construct() {
        $this->_courseModel = new Course();
        $this->_categoryModel = new Category();
    }
    public function index() {
        if(isset($_GET['category_id'])){
        $category_id = $_GET['category_id'];
        $category = $this->_categoryModel->getOne($category_id);
        $totalCourses = $this->_courseModel->getTotalCoursesByCategory($category_id);
       $courses = $this->_courseModel->getCourseByCategory($category_id);
       }else{
        $totalCourses = $this->_courseModel->getTotalCourses();
        $courses = $this->_courseModel->getAllCourse();
       }
         include 'Views/Client/Pages/categoryProduct.php';
     }
    }
?>