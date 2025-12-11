<?php
// Database
define("SERVERNAME_DB", "onehost-wphn092505.000nethost.com");
define("USERNAME_DB", "nlilgdgwhosting_learnixfpoly");
define("PASSWORD_DB", "gMYyjYea(s3J}@4");
define("DB_NAME", "nlilgdgwhosting_learnixfpoly");

// Bunny
define("BUNNY_API_KEY", "095d162b-351b-4e2d-bb5241d79915-9288-4ba7");
define("BUNNY_LIBRARY_ID", "561446");


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
$expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));
// Chuyển $expire thành hằng số (hoặc tính toán trong hàm)
define("VNP_EXPIRE", $expire);
