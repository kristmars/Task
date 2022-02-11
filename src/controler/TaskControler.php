<?php

declare(strict_types=1);

namespace Task;

require_once("AbstractControler.php");

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
        $dataParams= [
            'category'=>$this->databaseCategory->getCategory()
       ];
       
        if (!empty($this->request->hasPost()))
        {
        
            $dataTask = [
                'idCategory' => $this->request->postParam('idCategory'),
                'name'       => $this->request->postParam('name'),
                'description'=> $this->request->postParam('description')
            ];

            $this->databaseTask->saveTask($dataTask);
        }

        $this->view->render('create','creTask',$dataParams);
    }
}