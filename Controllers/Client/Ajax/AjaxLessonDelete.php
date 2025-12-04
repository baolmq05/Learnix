<?php
$lessonId = $_POST["lessonId"];
$videoId = $_POST["videoId"];

require_once "../VideoUpload/VideoObjectController.php";
require_once "../../../Models/LessonAjax.php";

$lessonModel = new LessonAjax();
$videoObjControl = new VideoObjectController();

$deleteVideoResult = $videoObjControl->deleteVideo($videoId);

if($deleteVideoResult == 200) {
    $resultModel = $lessonModel->deleteById($lessonId);
    if($resultModel) {
        echo true;
    }
}