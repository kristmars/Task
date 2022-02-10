<?php

declare(strict_types=1);

namespace Task;

use Task\View;
use Throwable;

require_once("src/View.php");
require_once("src/Controler.php");
require_once("src/Database.php");
require_once("src/CategoryClass.php");

 class Controler
{
   // private const Default_Action  = 'lista';

   // private const Default_SubSite = 'creTask';
    private static array $configuration = [];
    private array $request;

   // private Database $database;
   private CategoryClass $database;

    private View $view;

    public static function initConfiguration($configuration): void
    {
        self::$configuration=$configuration;
    }
    
    public function __construct(array $request)
    {
        try {
            $this->database=new CategoryClass(self::$configuration['db']);
            $this->view =new View();
            $this->request = $request;
        }catch(Throwable $e)
        {
            throw new AppException("Wystapil blad w tworzeniu kontrolera");
        }
    }
    public function run()
    {
        $action = $this->action();
        $dataParams= [];
        $dataPost = $this->getDataPost();

        switch($action){
            case 'create':
                $page = 'create';
                $site =  self::Default_SubSite;
                //cos sie dzieje
            break;
            case 'creCateg':
                $page = 'create';
                $site = 'creCateg';
                if(!empty($dataPost))
                {
                    $dataCategory = [
                    'NameCateg'=>$dataPost['Name']
                    ];
                  $this->database->saveCategory($dataCategory);  
                }
                $dataParams= [
                    'category'=>$this->database->getCategory()
               ];
                break;
            case 'creTask':
                $page = 'create';
                $site = 'creTask';
                break;    
            case 'delCateg':
                $categoryId = $this->getId();
                $page = 'create';
                $site = 'creCateg';
                $this->database->delCategory($categoryId);   
                header('Location:/?action=creCateg');
            case 'editCateg':
                $page = 'create';
                $site = 'editCateg';
                $categoryId = $this->getId();
                $category = $this->database->getCategoryById($categoryId);
                $dataParams = [
                    'id'=>$category['id'],
                    'name' => $category['name']
                ];
               // header('Location:/?action=creCateg');
                break;
            case 'editedCategory':
                $categoryId = $this->getId();
                dump($categoryId);
                $page = 'create';
                $site = 'editCateg';
                if(!empty($dataPost))
                {
                    $dataCategory = [
                    'Category'=>$dataPost['Name'] ,
                    'Id'=>$categoryId 
                    ];
                  $this->database->editCategory($dataCategory);  
                }
               header('Location:/?action=creCateg');
                break;    
            default:
                $page = 'lista';
                $site = '';
             //cos sie dzieje
             break;    
        }
        $this->view->render($page,$site,$dataParams);
    }

    private function getId():int
    {
        $dataGetCateg = $this->getDataGet();
        return $categoryId = (int) $dataGetCateg['id'];

    }
    private function action():string
    {
        $dataGet = $this->getDataGet();
        return $dataGet['action'] ?? self::Default_Action;
    }
    private function getDataGet():array
    {
       return  $this->request['get'] ?? NULL;
    }

    private function getDataPost():array
    {
        return $this->request['post'] ?? NULL;
    }

}