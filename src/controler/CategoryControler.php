<?php

declare(strict_types=1);

namespace Task\controler;

use Category;
use Task\database\CategoryClass;
use Task\controler\AbstractControler;
use Task\exception\AppException;
use Throwable;

class CategoryControler extends AbstractControler
{
     
     public function creCategAction()
    {
        if (!empty($this->request->hasPost()))
        {
            try {
                $dataCategory = [
                'NameCateg'=>$this->request->postParam('Name')
                ];
                $this->databaseCategory->saveCategory($dataCategory);
              }catch(Throwable $e)
              {
                  throw new AppException("Nie udalo sie przekazac kontolerowi do zapisania danych kategorii");
              }
            
        }
        try {
            $dataParams= [
            'category'=>$this->databaseCategory->getCategory()
       ];

            $this->view->render('create', 'creCateg', $dataParams);
        }catch(Throwable $e)
        {
            throw new AppException("Nie udalo sie zaprezentowac kontrolowi danych z bazy");
        }
    } 

    public function showAction()
    {

    }

    public function listaAction()
    {
        
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
