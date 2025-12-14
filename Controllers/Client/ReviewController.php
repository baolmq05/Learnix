<?php
require_once "./Models/Review.php";
class ReviewController {
    private $_reviewModel;
    
    public function __construct()
    {
        $this->_reviewModel = new Review();
    }

    public function createReview() {
        if(isset($_SESSION["client"])) {
            $userId = $_SESSION["client"]["id"];
            $courseId = $_POST["course_id"];
            $rating = $_POST["rating"];
            $content = $_POST["content"];

            $result = $this->_reviewModel->insert($userId, $courseId, $content, $rating);
        
            if($result) {
                $_SESSION["create_review_success"] = "Đánh giá thành công";
                header("location: ?page=course_learning");
                exit;
            }else{
                echo "Bug";
            }
        }else{
            header("location: ?page=course_learning");
            exit;
        }
    }
}