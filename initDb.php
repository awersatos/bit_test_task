<?php

require_once 'app/Db.php';

$config = require 'app/config.php';
$salt = $config['salt'];

$conn = Db::getInstance()->getConnection();

$sql = 'CREATE TABLE IF NOT EXISTS users (
            id INT NOT NULL AUTO_INCREMENT,
            name VARCHAR (255) NOT NULL UNIQUE,
            password VARCHAR (255) NOT NULL,
            balance FLOAT,
            PRIMARY KEY ( id )
) ENGINE = InnoDB';

$conn->exec($sql);

$users = [
    ['user1', md5($salt . '12345'), 80000],
    ['user2', md5($salt . '12345'), 50000],
    ['user3', md5($salt . '12345'), 30000],
];

$sql = "INSERT INTO users (name, password, balance) VALUES (?,?,?)";
$stmt= $conn->prepare($sql);

try {
    $conn->beginTransaction();
    foreach ($users as $user) {
        $stmt->execute($user);
    }
    $conn->commit();
} catch (Exception $e){
    $conn->rollback();
    echo $e->getMessage() . PHP_EOL;
}

echo 'Success!' . PHP_EOL;
