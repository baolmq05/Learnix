<?php
$sectionName = isset($_POST["section_name"]) ? htmlspecialchars($_POST["section_name"]) : "";
$courseId = isset($_POST["course_id"]) ? htmlspecialchars($_POST["course_id"]) : "";

require_once "../../../Models/SectionAjax.php";
$sectionModel = new SectionAjax();
$sectionId = $sectionModel->insert($sectionName, $courseId);

if (is_numeric($sectionId)) {
    $result = $sectionModel->getById($sectionId);
    echo json_encode($result);
} else {
    echo json_encode(["error" => true]);
}
