<?php
session_start();

$history = json_decode(($_POST["history"]) ?? [], true);
$_SESSION["history_chat"] = json_encode($history, JSON_UNESCAPED_UNICODE);
echo json_encode($history, JSON_UNESCAPED_UNICODE);
?>