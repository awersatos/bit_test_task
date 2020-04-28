<?php


class Model
{
    private $conn = null;
    private $config;

    public $id;
    public $name;
    public $balance;
    private $password;

    public function __construct()
    {
        $this->config = require 'config.php';
        $this->conn = Db::getInstance()->getConnection();
    }

    public static function find($column, $value)
    {
        $sql = "SELECT * FROM users WHERE $column = '$value' LIMIT 1";
        $conn = Db::getInstance()->getConnection();
        $stmt = $conn->query($sql);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            return false;
        }

        $model = new self;
        foreach ($user as $key => $value) {
            $model->$key = $value;
        }

        return $model;
    }
}