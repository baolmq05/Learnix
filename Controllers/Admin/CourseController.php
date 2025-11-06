<?php
require 'Models/Course.php';
class CourseController{
    private $_course;
    public function __construct() {
        $this->_course = new Course();
    }

    public function viewIndex(){
        include 'Views/Admin/Pages/Course/index.php';
    }
    public function viewCourse(){
        include 'Views/Admin/Pages/Course/view.php';
    }
    public function accept(){
        include 'Views/Admin/Pages/Course/accept.php';
    }
}
?>