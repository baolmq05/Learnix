<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();
ob_start();

$page = isset($_GET["page"]) ? $_GET["page"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "";

if ($page != 'login') {
    include("./Views/Admin/Layout/header.php");
}

switch ($page) {
    case "":
        require 'Controllers/Admin/DashboardController.php';
        $dashboard = new DashboardController;
        $dashboard->index();
        break;

    case "category":
        require 'Controllers/Admin/CategoryController.php';
        $category = new CategoryController();
        switch ($action) {
            case "":
                $category->viewIndex();
                break;
            case "create":
                $category->create();
                break;
            case "viewCreate":
                $category->viewCreate();
                break;
            case "edit":
                $category->viewEdit();
                break;
            case "update":
                $category->update();
                break;
            case "delete":
                $category->delete();
                break;
            default:
                $category->viewIndex();
                break;
        }
        break;

    case "course":
        require 'Controllers/Admin/CourseController.php';
        $course = new CourseController();
        switch ($action) {
            case '':
                $course->viewIndex();
                break;
            case 'view':
                $course->viewCourse();
                break;
            case 'accept':
                $course->accept();
                break;
        }
        break;

    case "user":
        require "./Controllers/Admin/UserController.php";
        $user = new UserController();
        switch ($action) {
            case "":
                $user->viewIndex();
                break;

            case "create":
                $user->viewCreate();
                break;

            case "edit":
                $user->viewEdit();
                break;

            case "delete":
                break;

            default:
                $user->viewIndex();
                break;
        }
        break;

    case "comment":
        require 'Controllers/Admin/CommentController.php';
        $comment = new CommentController;
        switch ($action) {
            case 'index':
                $comment->index();
                break;
            case 'detail':
                $comment->detail();
                break;
            case 'edit':
                $comment->edit();
                break;
        }
        break;

    case "withdraw":
        require "Controllers/Admin/WithDrawController.php";
        $withDraw = new WithDrawController();
        switch ($action) {
            case "":
                $withDraw->viewIndex();
                break;

            default:
                $withDraw->viewIndex();
                break;
        }
        break;

    case "order":
        require 'Controllers/Admin/OrderController.php';
        $order = new OrderController;
        switch ($action) {
            case "":
                $order->viewIndex();
                break;
            case "view":
                $order->view();
                break;
            case "delete":
                $order->delete();
                break;

            default:
                $order->viewIndex();
                break;
        }
        break;

    case "profile":
        require 'Controllers/Admin/ProfileController.php';
        $profile = new ProfileController;
        switch ($action) {
            case "":
                $profile->viewProfile();
                break;
            default:
                $profile->viewProfile();
                break;
        }
        break;

    case "login":
        require 'Controllers/Admin/LoginController.php';
        $login = new LoginController();
        switch ($action) {
            case '':
                $login->viewLogin();
        }
        break;

    default:
        break;
}

include "Views/Admin/Layout/footer.php";
