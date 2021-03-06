<?php

declare(strict_types=1);

namespace Task\database;

use PDO;
use Throwable;
use Task\exception\AppException;

class CategoryClass extends Database
{
     private Database $database;

    public function __construct(array $config)
    {   
       // $this->id = $id;
       // $this->name =$name;
        $this->database=new Database($config);
    }

   public function getCategoryByName(string $name):array
   {
       try{
        $query = "SELECT id,name FROM category WHERE name = '$name'";
        $result = $this->database->connection->query($query);
        $idCategory = $result->fetch(PDO::FETCH_ASSOC);
        
        return $idCategory;

       }catch(Throwable $e)
       {
           throw new AppException("Nie udalo sie pobrac category po nazwie");
       }
   }
   
    public function getCategoryById(int $id):array
    {
        try{
            $query = "SELECT id,name FROM category WHERE id = $id";
            $result = $this->database->connection->query($query);
            $category=$result->fetch(PDO::FETCH_ASSOC);
            return $category;

        }catch(Throwable $e)
        {
            throw new AppException("Nie udalo sie pobrac category for ID");
        }
    }
    
    public function getCategory():array
    {
        try {
            $query = "SELECT id,name FROM category";
            $result=$this->database->connection->query($query);
            $category=$result->fetchAll(PDO::FETCH_ASSOC);
            return $category;
        }catch(Throwable $e)
        {
            throw new AppException("Nie udalo sie pobrac category");
        }
    }

    public function saveCategory(array $dataCategory):void
    {
        try{
             $id = $this->database->generateId();
             $nameCateg = $this->database->connection->quote($dataCategory['NameCateg']);   
             $query = "
             INSERT INTO category(id,name)
             VALUES ($id,$nameCateg)
             ";

             $result = $this->database->connection->exec($query);

        }catch(Throwable $e)
        {
            throw new AppException("Nie udalo sie dodac category");
        }
    }

    public function delCategory(int $id):void
    {
        try{
            $query = "
            DELETE FROM category WHERE id = $id
            ";
            $result= $this->database->connection->exec($query);

        }catch(Throwable $e)
        {
            throw new AppException("Nie udalo sie usunac kategorii");
        }
    }

    public function editCategory(array $data):void
    {
        try{
            $name = $data['Category'];
            $id = $data['Id'];
            $query="
            UPDATE category SET name= '$name' where id = $id 
            ";
            $result = $this->database->connection->exec($query); 
        }catch(Throwable $e)
        {
            throw new AppException("nie udalo sie edytowac kategorii");
        }
    }

}