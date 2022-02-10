<?php

declare(strict_types=1);

namespace Task;

require_once("Exception/ConfigurationException.php");
require_once("Database.php");
require_once("CategoryClass.php");
require_once("View.php");
require_once("TaskControler.php");

use Task\ConfigurationException;
use Task\TaskControler;
use Task\CategoryControler;

abstract class AbstractControler
{
    protected const Default_Action  = 'lista';

    protected const Default_SubSite = 'creTask';

    protected const Default_App = 'task';
 
    private static array $configuration = [];

    protected static array $dataParams = [];
    protected CategoryClass $databaseCategory;
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