<?php

declare(strict_types=1);

namespace Task;

use DateTime;
use Throwable;

class TaskClass extends Database
{
    private int $id;

    private int $idCategory;

    private string $name;

    private string  $description;

    private DateTime $creates;

    private Database $database;

    public function __construct(array $config)
    {
        $this->datbase = new Database($config);
    }

    public function saveTask(array $dataTask):void
    {
        try{
            
         $this->id = $this->database->generateId();
         $this->idCategory = $this->database->connection->quote($dataTask['idCategory']);
         $this->name = $this->datbase->connection->quote($dataTask['name']);
         $this->description = $this->database->connection->quote($dataTask['description']);
         $this->creates = date("Y-m-d H:i:s");
         
         $query = "
         INSERT INTO task(id,id_category,name,description,creates)
         VALUES ($this->id,$this->idCategory,$this->name,$this->description,$this->creates)
         ";

        }catch(Throwable $e)
        {
            dump($e);
            exit();
        //gitthrow new AppException("Nie udalo sie zapisac danych Taksa");
        }
    }
}