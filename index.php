<?php

declare(strict_types=1);

spl_autoload_register(function(string $classNamespace) 
{
  $path = $_SERVER['DOCUMENT_ROOT'];
  $name = str_replace(['\\','Task/'],['/',''],$classNamespace);
  $path = "src/$name.php";
  require_once($path);
});

//namespace Task;
require_once("src/utilis/debug.php");
$configuration = require_once("config/config.php");

use Throwable;
use Task\Request;
use Task\controler\AbstractControler;
use Task\exception\AppException;
use Task\exception\ConfigurationException;
use Task\controler\CategoryControler;
use Task\controler\TaskControler;

//require_once("src/utilis/debug.php");
//require_once("src/exception/AppException.php");
//require_once("src/controler/AbstractControler.php");
//require_once("src/controler/CategoryControler.php");
//require_once("src/controler/TaskControler.php");
//require_once("src/Request.php");



$request = new Request($_GET, $_POST);
$nameControl = $request->getParam('app','Task');

//$request = [
  //  'get' => $_GET,
    //'post' => $_POST
//];

try {
 //    Controler::initConfiguration($configuration);
   // $controler = new Controler($request);
   // $controler->run();

   AbstractControler::initConfiguration($configuration);
   if ($nameControl === 'Task') {
    (new TaskControler($request))->run();
   }elseif($nameControl==='Category'){
    
    (new CategoryControler($request))->run();
    
    }
  // (new CategoryControler($request))->run();
   
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
    dump($e);
}