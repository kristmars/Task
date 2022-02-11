<?php

declare(strict_types=1);

namespace Task;

require_once("src/Exception/ConfigurationException.php");
require_once("src/database/Database.php");
require_once("src/database/CategoryClass.php");
require_once("src/database/TaskClass.php");
require_once("src/View.php");

use Task\ConfigurationException;


abstract class AbstractControler
{
    protected const Default_Action  = 'lista';

    protected const Default_SubSite = 'creTask';

    protected const Default_App = 'task';
 
    private static array $configuration = [];

    protected static array $dataParams = [];
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