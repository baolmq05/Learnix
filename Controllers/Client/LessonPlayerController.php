<?php
require_once "./Config/Global.php";
require_once "./Models/Course.php";
require_once "./Models/Section.php";
require_once "./Models/Lesson.php";
require_once "./Models/User.php";
require_once './Models/Review.php';
require_once "./Models/EnrollCourseLesson.php";
require_once "./Models/Note.php";

class LessonPlayerController
{
    private $_lessonPlayer;

    private $_courseModel;
    private $_reviewModel;
    private $_enrollCourseModel;
    private $_noteModel;

    public function __construct()
    {
        $this->_courseModel = new Course();
        $this->_reviewModel = new Review();
        $this->_enrollCourseModel = new EnrollCourseLesson();
        $this->_noteModel = new Note();
    }

    // public function viewLesson()
    // {
    //     // Cours
    //     if (isset($_SESSION["client"]) || isset($_SESSION["admin"])) {
    //         if (isset($_POST["course_id"]) && is_numeric($_POST["course_id"])) {
    //             $userId = $_SESSION["client"]["id"];
    //             $courseId = $_POST["course_id"];
    //             $courseCurrent = $this->_courseModel->getOneCourse($courseId);
    //             $teacherRating = $this->_courseModel->getAvgRating($courseCurrent["teacher_id"]);
    //             $reviewList = $this->_reviewModel->getAllReviewsByCourseId($courseId);

    //             // Show lesson and section
    //             $lessonCurrent = [];
    //             $sectionList = $this->_courseModel->getSectionByCourseId($courseId);
    //             $lessonList = $this->_enrollCourseModel->getByCourseId($courseId, $userId);
    //             $noteList = $this->_noteModel->getNotesByUserAndLesson($userId, $lessonList[0]['id']);
    //             $librabryId = BUNNY_LIBRARY_ID;

    //             $urlEmbed = "https://iframe.mediadelivery.net/embed/$librabryId/";


    //             for ($i = 0; $i < count($lessonList); $i++) {
    //                 if ($lessonList[$i]["enroll_lesson_status"] == 0) {
    //                     $lessonCurrent = $lessonList[$i];
    //                     $lessonCurrent["index"] = $i + 1;
    //                     break;
    //                 }
    //             }

    //             if(count($lessonCurrent) <= 0) {
    //                 $lastIndex = count($lessonList) - 1;
    //                 $lessonCurrent = $lessonList[$lastIndex];
    //             }

    //             // echo "<pre>";
    //             // print_r($lessonCurrent);

    //             // echo "<pre>";
    //             // print_r($lessonList);

    //             if (!empty($courseCurrent["benefit"])) {
    //                 $benefit = $this->splitStringToArray($courseCurrent["benefit"]);
    //             }

    //             if (!empty($courseCurrent["customer_object"])) {
    //                 $customerObject = $this->splitStringToArray($courseCurrent["customer_object"]);
    //             }
    //         }
    //         include 'Views/Client/Pages/lessonPlayer.php';
    //     } else {
    //         header("location: ?page=login");
    //         exit;
    //     }
    // }

    public function viewLesson()
    {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION["client"]) && !isset($_SESSION["admin"])) {
            header("location: ?page=login");
            exit;
        }

        // Kiểm tra course_id
        if (!isset($_POST["course_id"]) || !is_numeric($_POST["course_id"])) {
            header("location: ?page=course_learning");
            exit;
        }

        $userId   = $_SESSION["client"]["id"];
        $courseId = (int)$_POST["course_id"];

        // ===== COURSE =====
        $courseCurrent = $this->_courseModel->getOneCourse($courseId);
        if (empty($courseCurrent)) {
            header("location: ?page=course_learning");
            exit;
        }

        $teacherRating = $this->_courseModel->getAvgRating($courseCurrent["teacher_id"]);
        $reviewList    = $this->_reviewModel->getAllReviewsByCourseId($courseId);

        // ===== SECTION & LESSON =====
        $sectionList = $this->_courseModel->getSectionByCourseId($courseId);
        $lessonList  = $this->_enrollCourseModel->getByCourseId($courseId, $userId);

        if (empty($lessonList)) {
            header("location: ?page=course_learning");
            exit;
        }

        // ===== XÁC ĐỊNH LESSON CURRENT (CHUẨN LMS) =====
        $lessonCurrent = null;
        $lessonIndex   = 1;

        foreach ($sectionList as $section) {
            foreach ($lessonList as $lesson) {

                if ($lesson['section_id'] == $section['section_id']) {

                    // Lesson chưa hoàn thành đầu tiên của section
                    if ($lesson['enroll_lesson_status'] == 0) {
                        $lessonCurrent = $lesson;
                        $lessonCurrent['index'] = $lessonIndex;
                        break 2;
                    }

                    $lessonIndex++;
                }
            }
        }

        // Nếu đã hoàn thành toàn bộ khóa → lấy lesson cuối
        if ($lessonCurrent === null) {
            $lastIndex    = count($lessonList) - 1;
            $lessonCurrent = $lessonList[$lastIndex];
            $lessonCurrent['index'] = $lastIndex + 1;
        }

        // ===== NOTE (FIX ĐÚNG LESSON) =====
        $noteList = $this->_noteModel->getNotesByUserAndLesson(
            $userId,
            $lessonCurrent['lesson_id']
        );

        // ===== OTHER DATA =====
        $libraryId = BUNNY_LIBRARY_ID;
        $urlEmbed  = "https://iframe.mediadelivery.net/embed/$libraryId/";

        if (!empty($courseCurrent["benefit"])) {
            $benefit = $this->splitStringToArray($courseCurrent["benefit"]);
        }

        if (!empty($courseCurrent["customer_object"])) {
            $customerObject = $this->splitStringToArray($courseCurrent["customer_object"]);
        }

        // ===== LOAD VIEW =====
        include 'Views/Client/Pages/lessonPlayer.php';
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
