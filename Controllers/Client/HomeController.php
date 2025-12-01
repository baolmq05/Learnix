<?php
require_once 'Models/Index.php';
require_once 'Models/Dashboard.php';
class HomeController
{
    private $_indexModel;
    public function __construct()
    {
        $this->_indexModel = new Index();
    }

    public function viewIndex()
{
    $userId = $_SESSION['client']['id'] ?? null;
    $userIdRoll = $_SESSION['client']['role'] ?? null;  
    // lấy khóa học đã đăng ký của hv chưa hoàn thành
    $enrollCourses = $userId ? $this->_indexModel->getEnrollCourse($userId) : [];

    $courses = [];

    foreach ($enrollCourses as $enroll) {
        $courseId = $enroll['course_id'];
        $enrollId = $enroll['id']; // id trongg enroll_courses

        // lấy thông tin khóa học
        $course = $this->_indexModel->getCourseById($courseId);

        if ($course) {
            // tổng số bài học trong khóa
            $totalLessons = $this->_indexModel->getTotalLessons($courseId);

            // số bài đã hoàn thành
            $completedLessons = count($this->_indexModel->getCompletedLessons($enrollId));

            // tính % hoàn thành
            $percent = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;

            // tổng thời gian khóa học
            $totalLength = $this->_indexModel->getTotalLength($courseId);
            // var_dump($totalLength);
            // return;
            // gắn thêm thông tin vào course
            $course['percent_completed'] = $percent;
            $course['total_length'] = $totalLength;

            $courses[] = $course;
        }
    }

    $result = $this->_indexModel->getTop10EnrollCoursesIndex();
    $top1 = $this->_indexModel->getTop1EnrollCoursesIndex();
    $top10Sale = $this->_indexModel->getTop10SaleCoursesIndex();

    require_once "Views/Client/Pages/home.php";
}

}
