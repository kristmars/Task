<?php

declare(strict_types=1);

session_start();

//$username = $_POST['username'];
//$password = $_POST['password'];

//if(isValidUser($username, $password)) {

  //  Suserdetails = getUserDetails($username);

    //$_SESSION['user_id']    = Suserdetails['user_id'];
   // $_SESSION['username']    = Suserdetails['username'];
    //$_SESSION['firstname']    = Suserdetails['firstname'];

    //header('Location: dashboard.php');
//}

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
use Task\controler\AuthControler;
use Task\controler\CategoryControler;
use Task\controler\TaskControler;

$request = new Request($_GET, $_POST);
$nameControl = $request->getParam('app','Task');
dump($request);


try {
 
   AbstractControler::initConfiguration($configuration);
   //if ($nameControl === 'Task') {
   // (new TaskControler($request))->run();
   //}elseif($nameControl==='Category'){
    
    //(new CategoryControler($request))->run();
    
   // }
   (new AuthControler($request))->run('auth');
   //(new AuthControler($request))->run();

  // (new CategoryControler($request))->run();
   
}catch(ConfigurationException $e){
    dump($e);
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