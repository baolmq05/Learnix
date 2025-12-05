<?php
class EditCourseController
{
    private $_courseModel;
    private $_categoryModel;
    private $_sectionModel;
    private $_lessonModel;

    public function __construct()
    {
        require_once "./Models/Category.php";
        require_once "./Models/Course.php";
        require_once "./Models/Section.php";
        require_once "./Models/Lesson.php";

        $this->_categoryModel = new Category();
        $this->_courseModel = new Course();
        $this->_sectionModel = new Section();
        $this->_lessonModel = new Lesson();
    }

    public function viewEditCourse()
    {
        $courseId = isset($_POST["course_id"]) ? htmlspecialchars($_POST["course_id"]) : "";
        $categoryCurrent = isset($_POST["category"]) ? htmlspecialchars($_POST["category"]) : "";

        if (is_numeric($courseId)) {
            // SHOW INFORMATION
            $categoryList = $this->_categoryModel->getAllCate();
            $courseResult = $this->_courseModel->getCourseById($courseId);

            if (!empty($courseResult["benefit"])) {
                $benefitCurrent = $this->splitStringToArray($courseResult["benefit"]);
            }

            if (!empty($courseResult["customer_object"])) {
                $customerObjCurrent = $this->splitStringToArray($courseResult["customer_object"]);
            }

            $sectionResult = $this->_sectionModel->getByCourseId($courseId);
            $lessonResult = $this->_lessonModel->getAll();

            include 'Views/Client/Pages/Teacher/editCourse.php';
        } else {
            header("location: ?page=teacher&action=viewCreateCourse");
            exit;
        }
    }

    private function splitStringToArray($str)
    {
        $arr = explode('*', $str);
        $arr = array_map('trim', $arr);

        return $arr;
    }

    private function transferArrayToString($arr)
    {
        // Loại bỏ phần tử rỗng
        $arr = array_filter($arr, function ($item) {
            return trim($item) !== '';
        });

        return implode('*', $arr);
    }

    public function updateCourse()
    {
        $teacherId = isset($_SESSION["client"]) ? $_SESSION["client"]["id"] : "";
        $courseId = isset($_POST["course_id"]) ? htmlspecialchars($_POST["course_id"]) : "";
        $courseName = isset($_POST["course_name"]) ? htmlspecialchars($_POST["course_name"]) : "";
        $categoryId = isset($_POST["category_id"]) ? htmlspecialchars($_POST["category_id"]) : "";
        $description = isset($_POST["description"]) ? htmlspecialchars($_POST["description"]) : "";
        $benefit = isset($_POST["benefit"]) ? $_POST["benefit"] : "";
        $customerObject = isset($_POST["customer_object"]) ? $_POST["customer_object"] : "";
        $regularPrice = isset($_POST["regular_price"]) ? htmlspecialchars($_POST["regular_price"]) : "";
        $salePrice = isset($_POST["discounted_price"]) ? htmlspecialchars($_POST["discounted_price"]) : 0;
        $status = 0;

        if (is_numeric($courseId)) {
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

                $image = $_FILES['image'];

                // Validate file type
                $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
                if (!in_array($image['type'], $allowedTypes)) {
                    $_SESSION["error_file_type"] = "Vui lòng chọn đúng định dạng";
                    echo "<form id='redirectForm' method='POST' action='?page=teacher&action=viewEditCourse'>
                        <input type='hidden' name='course_id' value='$courseId'>
                    </form>
                    <script>document.getElementById('redirectForm').submit();</script>
                    ";
                    return;
                }

                // Validate extension
                $extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
                $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
                if (!in_array($extension, $allowedExt)) {
                    $_SESSION["error_file_type"] = "Vui lòng chọn đúng định dạng";
                    echo "<form id='redirectForm' method='POST' action='?page=teacher&action=viewEditCourse'>
                        <input type='hidden' name='course_id' value='$courseId'>
                    </form>
                    <script>document.getElementById('redirectForm').submit();</script>
                    ";
                    return;
                }

                // Validate size
                if ($image['size'] > 5 * 1024 * 1024) { // 5MB
                    echo "File too large!";
                    return;
                }

                // Upload
                $uploadDir = "Uploads/Courses/";
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $cleanName = preg_replace('/[^a-zA-Z0-9_-]/', '', $courseName);
                $imageName = "course_{$cleanName}_" . time() . "." . $extension;
                $uploadPath = $uploadDir . $imageName;

                if (!move_uploaded_file($image['tmp_name'], $uploadPath)) {
                    echo "Error uploading file!";
                    return;
                }
            } else {
                $imageName = $_POST["imageCurrent"];
            }

            $benefit = $this->transferArrayToString($benefit);
            $customerObject = $this->transferArrayToString($customerObject);

            if ($regularPrice <= 0 || empty($regularPrice)) {
                $regularPrice = 0;
                $salePrice = 0;
            }

            $data = [
                ":id" => $courseId,
                ":category_id" => $categoryId,
                ":course_name" => $courseName,
                ":description" => $description,
                ":benefit" => $benefit,
                ":customer_object" => $customerObject,
                ":regular_price" => $regularPrice,
                ":sale_price" => $salePrice,
                ":teacher_id" => $teacherId,
                ":image" => $imageName,
                ":status" => $status
            ];

            $result = $this->_courseModel->updateCourseById($data);
            if ($result) {
                $_SESSION["update_success"] = "Cập nhật thành công";

                echo "<form id='redirectForm' method='POST' action='?page=teacher&action=viewEditCourse'>
                        <input type='hidden' name='course_id' value='$courseId'>
                    </form>
                    <script>document.getElementById('redirectForm').submit();</script>
                    ";
                exit;
            }
        }
    }
}
