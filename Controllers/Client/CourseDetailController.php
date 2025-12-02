<?php
require_once 'Models/Course.php';
require_once 'Models/Review.php';
class CourseDetailController
{
    private $_courseModel;
    private $_reviewModel;
    public function __construct()
    {
        $this->_courseModel = new Course();
        $this->_reviewModel = new Review();
    }
    public function viewCourseDetail()
    {
        if (isset($_GET['id'])) {
            $courseId = $_GET['id'];
            $course = $this->_courseModel->getOneCourse($courseId);
            $sections = $this->_courseModel->getSectionByCourseId($courseId);
            $lessons = $this->_courseModel->getAllLessonByCourseId($courseId);
            $relatedCourses = $this->_courseModel->getRelatedCourses($course['category_id'], $courseId, 4);
            $avgRating = $this->_courseModel->getAvgRating($courseId);
            $coursesByTeacher = $this->_courseModel->getCoursesByTeacherId($course['teacher_id'], $courseId, 4);
            $totalCourses = $this->_courseModel->getCountCoursesByTeacher($course['teacher_id']);
            $benefit = explode(',', $course['benefit']);
            $customer_object = explode(',', $course['customer_object']);
            $reviews = $this->_reviewModel->getAllReviewsByCourseId($courseId);
            if (empty($course)) {
                header('location: index.php');
            }
        } else {
            header('location: index.php');
        }
        include 'Views/Client/Pages/courseDetail.php';
    }
}
?>