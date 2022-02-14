<?php

namespace Task;

use Throwable;
use Task\Request;

require_once("src/utilis/debug.php");
require_once("src/Exception/AppException.php");
require_once("src/Controler/AbstractControler.php");
require_once("src/Controler/CategoryControler.php");
require_once("src/Controler/TaskControler.php");
require_once("src/Request.php");

$configuration = require_once("config/config.php");

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