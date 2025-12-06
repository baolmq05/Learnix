<?php
require_once "./Config/Global.php";
require_once "./Models/Course.php";
require_once "./Models/Section.php";
require_once "./Models/Lesson.php";
require_once "./Models/User.php";
require_once './Models/Review.php';
require_once "./Models/EnrollCourseLesson.php";

class LessonPlayerController
{
    private $_lessonPlayer;

    private $_courseModel;
    private $_reviewModel;
    private $_enrollCourseModel;

    public function __construct()
    {
        $this->_courseModel = new Course();
        $this->_reviewModel = new Review();
        $this->_enrollCourseModel = new EnrollCourseLesson();
    }

    public function viewLesson()
    {
        // Cours
        if (isset($_SESSION["client"]) || isset($_SESSION["admin"])) {
            if (isset($_POST["course_id"]) && is_numeric($_POST["course_id"])) {
                $courseId = $_POST["course_id"];
                $courseCurrent = $this->_courseModel->getOneCourse($courseId);
                $teacherRating = $this->_courseModel->getAvgRating($courseCurrent["teacher_id"]);
                $reviewList = $this->_reviewModel->getAllReviewsByCourseId($courseId);

                // Show lesson and section
                $lessonCurrent = [];
                $sectionList = $this->_courseModel->getSectionByCourseId($courseId);
                $lessonList = $this->_enrollCourseModel->getByCourseId($courseId);

                $librabryId = BUNNY_LIBRARY_ID;

                $urlEmbed = "https://iframe.mediadelivery.net/embed/$librabryId/";
                

                for($i = 0; $i < count($lessonList); $i++) {
                    if($lessonList[$i]["enroll_lesson_status"] == 0) {
                        $lessonCurrent = $lessonList[$i];
                        $lessonCurrent["index"] = $i + 1;
                        break;
                    }
                }

                // echo "<pre>";
                // print_r($lessonCurrent);

                // print_r($lessonList);

                if (!empty($courseCurrent["benefit"])) {
                    $benefit = $this->splitStringToArray($courseCurrent["benefit"]);
                }

                if (!empty($courseCurrent["customer_object"])) {
                    $customerObject = $this->splitStringToArray($courseCurrent["customer_object"]);
                }
            }
            include 'Views/Client/Pages/lessonPlayer.php';
        }else{
            header("location: ?page=login");
            exit;
        }

    }

    private function splitStringToArray($str)
    {
        $arr = explode('*', $str);
        $arr = array_map('trim', $arr);

        return $arr;
    }

    private function formatLessonLength($timeString)
    {
        list($h, $m, $s) = explode(":", $timeString);

        // Chuyển sang phút (minute)
        $totalMinutes = $h * 60 + $m + ($s / 60);

        if ($totalMinutes >= 60) {
            // Tính giờ dạng nguyên
            $hours = floor($totalMinutes / 60);
            return $hours . " giờ";
        } else {
            return round($totalMinutes) . " phút";
        }
    }
}
