<?php
session_start();
require_once '../../../Models/Cart.php';

header("Content-Type: application/json");

$user_id = $_SESSION['client']['id'] ?? null;

if (!$user_id) {
    echo json_encode([
        "status" => "error",
        "html" => '<div class="text-gray-500">Chưa có sản phẩm trong giỏ hàng.</div>',
        "count" => 0
    ]);
    exit;
}

$cartModel = new Cart();
$cartItems = $cartModel->getAllCart($user_id);

if (empty($cartItems)) {
    echo json_encode([
        "status" => "success",
        "html" => '<div class="text-gray-500">Chưa có sản phẩm trong giỏ hàng.</div>',
        "count" => 0
    ]);
    exit;
}

$html = '<ul class="overflow-y-auto scrollbar-hide max-h-[150px]">';
foreach ($cartItems as $item) {
    $html .= '
        <li class="flex items-center mb-3">
            <a href="?page=course_detail&id=' . $item['id'] . '" class="flex items-center flex-1">
                <img src="' . $item['image'] . '" 
                     alt="' . $item['course_name'] . '" 
                     class="w-12 h-12 rounded mr-3 object-cover">
                <div class="flex-1">
                    <p class="font-bold text-sm two-line-ellipsis me-3">' . $item['course_name'] . '</p>
                </div>
            </a>
            <div class="text-wrap">
                ' . ($item['sale_price'] != 0 ? '<div class="text-gray-800 font-medium">' . number_format($item['sale_price'], 0, ',', '.') . '₫</div>' : '') . '
                <div class="text-gray-800 font-medium ' . ($item['sale_price'] != 0 ? 'line-through text-gray-400' : '') . '">'
        . number_format($item['regular_price'], 0, ',', '.') . '₫
            </div>
        </li>
    ';
}


$html .= '</ul>';

echo json_encode([
    "status" => "success",
    "html" => $html,
    "count" => count($cartItems)
]);
