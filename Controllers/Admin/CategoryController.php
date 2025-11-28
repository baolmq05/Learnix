<?php
require_once "Models/Category.php";

class CategoryController
{
    private $_categoryModel;

    public function __construct()
    {
        $this->_categoryModel = new Category();
    }

    public function viewIndex()
    {
        $result = $this->_categoryModel->getAllCate();
        include "Views/Admin/Pages/Category/index.php";
    }

    public function viewCreate()
    {
        include "Views/Admin/Pages/Category/create.php";
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("location: ?page=category&action=viewCreate");
            exit();
        }
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $status = $_POST['status'] ?? '';
        $error = false;
        $_SESSION['error'] = [];
        $_SESSION['old'] = [
            'name' => $name,
            'description' => $description,
            'status' => $status,
        ];

        if ($name == '') {
            $_SESSION['error']['name'] = 'Tên chủ đề không được để trống';
            $error = true;
        } else if (!empty($this->_categoryModel->getByName($name))) {
            $_SESSION['error']['name'] = 'Tên chủ đề đã tồn tại';
            $error = true;
        }

        if ($description == '') {
            $_SESSION['error']['description'] = 'Mô tả không được để trống';
            $error = true;
        }

        if ($status == '') {
            $_SESSION['error']['status'] = 'Trạng thái không được để trống';
            $error = true;
        }
        if ($error) {
            header("location: ?page=category&action=viewCreate");
            exit();
        }
        $result = $this->_categoryModel->createCate($name, $description, $status);
        if ($result) {
            unset($_SESSION['old'], $_SESSION['error']);
            $_SESSION['category_success'] = 'Thêm chủ đề thành công';
            header("location: ?page=category&action=index");
            exit();
        }
    }

    public function viewEdit()
    {
        $id = $_GET['id'] ?? '';
        if ($id == '') {
            header("location: ?page=category&action=index");
            exit();
        }
        $result = $this->_categoryModel->getOne($id);
        include "Views/Admin/Pages/Category/edit.php";
    }

    public function update()
    {
        if (!isset($_POST['update'])) {
            header("location:?page=category&action=index");
            exit();
        }

        $id = $_POST['id'] ?? '';
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $status = $_POST['status'] ?? '';
        $error = false;

        $_SESSION['error'] = [];

        if ($name == '') {
            $_SESSION['error']['name_mess'] = 'Tên chủ đề không được để trống';
            $error = true;
        } else {
            $ByName = $this->_categoryModel->getByName($name);
            if (!empty($ByName) && $ByName['id'] != $id) {
                $_SESSION['error']['name_mess'] = 'Tên chủ đề đã tồn tại';
                $error = true;
            }
        }

        if ($description == '') {
            $_SESSION['error']['description_mess'] = 'Mô tả không được để trống';
            $error = true;
        }
        if ($error) {
            header('location: ?page=category&action=edit&id=' . $id);
            exit();
        }

        $data = [
            'name' => $name,
            'description' => $description,
            'status' => $status,
        ];
        $result = $this->_categoryModel->updateCate($id, $data);

        if ($result) {
            unset($_SESSION['error']);
            $_SESSION['success'] = 'Cập nhật chủ đề thành công';
            header('location: ?page=category&action=index');
            exit();
        }
    }
    public function delete()
    {
        $id = $_GET['id'] ?? '';
        if ($id == '') {
            header("location: ?page=category&action=index");
            exit();
        }
        $result = $this->_categoryModel->deleteCate($id);
        if ($result) {
            $_SESSION['success'] = 'Xóa chủ đề thành công';
        } else {
            $_SESSION['error'] = 'Xóa chủ đề thất bại';
        }
        header('location: ?page=category&action=index');
        exit();
    }
}