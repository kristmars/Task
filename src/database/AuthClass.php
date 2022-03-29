<?php

declare(strict_types=1);

namespace Task\database;

use Task\exception\DatabaseException;
use Task\controler\AuthControler;
use Throwable;
use PDO;

class AuthClass extends Database
{
    private Database $database;

    public function __construct(array $config)
    {   
       // $this->id = $id;
       // $this->name =$name;
        $this->database=new Database($config);
    }

    public function saveUser(array $dataUser)
    {
        try{
            $id = $this->generateId();
            $fname= $this->database->connection->quote($dataUser['fName']);
            $sname = $this->database->connection->quote($dataUser['sName']);
            $login = $this->database->connection->quote($dataUser['login']);
            $password = $this->database->connection->quote($dataUser['password']);
            $hashPassword = password_hash($password,PASSWORD_BCRYPT);
            $email = $this->database->connection->quote($dataUser['email']);

         $query = "INSERT INTO user(id,firstName,secondName,login,password,email,dateFirstLogin) 
         VALUES($id,$fname,$sname,$login,'$hashPassword',$email,NULL)";

         $this->database->connection->exec($query);

        }catch(Throwable $e)
        {
    
         throw new DatabaseException("Brak mozliwosci zapisania uzytkownika");
        }
    }

    public function getPassword(array $dataUser): bool
    {
        try{
         
            $login = $this->database->connection->quote($dataUser['login']);
            $password = $this->database->connection->quote($dataUser['password']);
            $query = "SELECT password FROM user where login = $login";  
            $result = $this->database->connection->query($query);
            $passwordDB = $result->fetch(PDO::FETCH_ASSOC);   
            
            if (!$passwordDB){
                echo ("Nie ma takiego uzytkownika");
                $result = false; 
            } else
            {
            $passdb = $passwordDB['password'];
            $result = $this->verifyUser($passdb,$password);  
            }

            return $result;

           }catch(Throwable $e)
           {
               throw new DatabaseException("Nie udalo sie sprawdzi danych uzytkownika");
           }
       } 

       public function verifyUser(string $passwordDB,string $password)
       {
          try{
              $result = password_verify($password,$passwordDB);
            
              if (!$result){
               
                return $_SESSION['auth']=false;

            } else {

                return $_SESSION['auth']= true;
            }

   
           }catch(Throwable $e)
           {
               throw new DatabaseException("Nie udalo sie zweryfikowa dadnych uzytkownika");
           }
      }

}

