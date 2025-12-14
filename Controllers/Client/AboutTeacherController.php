<?php
require_once 'Models/Teacher.php';
require_once "./Models/Course.php";
class AboutTeacherController
{
    private $_teacherModel;
    private $_courseModel;

    public function __construct()
    {
        $this->_teacherModel = new Teacher();
        $this->_courseModel = new Course();
    }

    public function viewAboutTeacher()
    {
        include_once "./Views/Client/Pages/aboutTeacher.php";
    }

    public function viewProfileTeacher()
    {
        $teacherId = $_POST["teacher_id"];

        if (isset($teacherId) && !empty($teacherId)) {
            $teacherObj = null;

            $teacherObj = $this->_teacherModel->getById($teacherId);
            $teacherObj['courses'] = $this->_teacherModel->countCoursesByTeacher($teacherId);
            $teacherObj['students'] = $this->_teacherModel->countStudentsByTeacher($teacherId);
            $teacherObj['rating'] = $this->_teacherModel->calRatingByCourse($teacherId);
            $teacherCourse = $this->_courseModel->getTeacherCourses($teacherId, 1);

            include_once "./Views/Client/Pages/profileTeacher.php";
        }
    }
}
