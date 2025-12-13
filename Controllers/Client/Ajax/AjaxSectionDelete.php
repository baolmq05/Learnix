<?php
$sectionId = $_POST["section_id"];
$courseId = $_POST["course_id"];

require_once "../VideoUpload/VideoObjectController.php";
require_once "../../../Models/SectionAjax.php";
require_once "../../../Models/LessonAjax.php";
require_once "../../../Models/CourseAjax.php";
require_once "../../../Models/EnrollCourseAjax.php";
require_once "../../../Models/EnrollCourseLessonAjax.php";

$courseModel = new CourseAjax();
$sectionModel = new SectionAjax();
$lessonModel = new LessonAjax();

$enrollCourseModel = new EnrollCourseAjax();
$enrollCourseLessonModel = new EnrollCourseLessonAjax();

$videoObjControl = new VideoObjectController();

$lessonList = $lessonModel->getBySectionId($sectionId);


$enrollCourseResult = $enrollCourseModel->getAllByCourseId($courseId);

$isBought = false;

if (count($enrollCourseResult) > 0) {
    $isBought = true;
}

if (!empty($lessonList)) {
    foreach ($lessonList as $key => $value) {
        $resultVideoDelete = $videoObjControl->deleteVideo($value["video_id"]);

        // Xóa enroll_lesson_course chỗ này luôn
        if ($isBought) {
            $enrollCourseLessonModel->deleteByEnrollLessonId($value["id"]);
        }
    }

    $resultDeleteLesson = $lessonModel->deleteBySectionId($sectionId);

    if ($resultDeleteLesson) {
        $resultDeleteSection = $sectionModel->deleteById($sectionId);

        if ($resultDeleteSection) {
            $courseModel->updateTimeUpdate($courseId);

            echo true;
        } else {
            echo $resultDeleteSection;
        }
    }
} else {
    $resultDeleteSection = $sectionModel->deleteById($sectionId);

    if ($resultDeleteSection) {
        $courseModel->updateTimeUpdate($courseId);
        echo true;
    } else {
        echo false;
    }
}
