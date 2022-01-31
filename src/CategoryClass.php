<?php

declare(strict_types=1);

namespace Task;

use PDO;
use Throwable;

class CategoryClass extends Database
{
    private Database $database;

    public function __construct(array $config)
    {
        $this->database=new Database($config);
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

    public function saveCategory():void
    {
        try{

        }catch(Throwable $e)
        {
            throw new AppException("Nie udalo sie dodac category");
        }
    }
}