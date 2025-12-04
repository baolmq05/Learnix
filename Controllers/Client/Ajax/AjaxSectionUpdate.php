<?php
$sectionId = isset($_POST["section_id"]) ? htmlspecialchars($_POST["section_id"]) : "";
$sectionName = isset($_POST["section_name"]) ? htmlspecialchars($_POST["section_name"]) : "";
$courseId = isset($_POST["course_id"]) ? htmlspecialchars($_POST["course_id"]) : "";

require_once "../../../Models/SectionAjax.php";
$sectionModel = new SectionAjax();

$updateResult = $sectionModel->update($sectionId, $sectionName);

if($updateResult) {
    echo true;
}else{
    echo false;
}