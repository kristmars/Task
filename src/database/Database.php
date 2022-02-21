<?php

declare(strict_types=1);

namespace Task\database;

use PDO;
use Task\exception\AppException;
use Task\exception\ConfigurationException;

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

    public function generateId():int
    {
        $Y = date('Y');
        $M = date('m');
        $D = date('d');
        $H = date('H');
        $i = date('i');
        $s = date('s');

        return $Id=(int)($D.$M.$Y.$H.$i.$s);

    }
}