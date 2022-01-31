<?php

declare(strict_types=1);

namespace Task;

use PDO;

class Database
{
    private PDO $connect;
    private int $ID;

    private string $Name;

    public function __construct(array $config)
    {
        $this->validateData($config);
        $this->connectDatabase($config);
    }

    private function connectDatabase(array $config):void
    {
        $dsn = "mysql:dbname={$config['database']};host={$config['host']}" ;
        $this->connection = new PDO(
            $dsn,
            $config['user'],
            $config['password'],
        [
            PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION
        ]);
    }

    private function validateData(array $config):void
    {
        if(
            empty($config['database'])
            || empty($config['host'])
            || empty($config['user'])
            || empty($config['password'])
        ){
            throw new ConfigurationException('Storage configuration error');
        }
    }

   /* public function getCategory():array
        {
            $query = "SELECT id,name FROM category";
            $result=$this->connection->query($query);
            //$category=$result->fetch(PDO::FETCH_ASSOC);
            $category=$result->fetchAll(PDO::FETCH_ASSOC);

            return $category;
        }
   */
}