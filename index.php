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
        case "handleTeacherRegister":
            $registerTeacherControl->handleTeacherRegister();
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

        case "withdraw":
            $teacherController->getUserWithdraw();
            break;

        case "withDrawRequest":
            $teacherController->withDrawRequest();
            break;

        case 'profile':
            $teacherController->profile();
            break;

        case 'editProfile':
            $teacherController->editProfile();
            break;

        case 'updateProfile':
            $teacherController->updateProfile();
            break;

        case 'viewStudents':
            $teacherController->viewStudents();
            break;

        case 'viewCreateCourse':
            require_once './Controllers/Client/CreateCourseController.php';
            $createCourseControl = new CreateCourseController();
            $createCourseControl->viewCreateCourse();
            break;

        case 'createCourse':
            require_once './Controllers/Client/CreateCourseController.php';
            $createCourseControl = new CreateCourseController();
            $createCourseControl->createCourseAction();
            break;

        case 'createCategory':
            require_once "./Controllers/Client/CreateCategoryController.php";
            $createCateControl = new CreateCategoryController();
            $createCateControl->createCategory();
            break;

        case 'viewEditCourse':
            require_once 'Controllers/Client/EditCourseController.php';
            $editCourseController = new EditCourseController();
            $editCourseController->viewEditCourse();
            break;

        case 'updateCourse':
            require_once 'Controllers/Client/EditCourseController.php';
            $editCourseController = new EditCourseController();
            $editCourseController->updateCourse();
            break;

        case 'updateStatusCourse':
            require_once 'Controllers/Client/EditCourseController.php';
            $editCourseController = new EditCourseController();
            $editCourseController->updateStatusCourse();
            break;

        default:
            $teacherController->index();
            break;
    }
    require_once 'Views/Client/Layout/footer.php';
    exit;
}

if ($page == "lesson_player") {
    include_once "Views/Client/Layout/headerLessonPlayer.php";
    require_once "Controllers/Client/LessonPlayerController.php";
    $lessonController = new LessonPlayerController();
    $lessonController->viewLesson();
    require_once 'Views/Client/Layout/footer.php';
    exit;
}

if ($page != "login" && $page != "register" && $page != "forgot_password" && $page != "change_password") {
    require "./Controllers/Client/CategoryNavigationController.php";
    $categoryNavigationController = new CategoryNavigationController();
}

switch ($page) {
    case "home":
        require_once "./Controllers/Client/HomeController.php";
        $homeControl = new HomeController();
        $homeControl->viewIndex();
        break;

    case "category_product":
        require 'Controllers/Client/CourseController.php';
        $courseController = new CourseController();
        $courseController->index();
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
        switch ($action) {
            case '':
                $auth->viewLogin();
                break;
            case 'handleLogin':
                $auth->handleLogin();
                break;
            case 'googleLogin':
                $auth->handleGoogleCallback();
                break;
        }
        break;

    case "logout":
        require_once "./Controllers/Client/LogOutController.php";
        $logoutControl = new LogOutController();
        $logoutControl->handleLogOut();
        break;

    case "register":
        require_once "./Controllers/Client/RegisterController.php";
        $auth = new RegisterController();
        switch ($action) {
            case '':
                $auth->viewRegister();
                break;
            case 'handleRegister':
                $auth->handleRegister();
                break;
        }
        break;

    case "change_password":
        require_once "./Controllers/Client/AuthController.php";
        $auth = new AuthController();
        switch ($action) {
            case '':
                $auth->changePassword();
                break;
            case 'handleChangePassword':
                $auth->handleChangePassword();
                break;
        }
        break;

    case "forgot_password":
        require_once "./Controllers/Client/AuthController.php";
        $auth = new AuthController();
        switch ($action) {
            case 'index':
                $auth->forgotPassword();
                break;

            case 'handle':
                $auth->handleForgotPassword();
                break;
        }
        break;

    case "profile":
        require_once "./Controllers/Client/ProfileController.php";
        $auth = new ProfileController();
        $auth->viewProfile();
        break;

    case "profile_edit":
        require_once "./Controllers/Client/ProfileEditController.php";
        $auth = new ProfileEditController();
        switch ($action) {
            case 'updateUserProfile':
                $auth->updateUserProfile();
                break;
            default:
                $auth->viewProfileEdit();
                break;
        }
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

    case "course_learning":
        require_once "Controllers/Client/CourseLearningController.php";
        $courseLearningController = new CourseLearningController();
        $courseLearningController->viewCourseLearning();
        break;

    case "recharge":
        require_once "Controllers/Client/RechargeController.php";
        $rechargeController = new RechargeController();
        $rechargeController->viewRecharge();
        break;
    case "vnpay":
        require_once "Controllers/Client/VnPayController.php";
        $vnpayController = new VnPayController();
        switch ($action) {
            case "createPayment":
                $vnpayController->createPayment();
                break;
            case "vnpay_return":
                $vnpayController->vnpayReturn();
                break;
            case "vnpay_ipn":
                $vnpayController->vnpayIpn();
                break;
        }
        break;
        case "checkout":
        require_once "Controllers/Client/CheckoutController.php";
        $checkoutController = new CheckoutController();
        switch ($action) {
            case "viewCheckout":
                $checkoutController->viewCheckout();
                break;
            case "checkoutReturn":
                $checkoutController->checkoutReturn();
                break;
            case "success":
                $checkoutController->checkoutReturn();
                break;
            case "handleCheckout":
                $checkoutController->handleCheckout();
                break;
        }
        break;
    case "transaction":
        require_once "Controllers/Client/TransactionController.php";
        $transactionController = new TransactionController();
        switch ($action) {
            case "detail":
                $transactionController->viewTransactionDetail();
                break;
            default:
                $transactionController->viewTransaction();
                break;
        }
        break;

    default:
        require_once "./Controllers/Client/HomeController.php";
        $homeControl = new HomeController();
        $homeControl->viewIndex();
        break;
}

if ($page != "login" && $page != "register" && $page != "forgot_password" && $page != "change_password") {
    require "Views/Client/Layout/footer.php";
}
