<?php
include("../Config/Global.php");

class Database
{
    private $_severname = SERVERNAME_DB; //127.0.0.1
    private $_username = USERNAME_DB; //Tên cơ sở dữ liệu
    private $_password = PASSWORD_DB; //Mật khẩu
    private $_dbname = DB_NAME; //Tên database

    private $_connect;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        try {
            $this->_connect = new PDO("mysql:host=$this->_severname;dbname=$this->_dbname", $this->_username, $this->_password);
            // set the PDO error mode to exception
            $this->_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "CONNECTED SUCCESSFULLY";
            // set the resulting array to associative
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function disconnect()
    {
        if ($this->_connect == "")
            return;
        $this->_connect = "";
    }

    public function getConnect()
    {
        return $this->_connect;
    }

    public function __destruct()
    {
        $this->disconnect();
    }
}