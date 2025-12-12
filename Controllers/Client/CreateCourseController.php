<?php
class CreateCourseController
{
    private $_categoryModel;
    private $_courseModel;

    public function __construct()
    {
        require_once "./Models/Category.php";
        require_once "./Models/Course.php";

        $this->_categoryModel = new Category();
        $this->_courseModel = new Course();
    }

    public function viewCreateCourse()
    {
        $categoryList = $this->_categoryModel->getAllCate();
        include_once 'Views/Client/Pages/Teacher/createCourse.php';
    }

    public function createCourseAction()
    {
        $btnCheck = isset($_POST["createCourseBtn"]);

        if ($btnCheck) {
            $courseName = isset($_POST["course_name"]) ? htmlspecialchars($_POST["course_name"]) : "";

            $category = isset($_POST["category"]) ? htmlspecialchars($_POST["category"]) : "";
            $userCurrent = $_SESSION["client"];

            $role = $userCurrent["role"];
            if ($role == 2) {
                $checkDuplicateName = $this->_courseModel->checkDuplicateName($courseName);
               
                // Check trùng tên khóa học
                if($checkDuplicateName == 1) {
                    $_SESSION["course_name_error"] = "Tên khóa học đã tồn tại";
                    $_SESSION["course_name_old"] = $courseName;
                    header("location: ?page=teacher&action=viewCreateCourse");
                    exit;
                }

                $teacherId = $userCurrent["id"];
                $result = $this->_courseModel->insert($category, $courseName, $teacherId);

                if (is_numeric($result)) {
                    echo "<form id='redirectForm' method='POST' action='?page=teacher&action=viewEditCourse'>
                        <input type='hidden' name='course_id' value='$result'>
                        <input type='hidden' name='category' value='$category'>
                    </form>
                    <script>document.getElementById('redirectForm').submit();</script>
                    ";
                    exit;
                } else {
                    var_dump($result);
                }
            }
        }
    }
}
