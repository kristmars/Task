<?php

declare(strict_types=1);

namespace Task\controler;

use Task\controler\AbstractControler;
use Task\Request;
use Task\controler\TaskControler;
use Task\controler\CategoryControler;
use Task\exception\AppException;
use Throwable;

class AuthControler extends AbstractControler
{
   // private const array $dataParams = [];
    public function authAction()
    {
        $dataParams = [];
        $request = new Request($_GET, $_POST);
        $nameControl = $request->getParam('app','Task');
        $auth=false;
        $action = $request->getParam('action');


        if ($auth===false){
            if($action==='register')
            {
                $dataParams = $this->registerAction();
                $this->view->render('register','',$dataParams);
            }else if ($action==='login')
            {
                $result = $this->loginAction();
              
                if (!$result){
                 $this->view->render('noAuth','',$dataParams);
                }else {
                    $test = $_POST['auth']=true;
                    echo("WYNIK POSTA".$test);
                    if ($nameControl === 'Task') {
                        (new TaskControler($request))->run('lista');
                    } elseif ($nameControl==='Category') {
                        (new CategoryControler($request))->run('creCateg');
                    }
                }     
            }else if (!$action)
            {
                $dataParams=[
                    'auth'=>''
                ];   
                $this->view->render('noAuth','',$dataParams); 
            }

        }else if ($auth === true)
        {
            if ($nameControl === 'Task') {
                (new TaskControler($request))->run('lista');
            } elseif ($nameControl==='Category') {
                (new CategoryControler($request))->run('creCateg');
            }
        }

    }
 
    public function registerAction()
    {   
        if (!empty($this->request->hasPost()))
        {
            try {
                $dataUser = [
                'fName'=>$this->request->postParam('fname'),
                'sName'=>$this->request->postParam('sname'),
                'login'=>$this->request->postParam('login'),
                'password'=>$this->request->postParam('password'),
                'email'=>$this->request->postParam('email')
                ];
                $this->databaseUser->saveUser($dataUser);
              }catch(Throwable $e)
              {
                  throw new AppException("Nie udalo sie przekazac kontolerowi do zapisania danych uzytkownika");
              }
            
        }
        
        $dataParams = [
            'auth' => 'register'
        ];
    
        return $dataParams;
    }

    public function loginAction():bool
    {
        
       if(!empty($this->request->hasPost()))
        {
           
            try{
                $dataUser = [
                    'login' => $this->request->postParam('IuserName'),
                    'password' => $this->request->postParam('Ipassword')
                ];   
               $result = $this->databaseUser->getPassword($dataUser);
     
               return $result;

            }catch(Throwable $e)
            {
                
                throw new AppException("Nie udalo sie wyowlac metody sprawdzenia danych w bazie");
            }
        }    
    }
}