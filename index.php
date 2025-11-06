<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();
ob_start();

$page = isset($_GET["page"]) ? $_GET["page"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "";

require "Views/Client/Layout/header.php";

switch ($page) {
    case "home":
        break;

    case "product":
        break;

    case "cart":
        break;

    default:
        break;
}

require "Views/Client/Layout/footer.php";