<?php

declare(strict_types=1);


namespace Task\controler;

use Task\exception\ConfigurationException;
use Task\database\Database;
use Task\database\CategoryClass;
use Task\database\TaskClass;
use Task\Request;
use Task\View;


abstract class AbstractControler
{
    protected const Default_Action  = 'lista';

    protected const Default_SubSite = 'creTask';

    protected const Default_App = 'task';
 
    private static array $configuration = [];

    protected static array $dataParams = [];
    
    protected Database $database;
    protected CategoryClass $databaseCategory;

    protected TaskClass $databaseTask;
    protected Request $request;
    protected View $view;

    public static function initConfiguration(array $configuration): void
    {
      self::$configuration = $configuration;
    }
  
    public function __construct(Request $request)
    {
      if (empty(self::$configuration['db'])) {
        throw new ConfigurationException('Configuration error');
      }
     // $this->database = new Database(self::$configuration['db']);
      $this->databaseCategory = new CategoryClass(self::$configuration['db']);
      $this->databaseTask = new TaskClass(self::$configuration['db']);
      $this->request = $request;
      $this->view = new View();
    }
  
    public function run(): void
    {
      $action = $this->action() . 'Action';
      

      if (!method_exists($this, $action)) {
        $action = self::Default_Action . 'Action';
        }
        $this->$action();

    }
  
    private function action(): string
    {
      return $this->request->getParam('action', self::Default_Action);
    }

}