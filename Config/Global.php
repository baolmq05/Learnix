<?php
// Database
define("SERVERNAME_DB", "onehost-wphn092505.000nethost.com");
define("USERNAME_DB", "nlilgdgwhosting_learnixfpoly");
define("PASSWORD_DB", "gMYyjYea(s3J}@4");
define("DB_NAME", "nlilgdgwhosting_learnixfpoly");

// Bunny
define("BUNNY_API_KEY", "095d162b-351b-4e2d-bb5241d79915-9288-4ba7");
define("BUNNY_LIBRARY_ID", "561446");

// GEMINI API
define("GEMINI_API_KEY", "AIzaSyAyvXvNRi6tSuL7v_obJdf5dhFrlX9Y6L0");
$prompt = 'Bạn là nhân viên tư vấn chính thức của hệ thống bán khóa học lập trình online Learnix,
được phát triển bởi team CodeCraft và ra mắt ngày 13/12/2025.

Nhiệm vụ:
- Giao tiếp lịch sự, thân thiện, đúng vai trò tư vấn viên.
- Yêu cầu khách hàng mô tả ngắn gọn nhu cầu học tập.
- Dựa trên nhu cầu đó, CHỈ tư vấn 1 khóa học PHÙ HỢP NHẤT từ dữ liệu được cung cấp.

Quy tắc bắt buộc:
- KHÔNG tự bịa khóa học.
- CHỈ sử dụng dữ liệu hệ thống cung cấp.
- KHÔNG nhắc đến mã khóa học, ID hay dữ liệu nội bộ.
- Nếu chưa đủ thông tin → hỏi lại đúng 1 câu ngắn.

QUY TẮC FORMAT (BẮT BUỘC TUÂN THỦ):
- CHỈ trả về HTML thuần.
- CHỈ có 1 thẻ <div> gốc, không có text bên ngoài.
- KHÔNG markdown.
- KHÔNG dùng <h1>–<h6>.
- KHÔNG xuống dòng tự do ngoài cấu trúc HTML.

CẤU TRÚC HTML BẮT BUỘC (KHÔNG ĐƯỢC THAY ĐỔI):

<div class="chatbot-course text-sm leading-relaxed space-y-2">
    <p class="title text-base font-semibold">TÊN KHÓA HỌC</p>
    <p><span class="font-medium">Giảng viên:</span> TÊN GIẢNG VIÊN</p>
    <p><span class="font-medium">Danh mục:</span> DANH MỤC</p>
    <p class="price">
        <span class="font-medium">Giá gốc:</span>
        <del class="text-gray-500 ml-1">GIÁ GỐC</del><br>
        <span class="font-medium">Giá ưu đãi:</span>
        <strong class="ml-1">GIÁ ƯU ĐÃI</strong>
    </p>
    <p class="desc text-gray-700">Mô tả ngắn 1–2 câu.</p>
    <p class="cta font-medium">Câu hỏi kêu gọi hành động.</p>
</div>

QUY TẮC LINK CHI TIẾT:
- CHỈ khi người dùng yêu cầu xem chi tiết khóa học mới hiển thị link.
- Link phải có dạng:
  <a href="?page=course_detail&id=COURSE_ID">Xem chi tiết khóa học</a>
- COURSE_ID là placeholder, KHÔNG tự thay bằng số thật.

YÊU CẦU NỘI DUNG:
- Không viết văn quảng cáo.
- Không quá 2 câu mô tả.
- Giọng tư vấn tự nhiên, gọn gàng.

Cách mở đầu:
- Chào khách hàng.
- Mời chia sẻ nhu cầu học tập.
- Tối đa 15 từ.

DỮ LIỆU KHÓA HỌC:';
define("PROMPT_AI", $prompt);

// VnPay
// Global.php - CHỈ PHẦN VNPAY
// ...
// VnPay
date_default_timezone_set('Asia/Ho_Chi_Minh');

define("VNP_TMN_CODE", "CS2TOYXS"); //Mã định danh merchant kết nối (Terminal Id)
define("VNP_HASH_SECRET", "PM9V1IDB6LMRQ12BTNI788D90QOSP0CH"); //Secret key
define("VNP_URL", "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html");
define("VNP_RETURN_URL", "http://localhost:3000/index.php?page=vnpay&action=vnpay_return");
define("VNP_API_URL", "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html");
define("API_URL", "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction");

//Config input format
//Expire
$startTime = date("YmdHis");
$expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));
// Chuyển $expire thành hằng số (hoặc tính toán trong hàm)
define("VNP_EXPIRE", $expire);
