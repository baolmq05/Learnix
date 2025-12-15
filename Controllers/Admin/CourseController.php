<?php
require_once 'Models/Course.php';
require_once 'Models/Review.php';
class CourseController
{
    private $_course;
    private $_review;

    public function __construct()
    {
        $this->_course = new Course();
        $this->_review = new Review();
    }

    public function viewIndex()
    {
        $courses = $this->_course->getAllCourseAdmin(1);
        include 'Views/Admin/Pages/Course/index.php';
    }
    public function viewCourse()
    {
        $courseId = $_GET['id'] ?? '';
        if ($courseId == '') {
            header("Location: ?page=course&action=index");
            exit();
        }
        $course = $this->_course->getOneCourse($courseId);
        $sections = $this->_course->getSectionByCourseId($courseId);
        $lessons = $this->_course->getAllLessonByCourseId($courseId);
        $relatedCourses = $this->_course->getRelatedCourses($course['category_id'], $courseId, 4);
        $avgRating = $this->_course->getAvgRating($courseId);
        $coursesByTeacher = $this->_course->getCoursesByTeacherId($course['teacher_id'], $courseId, 4);
        $totalCourses = $this->_course->getCountCoursesByTeacher($course['teacher_id']);
        $benefit = explode('*', $course['benefit']);
        $customer_object = explode('*', $course['customer_object']);
        $reviews = $this->_review->getAllReviewsByCourseId($courseId);
        if (!$course) {
            header("Location: ?page=course&action=index");
            exit();
        }
        include 'Views/Admin/Pages/Course/view.php';
    }

     public function viewCourse2()
    {
        $courseId = $_GET['id'] ?? '';
        if ($courseId == '') {
            header("Location: ?page=course&action=index");
            exit();
        }
        $course = $this->_course->getOneCourseStatus0($courseId);
        $sections = $this->_course->getSectionByCourseId($courseId);
        $lessons = $this->_course->getAllLessonByCourseId($courseId);
        $relatedCourses = $this->_course->getRelatedCourses($course['category_id'], $courseId, 4);
        $avgRating = $this->_course->getAvgRating($courseId);
        $coursesByTeacher = $this->_course->getCoursesByTeacherId($course['teacher_id'], $courseId, 4);
        $totalCourses = $this->_course->getCountCoursesByTeacher($course['teacher_id']);
        $benefit = explode('*', $course['benefit']);
        $customer_object = explode('*', $course['customer_object']);
        $reviews = $this->_review->getAllReviewsByCourseId($courseId);
        if (!$course) {
            header("Location: ?page=course&action=index");
            exit();
        }
        include 'Views/Admin/Pages/Course/view.php';
    }
    public function accept()
    {
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
            $this->_course->updateStatus($id, $status, null);
            $_SESSION['course_success'] = "Cập nhật trạng thái khóa học thành công";
            header("Location: ?page=course&action=accept");
            exit();
        }
        include "Views/Admin/Pages/Course/edit.php";
    }

    public function reject()
    {
        $id = $_GET['id'] ?? '';
        if ($id == '') {
            header("Location: ?page=course&action=index");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'] ?? '';
            $reason = $_POST['reason'] ?? '';
            $return = $_POST['return'] ?? 'detail';
            $this->_course->updateStatus($id, $status, $reason);
            $_SESSION['course_success'] = "Cập nhật trạng thái khóa học thành công";
            header("Location: ?page=course&action=accept");
            exit();
        }
        include "Views/Admin/Pages/Course/edit.php";
    }
}
?>