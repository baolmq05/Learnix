<?php
$sectionId = isset($_POST["section_id"]) ? htmlspecialchars($_POST["section_id"]) : "";
$lessonName = isset($_POST["lesson_name"]) ? htmlspecialchars($_POST["lesson_name"]) : "";
$fileVideo = $_FILES["videoFile"];
$videoLength = isset($_POST["videoLength"]) ? $_POST["videoLength"] : "";
$videoName = isset($_POST["videoName"]) ? $_POST["videoName"] : "";
$courseId = $_POST["courseId"];

require_once "../VideoUpload/VideoObjectController.php";
require_once "../VideoUpload/VideoUploadController.php";
require_once "../../../Models/LessonAjax.php";
require_once "../../../Models/EnrollCourseAjax.php";
require_once "../../../Models/EnrollCourseLessonAjax.php";
require_once "../../../Models/CourseAjax.php";

$videoObjectControl = new VideoObjectController();
$videoUploadControl = new VideoUploadController();
// Model
$lessonModel = new LessonAjax();
$enrollCourseModel = new EnrollCourseAjax();
$enrollCourseLessonModel = new EnrollCourseLessonAjax();
$courseModel = new CourseAjax();

$enrollCourseResult = $enrollCourseModel->getAllByCourseId($courseId);

$isBought = false;

if(count($enrollCourseResult) > 0) {
    $isBought = true;
}

$videoObjectId = $videoObjectControl->createObjectVideo($lessonName);

if($videoObjectId) {
    $lessonId = $lessonModel->insert($videoLength, $lessonName, $sectionId, $videoObjectId, $videoName);
    $videoId = $videoUploadControl->execUpload($fileVideo, $videoObjectId);

    // Check có ai mua khóa học hay chưa
    // Nếu có thì phải insert lại vào enroll course lesson
    if($isBought) {
        foreach($enrollCourseResult as $value) {
            $enrollCourseLessonModel->insertByEnrollId($value["id"], $lessonId);
        }
    }

    $courseModel->updateTimeUpdate($courseId);

    $array["lesson_id"] = $lessonId;
    $array["video_id"] = $videoId;

    echo json_encode($array);
}else{
    echo "Tạo video object thất bại";
}