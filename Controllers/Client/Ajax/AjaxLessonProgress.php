<?php
$videoId = isset($_POST["videoId"]) ? htmlspecialchars($_POST["videoId"]) : "";

require_once "../VideoUpload/VideoObjectController.php";
$videoObjectControl = new VideoObjectController();
$videoObjectControl->getEncodeProgress($videoId);