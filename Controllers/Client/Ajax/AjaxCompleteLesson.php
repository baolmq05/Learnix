<?php
session_start();
require_once '../../../Models/EnrollCourseLesson.php';
$lessonId = $_POST['lessonId'];
$enrollCourseId = $_POST['enrollCourseId'];
$enrollCourseLessonModel = new EnrollCourseLesson();

$completeResult = $enrollCourseLessonModel->updateStatusEnrollCourseLesson($enrollCourseId, $lessonId);
if ($completeResult) {
    echo json_encode([
        "status" => "success",
        "message" => "Hoàn thành bài học thành công!"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Hoàn thành bài học thất bại!"
    ]);
}