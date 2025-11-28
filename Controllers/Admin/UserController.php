<?php
require_once 'Models/User.php';
class UserController
{
    private $_userModel;
    public function __construct()
    {
        $this->_userModel = new User();
    }

    public function viewIndex()
    {
        $users = $this->_userModel->getAllUsers();
        $students = [];
        $teachers = [];
        $admins   = [];

        foreach ($users as $user) {
            if ($user['role'] == '0') {
                $admins[] = $user;
            }

            if ($user['role'] == '1') {
                $students[] = $user;
            }

            if ($user['role'] == '2') {
                $teachers[] = $user;
            }
        }
        include "./Views/Admin/Pages/User/index.php";
    }

    public function viewCreate()
    {
        include "./Views/Admin/Pages/User/create.php";
    }

    public function store()
    {
        $activeTab = isset($_POST['active_tab']) ? $_POST['active_tab'] : 'home';
        $_SESSION['active_tab'] = $activeTab;

        if (isset($_POST['createStudent'])) {
            $name  = trim(htmlspecialchars($_POST['name']));
            $email = trim(htmlspecialchars($_POST['email']));
            $bank_name = null;
            $bank_number = null;
            $role  = '1';
            $password = '123456';
            if (empty($name)) {
                $name_student_error = "Tên học viên không được để trống";
                $errors['name_student_error'] = $name_student_error;
                header("Location: ?page=user&action=create");
            }
            if (empty($email)) {
                $email_student_error = "Email không được để trống";
                $errors['email_student_error'] = $email_student_error;
                header("Location: ?page=user&action=create");
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_student_error = "Email không đúng định dạng";
                $errors['email_student_error'] = $email_student_error;
                header("Location: ?page=user&action=create");
            } elseif (!empty($this->_userModel->getByEmail($email))) {
                $email_student_error = "Email đã tồn tại";
                $errors['email_student_error'] = $email_student_error;
                header("Location: ?page=user&action=create");
            }
            if ($errors) {
                $errors['name_student_old'] = $name;
                $errors['email_student_old'] = $email;
                $_SESSION['student_error'] = "Có lỗi xảy ra. Vui lòng kiểm tra lại dữ liệu!";
                $_SESSION['errors'] = $errors;
            } else {
                $student = $this->_userModel->createUser($name, $email, $bank_name, $bank_number, $role, $password);
                if ($student) {
                    $_SESSION['student_success'] = "Thêm học viên thành công";
                    header("Location: ?page=user");
                    exit();
                }
            }
        }

        if (isset($_POST['createTeacher'])) {
            $name      = trim(htmlspecialchars($_POST['name']));
            $email     = trim(htmlspecialchars($_POST['email']));
            $bank_name = trim(htmlspecialchars($_POST['bank_name']));
            $bank_number = trim(htmlspecialchars($_POST['bank_number']));
            $role      = '2';
            $password  = '123456';
            if (empty($name)) {
                $name_teacher_error = "Tên giảng viên không được để trống";
                $errors['name_teacher_error'] = $name_teacher_error;
                header("Location: ?page=user&action=create");
            }
            if (empty($email)) {
                $email_teacher_error = "Email không được để trống";
                $errors['email_teacher_error'] = $email_teacher_error;
                header("Location: ?page=user&action=create");
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_teacher_error = "Email không đúng định dạng";
                $errors['email_teacher_error'] = $email_teacher_error;
                header("Location: ?page=user&action=create");
            } elseif (!empty($this->_userModel->getByEmail($email))) {
                $email_teacher_error = "Email đã tồn tại";
                $errors['email_teacher_error'] = $email_teacher_error;
                header("Location: ?page=user&action=create");
            }
            if (empty($bank_name)) {
                $bank_name_teacher_error = "Tên ngân hàng không được để trống";
                $errors['bank_name_teacher_error'] = $bank_name_teacher_error;
                header("Location: ?page=user&action=create");
            }
            if (empty($bank_number)) {
                $bank_number_teacher_error = "Số tài khoản không được để trống";
                $errors['bank_number_teacher_error'] = $bank_number_teacher_error;
                header("Location: ?page=user&action=create");
            }
            if ($errors) {
                $errors['name_teacher_old'] = $name;
                $errors['email_teacher_old'] = $email;
                $_SESSION['teacher_error'] = "Có lỗi xảy ra. Vui lòng kiểm tra lại dữ liệu!";
                $_SESSION['errors'] = $errors;
            } else {
                $teacher = $this->_userModel->createUser($name, $email, $bank_name, $bank_number, $role, $password);
                if ($teacher) {
                    $_SESSION['teacher_success'] = 'Thêm giảng viên thành công';
                    header("Location: ?page=user");
                    exit();
                }
            }
        }

        if (isset($_POST['createAdmin'])) {
            $name      = trim(htmlspecialchars($_POST['name']));
            $email     = trim(htmlspecialchars($_POST['email']));
            $bank_name = null;
            $bank_number = null;
            $role = '0';
            $password  = '123456';
            if (empty($name)) {
                $name_admin_error = "Tên quản trị viên không được để trống";
                $errors['name_admin_error'] = $name_admin_error;
                header("Location: ?page=user&action=create");
            }
            if (empty($email)) {
                $email_admin_error = "Email không được để trống";
                $errors['email_admin_error'] = $email_admin_error;
                header("Location: ?page=user&action=create");
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_admin_error = "Email không đúng định dạng";
                $errors['email_admin_error'] = $email_admin_error;
                header("Location: ?page=user&action=create");
            } elseif (!empty($this->_userModel->getByEmail($email))) {
                $email_admin_error = "Email đã tồn tại";
                $errors['email_admin_error'] = $email_admin_error;
                header("Location: ?page=user&action=create");
            }
            if ($errors) {
                $errors['name_admin_old'] = $name;
                $errors['email_admin_old'] = $email;
                $_SESSION['admin_error'] = "Có lỗi xảy ra. Vui lòng kiểm tra lại dữ liệu!";
                $_SESSION['errors'] = $errors;
            } else {
                $admin = $this->_userModel->createUser($name, $email, $bank_name, $bank_number, $role, $password);
                if ($admin) {
                    $_SESSION['admin_success'] = "Thêm quản trị viên thành công";
                    header("Location: ?page=user");
                    exit();
                }
            }
        }
    }

