<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();
ob_start();

$page = isset($_GET["page"]) ? $_GET["page"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "";

if ($page != "login" && $page != "register") {
    require "Views/Client/Layout/header.php";
}

switch ($page) {
    case "home":
        require_once "./Controllers/Client/HomeController.php";
        $homeControl = new HomeController();
        $homeControl->viewIndex();
        break;

    case "categoryProduct":
        require 'Controllers/Client/CategoryProductController.php';
        $categoryProduct = new CategoryProductController();
        $categoryProduct->index();
        break;
    case "product":
        break;

    case "cart":
        require "Controllers/Client/CartController.php";
        $cartController = new CartController();
        $cartController->viewCart();
        break;

    case "notification":
        require_once './Controllers/Client/NotificationControllers.php';
        $notificationControl = new NotificationControllers();
        $notificationControl->viewNotification();
        break;

    case "login":
        require_once "./Controllers/Client/LoginController.php";
        $auth = new LoginController();
        $auth->viewLogin();
        break;

    case "register":
        require_once "./Controllers/Client/RegisterController.php";
        $auth = new RegisterController();
        $auth->viewRegister();
        break;

    case "course_detail":
        require_once "Controllers/Client/CourseDetailController.php";
        $courseController = new CourseDetailController();
        $courseController->viewCourseDetail();
        break;
    default:
        require_once "./Controllers/Client/HomeController.php";
        $homeControl = new HomeController();
        $homeControl->viewIndex();
        break;
}

if ($page != "login" && $page != "register") {
    require "Views/Client/Layout/footer.php";
}
