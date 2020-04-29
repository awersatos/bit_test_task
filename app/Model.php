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

    public function checkPassword($password)
    {
        $salt = $this->config['salt'];
        return md5($salt . $password) == $this->password;
    }

    public function withdrawFunds($amount)
    {
        $this->conn->exec('SET SESSION TRANSACTION ISOLATION LEVEL SERIALIZABLE');
        try {
            $this->conn->beginTransaction();
            $ballData = $this->conn->query("SELECT balance FROM users WHERE id={$this->id}")
                ->fetch(PDO::FETCH_ASSOC);
            $balance = (float)$ballData['balance'];
            if ($balance < $amount) {
                throw new Exception();
            }

            $newBalance = round($balance - $amount, 2);

            $sql = "UPDATE users SET balance=:balance WHERE id={$this->id}";
            $this->conn->prepare($sql)->execute(['balance' => $newBalance]);
            $this->conn->commit();
            $this->balance = $newBalance;

            return true;

        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }

    }
}