    public function viewDetail()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $user = $this->_userModel->getById($id);
        }
        include "./Views/Admin/Pages/User/edit.php";
    }

public function update()
{
    if (isset($_POST['updateUser'])) {
        $id = $_GET['id'] ?? null;
        $user_type = $_POST['user_type'] ?? 'student';

        if ($id) {
            $status = $_POST['status'] ?? '1';
            $lock_reason = $_POST['lock_reason'] ?? '';
            $errors = [];

            if ($status == '1') {
                $lock_reason = null;
            }

            if ($status == '0' && trim($lock_reason) === '') {
                $errors['lock_reason_error'] = "Lý do khóa không được để trống khi khóa người dùng";
            }

            if (!empty($errors)) {
                $_SESSION['status_old'] = $status;
                $_SESSION['lock_reason_old'] = $lock_reason;
                $_SESSION['lock_reason_error'] = $errors['lock_reason_error'];
                $_SESSION['open_modal'] = $id; 
                $_SESSION['user_type'] = $user_type; 
                $_SESSION['user_danger'] = "Có lỗi xảy ra trong quá trình cập nhật. Vui lòng kiểm tra lại.";
                header("Location: ?page=user");
                exit();
            }
            
            $data = [
                'status' => $status,
                'lock_reason' => $lock_reason,
            ];
            $result = $this->_userModel->updateUser($id, $data);
            
            if ($result) {
                $_SESSION['user_success'] = "Cập nhật người dùng thành công";
                unset($_SESSION['status_old'], $_SESSION['lock_reason_old'], $_SESSION['lock_reason_error'], $_SESSION['open_modal'], $_SESSION['user_type']);
                header("Location: ?page=user");
                exit();
            } else {
                $_SESSION['status_old'] = $status;
                $_SESSION['lock_reason_old'] = $lock_reason;
                $_SESSION['open_modal'] = $id;
                $_SESSION['user_type'] = $user_type;
                header("Location: ?page=user");
                exit();
            }
        }
    }
    if (isset($_POST['updateUserEdit'])) {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $status = $_POST['status'] ?? '1';
            $lock_reason = $_POST['lock_reason'] ?? '';
            $errors = [];

            if ($status == '1') {
                $lock_reason = null;
            }

            if ($status == '0' && trim($lock_reason) === '') {
                $errors['lock_reason_error'] = "Lý do khóa không được để trống khi khóa người dùng";
                $_SESSION['lock_reason_error'] = $errors['lock_reason_error'];
            }

            if (!empty($errors)) {
                $_SESSION['status_old'] = $status;
                $_SESSION['lock_reason_old'] = $lock_reason;
                header("Location: ?page=user&action=edit&id=$id");
                exit();
            }
            
            $data = [
                'status' => $status,
                'lock_reason' => $lock_reason,
            ];
            $result = $this->_userModel->updateUser($id, $data);
            
            if ($result) {
                $_SESSION['user_success'] = "Cập nhật người dùng thành công";
                unset($_SESSION['status_old'], $_SESSION['lock_reason_old'], $_SESSION['lock_reason_error'], $_SESSION['open_modal'], $_SESSION['user_type']);
                header("Location: ?page=user");
                exit();
            } else {
                $_SESSION['status_old'] = $status;
                $_SESSION['lock_reason_old'] = $lock_reason;
                $_SESSION['open_modal'] = $id;
                $_SESSION['user_type'] = $user_type;
                $_SESSION['user_danger'] = "Có lỗi xảy ra trong quá trình cập nhật. Vui lòng kiểm tra lại.";
                header("Location: ?page=user&action=edit&id=$id");
                exit();
            }
        }
    }
}
}