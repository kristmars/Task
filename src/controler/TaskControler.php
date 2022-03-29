<?php

declare(strict_types=1);

namespace Task\controler;

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
                'idcategory' => $this->request->postParam('id'),
                'state'=> $this->request->postParam('state')
            ];

            $this->databaseTask->saveTask($dataTask);
        }
        $dataParams= [
            'category'=>$this->databaseCategory->getCategory(),
            'task'=>$this->databaseTask->getTask()
       ];

        $this->view->render('create','creTask',$dataParams);
    }

    public function delTaskAction()
    {
        $taskId = $this->getID();
        $this->databaseTask->delTask($taskId);

        $dataParams= [
            'category'=>$this->databaseCategory->getCategory(),
            'task'=>$this->databaseTask->getTask()
       ];

       $this->view->render('create','creTask',$dataParams);
   
    }

    public function editTaskAction()
    {
       if (!empty($this->request->hasPost())) 
       {
          // $name->$this->request->;
       }
    }

    private function getID()
    {
        $dataGetTask = $this->request->getParam('id');
        return $taskId = (int) $dataGetTask;
    }
}