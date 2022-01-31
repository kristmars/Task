<?php

namespace Task;

require_once("src/utilis/debug.php");
require_once("src/Controler.php");

$configuration = require_once("config/config.php");

$request = [
    'get' => $_GET,
    'post' => $_POST
];

Controler::initConfiguration($configuration); 
$controler = new Controler($request);
$controler->run();

