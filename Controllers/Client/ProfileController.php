<?php 
require_once 'Models/EnrollCourseLesson.php';
require_once 'Models/Profile.php';
Class ProfileController{

    private $profileModel;
    private $enrollCourseLessonModel;
    public function __construct(){
        $this->profileModel = new Profile();
        $this->enrollCourseLessonModel = new EnrollCourseLesson();
    }    
    public function viewProfile(){
         $userId = $_SESSION['client']['id'] ?? null;
        $student = null;
        if ($userId) {
            $student = $this->profileModel->getUserById($userId);    
            $student['enrolled_courses'] = $this->profileModel->countEnrolledCourses($userId); 
            $student['completed_courses'] = $this->enrollCourseLessonModel->getEnrollCourseByUserId($userId, 1);
        }
        include './Views/Client/Pages/profile.php';
    }
}