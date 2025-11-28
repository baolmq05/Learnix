<?php
require 'Models/Dashboard.php';
class DashboardController
{
    private $_dashboard;
    public function __construct()
    {
        $this->_dashboard = new Dashboard();
    }
    public function index()
    {
        // $year = ($_GET['year'] ?? date(format: 'Y'));
        $userStats = $this->_dashboard->getStudentInYear(1, null);

        $labels = array_column($userStats, 'month');
        $data = array_column($userStats, 'Total_students');

        $months = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
        $finalData = [];
        foreach ($months as $m) {
            $index = array_search($m, $labels);
            $finalData[] = $index !== false ? $data[$index] : 0;
        }

        $totalStudents = $this->_dashboard->getUser(1);
        $totalTeachers = $this->_dashboard->getUser(2);
        $totalCourses = $this->_dashboard->getTotalCourse("");
        $pendingCourses = $this->_dashboard->getTotalCourse(0);
        $newStudentsInWeek = $this->_dashboard->getNewStudentsInWeek();
        $completionRate = $this->_dashboard->getCompletionRate();
        $top10EnrollCourses = $this->_dashboard->getTop10EnrollCourses();
        $labelsTop10Courses = array_column($top10EnrollCourses, 'course_name');
        $dataTop10Courses = array_column($top10EnrollCourses, 'total');
        
        require 'Views/Admin/Pages/dashboard.php';
    }



}
?>