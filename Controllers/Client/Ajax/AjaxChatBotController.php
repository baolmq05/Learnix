<?php
// Lấy dữ liệu từ POST
$historyRaw = $_POST["history"] ?? [];

// Kiểm tra kiểu dữ liệu
if (is_string($historyRaw)) {
    // Nếu JS gửi string JSON
    $history = json_decode($historyRaw, true);
} elseif (is_array($historyRaw)) {
    // Nếu JS gửi trực tiếp array
    $history = $historyRaw;
} else {
    $history = [];
}

require_once "../ChatBotController.php";
$control = new ChatBotController();
$message = $control->getMessage($history);

print_r($message);
