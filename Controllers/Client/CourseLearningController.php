<?php
require_once "./Models/EnrollCourseLesson.php";
require_once "./Models/EnrollCourse.php";
require_once "./Models/Review.php";
class CourseLearningController
{
    private $_enrollCourseLessonModel;
    private $_enrollCourseModel;
    private $_reviewModel;

    public function __construct()
    {
        $this->_enrollCourseLessonModel = new EnrollCourseLesson();
        $this->_enrollCourseModel = new EnrollCourse();
        $this->_reviewModel = new Review();
    }

    public function viewCourseLearning()
    {
        $userId = $_SESSION["client"]["id"];
        if (!$userId) {
            $error['loginError'] = 'Vui lòng đăng nhập!';
            $_SESSION['error'] = $error;
            header("location: ?page=login");
            exit();
        }
        // Data
        if (isset($_SESSION["client"])) {
            $userId = $_SESSION["client"]["id"];
            if (!$userId) {
                $error['loginError'] = 'Vui lòng đăng nhập!';
                $_SESSION['error'] = $error;
                header("location: ?page=login");
                exit();
            }
            $countTotal = $this->_enrollCourseLessonModel->getTotalCountByUserId($userId);
            $countCourseLearning = $this->_enrollCourseLessonModel->getCountByStatusUserId($userId, 0);


            $countCourseDone = $this->_enrollCourseLessonModel->getCountByStatusUserId($userId, 1);

            $enrollCourse = $this->_enrollCourseLessonModel->getEnrollCourseByUserId($userId, 0);

            // Update when progress 100%
            $isLoad = false;
            foreach ($enrollCourse as $key => $value) {
                if ($value["progress_percent"] == 100) {
                    $isLoad = true;
                    $result = $this->_enrollCourseModel->updateStatusById(1, $value["enroll_course_id"]);
                }
            }

            if ($isLoad) {
                header("Location: ?page=course_learning");
                exit();
            }

            $enrollCourseDone = $this->_enrollCourseLessonModel->getEnrollCourseByUserId($userId, 1);

            include_once 'Views/Client/Pages/courseLearning.php';
        } else {
            header("location: ?page=login");
        }
    }

    public function checkHasReview($user_id, $course_id)
    {
        $result = $this->_reviewModel->checkHasReview($user_id, $course_id);
        if($result == "" || $result == false || $result == 0) {
            return false;
        }else{
            return true;
        }
    }
}
