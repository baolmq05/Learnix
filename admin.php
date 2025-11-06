<?php
include("./Views/Admin/Layout/header.php");
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// session_start();
// ob_start();

$page = isset($_GET["page"]) ? $_GET["page"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "";

// require "Views/Client/Layout/header.php";


switch ($page) {
    case "":
        require 'Controllers/Admin/DashboardController.php';
        $dashboard = new DashboardController;
        break;

    case "category":
        require 'Controllers/Admin/CategoryController.php';
        $category = new CategoryController;
        switch ($action) {
            case "":
                $category->index();
                break;
            case "create":
                $category->create();
                break;
            case "edit":
                $category->edit();
                break;
            case "delete":
                break;
            default:
                $category->index();
                break;
        }
    case "course":
        break;

    case "user":
        break;

    case "comment":
        break;

    case "order":
        break;

    default:
        break;
}

require "Views/Admin/Layout/footer.php";