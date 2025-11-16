<?php
    class LessonPlayerController {
        private $_lessonPlayer;
        public function __construct(){

        }
        public function viewLesson(){
            include 'Views/Client/Pages/lessonPlayer.php';
        }
    }
?>