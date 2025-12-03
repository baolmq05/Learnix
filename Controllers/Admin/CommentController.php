<?php
require_once "Models/Comment.php";

class CommentController
{
    private $_comment;
    public function __construct()
    {
        $this->_comment = new Comment();
    }
    public function index()
    {
        $comments = $this->_comment->getAllComments();
        include "Views/Admin/Pages/Comment/index.php";
    }
    public function detail($id)
    {
        $id = $_GET['id'] ?? '';
        if ($id == '') {
            header("Location: ?page=comment&action=index");
            exit();
        }
        $comment = $this->_comment->getByIdComment($id);
        include "Views/Admin/Pages/Comment/detail.php";
    }
    public function edit($id)
    {
        $id = $_GET['id'] ?? '';
        if ($id == '') {
            header("Location: ?page=comment&action=index");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'] ?? '';
            $return = $_POST['return'] ?? 'detail';
            $this->_comment->updateStatus($id, $status);
            $_SESSION['comment_success'] = "Cập nhật trạng thái bình luận thành công";
            if ($return === 'index') {
                header("Location: ?page=comment&action=index");
            } else {
                header("Location: ?page=comment&action=detail&id=$id");
            }
            exit();
        }
        include "Views/Admin/Pages/Comment/edit.php";
    }
}
?>