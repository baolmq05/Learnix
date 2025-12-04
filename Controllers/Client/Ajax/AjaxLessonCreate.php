<?php
$sectionId = isset($_POST["section_id"]) ? htmlspecialchars($_POST["section_id"]) : "";
$lessonName = isset($_POST["lesson_name"]) ? htmlspecialchars($_POST["lesson_name"]) : "";
$fileVideo = $_FILES["videoFile"];
$videoLength = isset($_POST["videoLength"]) ? $_POST["videoLength"] : "";
$videoName = isset($_POST["videoName"]) ? $_POST["videoName"] : "";

require_once "../VideoUpload/VideoObjectController.php";
require_once "../VideoUpload/VideoUploadController.php";
require_once "../../../Models/LessonAjax.php";

$videoObjectControl = new VideoObjectController();
$videoUploadControl = new VideoUploadController();
$lessonModel = new LessonAjax();

$videoObjectId = $videoObjectControl->createObjectVideo($lessonName);

if($videoObjectId) {
    $lessonId = $lessonModel->insert($videoLength, $lessonName, $sectionId, $videoObjectId, $videoName);
    $videoId = $videoUploadControl->execUpload($fileVideo, $videoObjectId);

    $array["lesson_id"] = $lessonId;
    $array["video_id"] = $videoId;

    echo json_encode($array);
}else{
    echo "Tạo video object thất bại";
}