<?php
$sectionId = $_POST["section_id"];

require_once "../VideoUpload/VideoObjectController.php";
require_once "../../../Models/SectionAjax.php";
require_once "../../../Models/LessonAjax.php";

$sectionModel = new SectionAjax();
$lessonModel = new LessonAjax();

$videoObjControl = new VideoObjectController();

$lessonList = $lessonModel->getBySectionId($sectionId);

if (!empty($lessonList)) {
    foreach ($lessonList as $key => $value) {
        $resultVideoDelete = $videoObjControl->deleteVideo($value["video_id"]);
    }

    $resultDeleteLesson = $lessonModel->deleteBySectionId($sectionId);

    if ($resultDeleteLesson) {
        $resultDeleteSection = $sectionModel->deleteById($sectionId);

        if ($resultDeleteSection) {
            echo true;
        } else {
            echo false;
        }
    }
} else {
    $resultDeleteSection = $sectionModel->deleteById($sectionId);

    if ($resultDeleteSection) {
        echo true;
    } else {
        echo false;
    }
}

// $deleteVideoResult = $videoObjControl->deleteVideo($videoId);

// if($deleteVideoResult == 200) {
//     $resultModel = $lessonModel->deleteLesson($lessonId);
//     if($resultModel) {
//         echo true;
//     }
// }