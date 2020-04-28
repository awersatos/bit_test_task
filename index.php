<?php

spl_autoload_register(function ($class) {
    require_once 'app/' . $class . '.php';
});

$config = require 'app/config.php';

$controller = new Controller($config);
$controller->run();
