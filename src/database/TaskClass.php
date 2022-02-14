<?php

declare(strict_types=1);

namespace Task;

use PDO;
use DateTime;
use Throwable;

class TaskClass extends Database
{
    private int $id;

    private int $idCategory;

    private string $name;

    private string  $description;

    private DateTime $creates;

    private Database $databaseTask;

    public function __construct(array $config)
    {
        $this->databaseTask = new Database($config);
    }

    public function saveTask(array $dataTask):void
    {
        try{
            
        $id = $this->databaseTask->generateId();
        $idCategory = $this->databaseTask->connection->quote($dataTask['idCategory']);
        $name = $this->databaseTask->connection->quote($dataTask['tytul']);
        $description = $this->databaseTask->connection->quote($dataTask['description']);
        $creates = date("Y-m-d H:i:s");
         
         $query = "
         INSERT INTO task(id,id_category,name,description,creates)
         VALUES ($id,$idCategory,$name,$description,'$creates')
         ";

         $result = $this->databaseTask->connection->exec($query);

        }catch(Throwable $e)
        {
        throw new AppException("Nie udalo sie zapisac danych TasKa");
        }
    }

    public function getTask():array
    {
        
        try{
         $query = "SELECT task.id,task.id_category,task.name,task.description,task.creates,category.name as categoryName
          FROM task INNER JOIN category 
          ON task.id_category = category.id ";
         $result = $this->databaseTask->connection->query($query);
         $task = $result->fetchAll(PDO::FETCH_ASSOC);
         return $task;  

        }catch(Throwable $e)
        {
            throw new AppException("Nie udalo sie pobrac taskow");
        }
    }
}