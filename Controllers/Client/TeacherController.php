<?php
require_once 'Models/Teacher.php';
class TeacherController
{
    private $teacherModel;
    public function __construct()
    {
        $this->teacherModel = new Teacher();
    }

    public function index()
    {
        include 'Views/Client/Pages/Teacher/teacher.php';
    }

    public function viewDetail()
    {
        include 'Views/Client/Pages/Teacher/courseDetail.php';
    }

    public function statistic()
    {
        include 'Views/Client/Pages/Teacher/statistic.php';
    }

    public function profile()
    {
        include 'Views/Client/Pages/Teacher/profile.php';
    }
    public function editProfile()
    {
        include 'Views/Client/Pages/Teacher/editProfile.php';
    }
    public function viewStudents()
    {
        include 'Views/Client/Pages/Teacher/students.php';
    }
}