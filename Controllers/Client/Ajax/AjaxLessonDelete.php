<?php
$lessonId = $_POST["lessonId"];
$videoId = $_POST["videoId"];
$courseId = $_POST["courseId"];

require_once "../VideoUpload/VideoObjectController.php";
require_once "../../../Models/LessonAjax.php";
require_once "../../../Models/CourseAjax.php";
require_once "../../../Models/EnrollCourseAjax.php";
require_once "../../../Models/EnrollCourseLessonAjax.php";

$lessonModel = new LessonAjax();
$videoObjControl = new VideoObjectController();

$courseModel = new CourseAjax();
$enrollCourseModel = new EnrollCourseAjax();
$enrollCourseLessonModel = new EnrollCourseLessonAjax();

$enrollCourseResult = $enrollCourseModel->getAllByCourseId($courseId);

$isBought = false;

if (count($enrollCourseResult) > 0) {
    $isBought = true;
}

$deleteVideoResult = $videoObjControl->deleteVideo($videoId);

if ($deleteVideoResult == 200) {
    if ($isBought) {
        foreach ($enrollCourseResult as $value) {
            $enrollCourseLessonModel->deleteByEnrollLessonId($lessonId);
        }
    }

    $resultModel = $lessonModel->deleteById($lessonId);
    if ($resultModel) {
        $courseModel->updateTimeUpdate($courseId);
        echo true;
    }
}
