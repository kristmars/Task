<?php

declare(strict_types=1);

namespace Task;

require_once("src/AbstractControler.php");

class TaskControler extends AbstractControler
{
   public function createAction()
   {
    $this->view->render('create','creTask',self::$dataParams); 
   }
   
    public function listaAction()
    {

       $this->view->render('create','creTask',self::$dataParams);
    }

    public function creTaskAction()
    {
        //obluga bazy

        $this->view->render('create','creTask',self::$dataParams);
    }
}