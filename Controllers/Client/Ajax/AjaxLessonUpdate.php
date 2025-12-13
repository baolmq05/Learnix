<?php
$lessonName = isset($_POST["lesson_name"]) ? $_POST["lesson_name"] : "";
$lessonId = isset($_POST["lesson_id"]) ? $_POST["lesson_id"] : "";

$fileVideo = isset($_FILES["videoFile"]) ? $_FILES["videoFile"] : "";
$videoLength = isset($_POST["videoLength"]) ? $_POST["videoLength"] : "";
$videoName = isset($_POST["videoName"]) ? $_POST["videoName"] : "";
$videoId = isset($_POST["videoId"]) ? $_POST["videoId"] : "";

require_once "../../../Models/LessonAjax.php";
require_once "../VideoUpload/VideoObjectController.php";
require_once "../VideoUpload/VideoUploadController.php";
require_once "../../../Models/CourseAjax.php";

$lessonModel = new LessonAjax();
$videoObjectControl = new VideoObjectController();
$videoUploadControl = new VideoUploadController();
$courseModel = new CourseAjax();

if ($fileVideo == "" || empty($fileVideo)) {
    $resultUpdate = $lessonModel->updateNameById($lessonName, $lessonId);
    if ($resultUpdate) {
        $courseModel->updateTimeUpdate($courseId);
        echo true;
    }
} else {
    // Xóa video phía trên trước
    $deleteResult = $videoObjectControl->deleteVideo($videoId);

    if ($deleteResult == 200) {
        // Tạo video object
        $newVideoObjectId = $videoObjectControl->createObjectVideo($lessonName);

        if ($newVideoObjectId) {
            // Thêm vào database
            $resultLesson = $lessonModel->updateLessonVideo($lessonName, $lessonId, $videoName, $newVideoObjectId);
            // Upload video vào videoObject
            $newVideoId = $videoUploadControl->execUpload($fileVideo, $newVideoObjectId);

            $courseModel->updateTimeUpdate($courseId);

            echo $newVideoId;
        } else {
            echo "Tạo video object thất bại";
        }
    }
}
