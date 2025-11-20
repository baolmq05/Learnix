<?php

class Category
{
    private $_connect;

    private $_table = 'categories';
    public function __construct()
    {
        require_once "Database.php";
        $db = new Database();
        $this->_connect = $db->getConnect();
    }

    public function getAllCate()
    {
        $sql = "SELECT * From $this->_table ORDER BY id DESC";
        $stmt = $this->_connect->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ;
        return $result;
    }

    public function getByName($name)
    {
        $sql = "SELECT * FROM $this->_table WHERE name = :name";
        $stmt = $this->_connect->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function createCate($name, $description, $status)
    {
        try {
            $sql = "INSERT INTO $this->_table (name,description,status) VALUES (:name,:description,:status)";
            $stmt = $this->_connect->prepare($sql);
            $data = [
                'name' => $name,
                'description' => $description,
                'status' => $status,
            ];
            $result = $stmt->execute($data);
            return $result;
        } catch (Exception $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess,3,"./Logs/Category.log");
        }
    }

    public function getOne($id)
    {
        $sql = "SELECT * FROM $this->_table WHERE id = :id";
        $stmt = $this->_connect->prepare($sql);
        $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function updateCate(int $id, array $data)
    {
        try{
            $sql = "UPDATE $this->_table SET name = :name, description = :description, status = :status WHERE id = :id";
            $stmt = $this->_connect->prepare($sql);
            $data = [
                'name' => $data['name'],
                'description' => $data['description'],
                'status' => $data['status'],
                'id' => $id
            ];
            $result = $stmt->execute($data);
            return $result;
        } catch (Exception $e) {
            $error = "Lỗi:" . date("Ymd_His") . " with messageError: " . $e->getMessage() . PHP_EOL;
            file_put_contents("./Logs/Category.log", $error, FILE_APPEND);
        }
    }

    public function deleteCate($id)
    {
        try{
            $sql = "DELETE FROM $this->_table WHERE id = :id";
            $stmt = $this->_connect->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $result = $stmt->execute();
            return $result;
        } catch (Exception $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess,3,"./Logs/Category.log");
        }
    }

}
