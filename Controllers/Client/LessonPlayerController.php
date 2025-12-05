<?php
require_once "./Models/Course.php";
require_once "./Models/Section.php";
require_once "./Models/Lesson.php";
class LessonPlayerController
{
    private $_lessonPlayer;

    private $_courseModel;
    private $_reviewModel;
    private $_userModel;
    private $_sectionModel;
    private $_lessonModel;

    public function __construct()
    {
        $this->_courseModel = new Course();
        $this->_sectionModel = new Section();
    }

    public function viewLesson()
    {
        // Đây là một nùi kết quả lấy từ sql :)))

        // Cours
        if (isset($_SESSION["client"]["id"])) {
            if (isset($_POST["course_id"]) && is_numeric($_POST["course_id"])) {
                $courseId = $_POST["course_id"];
                $courseCurrent = $this->_courseModel->getCourseById($courseId);

                if(!empty($courseCurrent["benefit"])) {
                    $benefit = $this->splitStringToArray($courseCurrent["benefit"]);
                }

                if(!empty($courseCurrent["customer_object"])) {
                    $customerObject = $this->splitStringToArray($courseCurrent["customer_object"]);
                }
            }
        }


        // Review
        // User
        // Count học viên
        // Section
        // Lesson

        include 'Views/Client/Pages/lessonPlayer.php';
    }

    private function splitStringToArray($str)
    {
        $arr = explode('*', $str);
        $arr = array_map('trim', $arr);

        return $arr;
    }
}
