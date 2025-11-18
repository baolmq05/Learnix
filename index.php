<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();
ob_start();

$page = isset($_GET["page"]) ? $_GET["page"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "";

if ($page == "step") {
    require_once "./Controllers/Client/RegisterTeacherController.php";
    $registerTeacherControl = new RegisterTeacherController();
    switch ($action) {
        case "step1":
            $registerTeacherControl->viewStepRegister(1);
            break;

        case "step2":
            $registerTeacherControl->viewStepRegister(2);
            break;

        case "step3":
            $registerTeacherControl->viewStepRegister(3);
            break;

        default:
            header("location: index.php");
            break;
    }
    return;
}

if ($page == "teacher") {
    require 'Views/Client/Layout/headerTeacher.php';
    require_once 'Controllers/Client/TeacherController.php';
    $teacherController = new TeacherController();
    switch ($action) {
        case "index":
            $teacherController->index();
            break;
        case "viewDetail":
            $teacherController->viewDetail();
            break;
        case 'statistic':
            $teacherController->statistic();
            break;
        // case "createCourse":
        //     $teacherController->createCourse();
        //     break;
        // case "editCourse":
        //     $teacherController->editCourse();
        //     break;
        case 'profile':
            $teacherController->profile();
            break;
        case 'editProfile':
            $teacherController->editProfile();
            break;
        case 'viewStudents':
            $teacherController->viewStudents();
            break;
        default:
            $teacherController->index();
            break;
    }
    require_once 'Views/Client/Layout/footer.php';
    exit;
}

if ($page != "login" && $page != "register") {
    require "Views/Client/Layout/header.php";
}

switch ($page) {
    case "home":
        require_once "./Controllers/Client/HomeController.php";
        $homeControl = new HomeController();
        $homeControl->viewIndex();
        break;

    case "category_product":
        require 'Controllers/Client/CategoryProductController.php';
        $categoryProduct = new CategoryProductController();
        $categoryProduct->index();
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
    case "profile":
        require_once "./Controllers/Client/ProfileController.php";
        $auth = new ProfileController();
        $auth->viewProfile();
        break;

    case "profile_edit":
        require_once "./Controllers/Client/ProfileEditController.php";
        $auth = new ProfileEditController();
        $auth->viewProfileEdit();
        break;

    case "course_detail":
        require_once "Controllers/Client/CourseDetailController.php";
        $courseController = new CourseDetailController();
        $courseController->viewCourseDetail();
        break;

    case "about_teacher":
        require_once "Controllers/Client/AboutTeacherController.php";
        $aboutTeacherControl = new AboutTeacherController();
        $aboutTeacherControl->viewAboutTeacher();
        break;

    case "lesson_player":
        require_once "Controllers/Client/LessonPlayerController.php";
        $lessonController = new LessonPlayerController();
        $lessonController->viewLesson();
        break;

    case "course_learning":
        require_once "Controllers/Client/CourseLearningController.php";
        $courseLearningController = new CourseLearningController();
        $courseLearningController->viewCourseLearning();
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
