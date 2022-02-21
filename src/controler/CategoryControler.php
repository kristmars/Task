<?php

declare(strict_types=1);

namespace Task\controler;
use Task\database\CategoryClass;
use Task\controler\AbstractControler;

class CategoryControler extends AbstractControler
{
     public function creCategAction()
    {
        if (!empty($this->request->hasPost()))
        {
            $dataCategory = [
                'NameCateg'=>$this->request->postParam('Name')
                ];  
            $this->databaseCategory->saveCategory($dataCategory); 
            
        }
        $dataParams= [
            'category'=>$this->databaseCategory->getCategory()
       ];

       $this->view->render('create','creCateg',$dataParams);
    } 

    public function showAction()
    {

    }

    public function listaAction()
    {
        echo "Lista akcji";
        $dataParams= [
            'category'=>$this->databaseCategory->getCategory()
       ];

       $this->view->render('lista','',$dataParams);
    }

    public function delCategAction()
    {
        $categoryId = $this->getID();
        $this->databaseCategory->delCategory($categoryId);

        $this->view->render('create','creCateg',self::$dataParams);
        header('Location:/?action=creCateg&app=Category');
    }

    public function editCategAction()
    {
        $categoryID = $this->getID();
        $category = $this->databaseCategory->getCategoryById($categoryID);
        $dataParams = [
            'id'=>$category['id'],
            'name'=>$category['name']
        ];

        $this->view->render('create','editCateg',$dataParams);
    }

    public function editedCategoryAction()
    {
        $categoryId = $this->getID();
        if (!empty($this->request->hasPost()))
        {
            $dataCategory = [
                'Category'=>$this->request->postParam('Name'),
                'Id' => $categoryId
            ];
            $this->databaseCategory->editCategory($dataCategory);
        }
        $this->view->render('create','editCateg',self::$dataParams);
        header('Location:/?action=creCateg&app=Category');
    }

    private function getID()
    {
        $dataGetCateg = $this->request->getParam('id');
        return $categoryId = (int) $dataGetCateg;
    }
}
