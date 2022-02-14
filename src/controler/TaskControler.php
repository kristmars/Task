<?php

declare(strict_types=1);

namespace Task;

require_once("AbstractControler.php");

class TaskControler extends AbstractControler
{
   public function createAction()
   {
    $dataParams= [
        'category'=>$this->databaseCategory->getCategory(),
        'task'=>$this->databaseTask->getTask()
     ];
    $this->view->render('create','creTask',$dataParams); 
   }
   
    public function listaAction()
    {
        $dataParams = [
            'task'=>$this->databaseTask->getTask()
        ];
       $this->view->render('create','creTask',$dataParams);
    }

    public function creTaskAction()
    {

        $dataParams= [
            'category'=>$this->databaseCategory->getCategory(),
            'task'=>$this->databaseTask->getTask()
       ];
   
        if (!empty($this->request->hasPost()))
        {
            $name = $this-> request->postParam('category');
            $nameCategory = $this->databaseCategory->getCategoryByName($name);
            $idCategory = $nameCategory['id'];

            $dataTask = [
                'idCategory' => $idCategory,
                'tytul'       => $this->request->postParam('tytul'),
                'description'=> $this->request->postParam('description'),
                'catgory' => $this->request->postParam('category'),
                'idcategory' => $this->request->postParam('id')
            ];

            $this->databaseTask->saveTask($dataTask);
        }

        $this->view->render('create','creTask',$dataParams);
    }
}