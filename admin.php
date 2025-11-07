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
        $dashboard->index();
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

    case "order":
        require 'Controllers/Admin/OrderController.php';
        $order = new OrderController;
        switch ($action) {
            case "":
                $order->index();
                break;
            case "view":
                $order->view();
                break;
            case "delete":
                $order->delete();
                break;

            default:
                $order->index();
                break;
        }
        break;

    default:
        break;
}

include "Views/Admin/Layout/footer.php";
