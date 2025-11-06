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
        include "Views/Admin/Pages/Comment/index.php";
    }
    public function detail()
    {
        include "Views/Admin/Pages/Comment/detail.php";
    }
    public function edit()
    {
        include "Views/Admin/Pages/Comment/edit.php";
    }
}

?>
