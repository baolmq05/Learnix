<?php
// Trả JSON
header('Content-Type: application/json');

// Kiểm tra input
if (!isset($_GET['q']) || trim($_GET['q']) === "") {
    echo json_encode([]);
    exit;
}

$keyword = trim($_GET['q']);

// Import service kết nối DB
require_once __DIR__ . "/../../../Models/Course.php";
$courseService = new Course();

try {
    $data = $courseService->searchCoursesByName($keyword);
    echo json_encode($data);
} catch (Exception $e) {
    // nếu lỗi vẫn trả về JSON để tránh lỗi JS
    echo json_encode([]);
}

exit;
