<?php

class Category
{
    private $_connect;

    public function __construct()
    {
        require_once "Database.php";
        $db = new Database();
        $this->_connect = $db->getConnect();
    }
}
