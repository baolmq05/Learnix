<?php
session_start();

// Xóa mọi output thừa gây lỗi JSON
ob_clean();

require_once '../../../Models/Cart.php';
header("Content-Type: application/json");

// Lấy user_id từ Session
$user_id = $_SESSION['client']['id'] ?? null;
$course_id = $_POST['courseId'] ?? null;

$response = [
    "status"       => "error",
    "message"      => "Vui lòng đăng nhập để xem giỏ hàng.",
    "totalPrice"   => "0₫",
    "totalNoSale"  => "0₫",
    "hasItems"     => false,
    "htmlCartItems"=> ""
];

// Nếu chưa đăng nhập → trả JSON ngay
if (!$user_id) {
    echo json_encode($response);
    exit;
}

$cartModel = new Cart();

// Nếu không có course_id → không thể xóa
if (!$course_id) {
    $response["message"] = "Không tìm thấy course_id cần xóa.";
    echo json_encode($response);
    exit;
}

// Thực hiện xóa
$deleteCart = $cartModel->deleteCartItem($user_id, $course_id);

// Nếu xóa thất bại
if (!$deleteCart) {
    $response["message"] = "Không thể xóa sản phẩm khỏi giỏ hàng.";
    echo json_encode($response);
    exit;
}

try {

    // Lấy danh sách giỏ hàng sau khi xóa
    $cartItems = $cartModel->getAllCart($user_id);

    $totalPrice  = 0;
    $totalNoSale = 0;
    $htmlCartItems = "";

    // Nếu còn sản phẩm
    if (!empty($cartItems)) {

        foreach ($cartItems as $item) {
            $price = ($item["sale_price"] != 0)
                ? $item["sale_price"]
                : $item["regular_price"];

            $totalPrice  += $price;
            $totalNoSale += $item["regular_price"];

            $modalId = "modal-" . $item["id"];

            $htmlCartItems .= '
                <div class="cart grid grid-cols-12 border-b-2 border-gray-300 pb-5 mb-3 w-full items-center" 
                     data-cart-id="'.$item["id"].'">

                    <div class="col-span-9 flex">
                        <div class="w-[45%] h-[180px] overflow-hidden rounded">
                            <img src="'.$item["image"].'" class="w-full h-full object-cover">
                        </div>

                        <div class="ml-4 w-[55%]">
                            <a href="index.php?page=course_detail&id='.$item["id"].'">
                                <p class="text-sm font-bold">'.$item["course_name"].'</p>
                            </a>

                            <p class="text-gray-700 text-sm">'.$item["instructor"].'</p>

                            <div class="flex items-center mt-1">
                                <p>'.$item["rating"].'</p>
                                <svg class="w-4 h-4 text-yellow-300 ml-1" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                            </div>

                            <ul class="grid sm:grid-cols-2 text-sm text-gray-600 list-disc py-2 ms-4">
                                <li>Tổng số '.$item["total_length"].' giờ</li>
                                <li>'.$item["total_lesson"].' bài giảng</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-span-3 flex flex-col items-end gap-2">
                        <button 
                            onclick="document.getElementById(\''.$modalId.'\').classList.remove(\'hidden\')" 
                            class="bg-red-500 text-white px-6 py-2 rounded-full hover:bg-red-600 shadow">
                            Xóa
                        </button>

                        <div class="text-right">
                            '.(
                                $item["sale_price"] != 0 
                                ? '<div class="font-bold text-xl">'.number_format($item["sale_price"], 0, ',', '.').'₫</div>
                                   <p class="line-through text-gray-500 text-sm">'.number_format($item["regular_price"], 0, ',', '.').'₫</p>'
                                : '<p class="font-bold text-xl">'.number_format($item["regular_price"], 0, ',', '.').'₫</p>'
                            ).'
                        </div>
                    </div>

                </div>
            ';
        }

        $response = [
            "status"      => "success",
            "message"     => "Đã xóa thành công.",
            "totalPrice"  => number_format($totalPrice, 0, ',', '.') . "₫",
            "totalNoSale" => number_format($totalNoSale, 0, ',', '.') . "₫",
            "hasItems"    => true,
            "htmlCartItems" => $htmlCartItems
        ];

    } else {
        $response = [
            "status"      => "success",
            "message"     => "Giỏ hàng trống.",
            "totalPrice"  => "0₫",
            "totalNoSale" => "0₫",
            "hasItems"    => false,
            "htmlCartItems" => ""
        ];
    }

} catch (Exception $e) {
    $response["status"] = "error";
    $response["message"] = "Lỗi server: " . $e->getMessage();
}

echo json_encode($response);
exit;
