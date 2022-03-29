<?php

declare(strict_types=1);


namespace Task\controler;

use Task\exception\ConfigurationException;
use Task\database\Database;
use Task\database\CategoryClass;
use Task\database\TaskClass;
use Task\database\AuthClass;
use Task\Request;
use Task\View;
use Throwable;


abstract class AbstractControler
{
    protected const Default_Action  = 'auth';

    protected const Default_SubSite = 'creTask';

    protected const Default_App = 'task';
 
    private static array $configuration = [];

    protected static array $dataParams = [];
    
    protected Database $database;
    protected CategoryClass $databaseCategory;

    protected TaskClass $databaseTask;

    protected AuthClass $databaseUser;
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
      try {
          $this->databaseCategory = new CategoryClass(self::$configuration['db']);
          $this->databaseTask = new TaskClass(self::$configuration['db']);
          $this->databaseUser = new AuthClass(self::$configuration['db']);
          $this->request = $request;
          $this->view = new View();
      }catch(Throwable $e)
      {
        throw new ConfigurationException("Bledna konfiguracja plikow");
      }
    }
  
    public function run(string $action): void
    {
      dump($action);
      if ($action === null) {
          $action = $this->action() . 'Action';
          if (!method_exists($this, $action)) {
            $action = self::Default_Action . 'Action';
            }
      } else {
        $action= $action . 'Action';
      }
        $this->$action();
    
    }
  
    private function action(): string
    {
      return $this->request->getParam('action', self::Default_Action);
    }

}