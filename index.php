<?php

namespace Task;

use Throwable;

require_once("src/utilis/debug.php");
require_once("src/Controler.php");
require_once("src/Exception/AppException.php");

$configuration = require_once("config/config.php");

$request = [
    'get' => $_GET,
    'post' => $_POST
];

try {
    Controler::initConfiguration($configuration);
    $controler = new Controler($request);
    $controler->run();
   
}catch(ConfigurationException $e){
    echo "<h1>Wystapil blad w aplikacji</h1>";
    echo "<h3> Problem z konfiguracja, prosze o kontakt z administratorem</h3>";
}
catch(AppException $e)
{
    echo "<h1>Wystapil blad w aplikacji</h1>";
    echo "<h3>". $e->getMessage()."</h3>";
}
catch(Throwable $e)
{
    echo "<h1>Wystapil blad w aplikacji</h1>";
}