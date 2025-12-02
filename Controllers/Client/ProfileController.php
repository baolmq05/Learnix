<?php 

require_once 'Models/Profile.php';
Class ProfileController{

    private $profileModel;
    public function __construct(){
        $this->profileModel = new Profile();
    }    
    public function viewProfile(){
         $userId = $_SESSION['client']['id'] ?? null;
        $student = null;
        if ($userId) {
            $student = $this->profileModel->getUserById($userId);    
            $student['enrolled_courses'] = $this->profileModel->countEnrolledCourses($userId); 
            $student['completed_courses'] = $this->profileModel->getcompletedCourses($userId);
        }
        include './Views/Client/Pages/profile.php';
    }
}