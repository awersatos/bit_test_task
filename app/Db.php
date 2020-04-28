<?php


class Db
{
    private $conn = null;
    private static $instance;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
    }

    private function __construct()
    {
        $config = require 'config.php';
        $params = $config['db'];
        $this->conn = new PDO("mysql:host={$params['host']};dbname={$params['name']}"
            , $params['user']
            , $params['password']);
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public function getConnection()
    {
        return $this->conn;
    }
}