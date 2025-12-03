<?php
require_once 'Models/Course.php';
class CourseController{
    private $_course;

    public function __construct() {
        $this->_course = new Course();
    }

    public function viewIndex(){
        $courses = $this->_course->getAllCourseAdmin(1);
        include 'Views/Admin/Pages/Course/index.php';
    }
    public function viewCourse(){
        include 'Views/Admin/Pages/Course/view.php';
    }
    public function accept(){
        $courses = $this->_course->getAllCourseAdmin(0);
        include 'Views/Admin/Pages/Course/accept.php';
    }

      public function update()
    {
        $id = $_GET['id'] ?? '';
        if ($id == '') {
            header("Location: ?page=course&action=index");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'] ?? '';
            $return = $_POST['return'] ?? 'detail';
            $this->_course->updateStatus($id, $status);
            $_SESSION['course_success'] = "Cập nhật trạng thái khóa học thành công";
            header("Location: ?page=course&action=accept");      
            exit();
        }
        include "Views/Admin/Pages/Course/edit.php";
    }
}
?>