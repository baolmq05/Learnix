<?php
session_start();
require_once '../../../Models/Cart.php';
header("Content-Type: application/json"); // Quan trọng để AJAX hiểu JSON

$user_id = $_POST['userId'] ?? null;
$course_id = $_POST['courseId'] ?? null;

$cartModel = new Cart();
$oldCart = $cartModel->getAllCart($user_id);


if (!$user_id) {
    echo json_encode([
        "status" => "error",
        "message" => "Vui lòng đăng nhập để thêm vào giỏ hàng!"
    ]);
    exit;
}

if (empty($user_id) || !isset($course_id)) {
    echo json_encode([
        "status" => "error",
        "message" => "Dữ liệu không hợp lệ!"
    ]);
    exit;
}

if (in_array($course_id, array_column($oldCart, 'id'))) {
    echo json_encode([
        "status" => "error",
        "message" => "Khóa học đã có trong giỏ hàng!"
    ]);
    exit;
}

$newCart = $cartModel->addToCart($user_id, $course_id);

if ($newCart) {
    echo json_encode([
        "status" => "success",
        "message" => "Thêm vào giỏ hàng thành công!",
    ]);
    exit;
}

echo json_encode([
    "status" => "error",
    "message" => "Không thể thêm vào giỏ hàng!"
]);
exit;
