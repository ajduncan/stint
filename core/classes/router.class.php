<?php

namespace Stint;

class Router {

  private $path;
  private $args = array();
  private $uri;

  private static $instance = NULL;

  public $file;
  public $controller;
  public $action;
  public $parameters = array();

  final public static function getInstance() {
    if (!self::$instance instanceof self) {
      self::$instance = new self();
    }
    return(self::$instance);
  }

  private function __construct() {
  }

  public function setPath($path) {
    if (is_dir($path) == false) {
      throw new Exception ('Invalid controller path: ' . $path);
    }
    $this->path = $path;
  }

  private function CanAccessRoute() {
    $result = false;
    if (trim($this->controller)) {
      if ($this->IsValidRoute()) {
//        if (in_array($_SESSION['type'], $this->RouteAccess[$this->controller])) {
          $result = true;
//        }
      }
    }
    return($result);
  }

  private function IsValidRoute() {
    $result = false;
    if (trim($this->file)) {
      if (is_readable($this->file) == false) {
        $result = false;
      } else {
        // additional checks
        $result = true;
      }
    }
    return($result);
  }

  private function GetRoute() {
    $this->uri = URI::getInstance();

    $config = Config::getInstance();
    $route_table = $config->config_values['routes'];

    $route = 'undefined';

    while(list($key,$val) = each($route_table)) {
      if (preg_match($val, $this->uri->uri())) {
        $route = $key;
      }
    }

    switch($route) {
      case 'rx1':
        $this->controller = $this->uri->fragment(0);
        break;
      case 'rx2':
        $this->controller = $this->uri->fragment(0);
        $this->action = $this->uri->fragment(1);
        break;
      case 'rx3':
        $this->controller = $this->uri->fragment(0);
        $this->action = $this->uri->fragment(1);
        $this->parameters[] = $this->uri->fragment(2);
        break;
      case 'rx4':
        // Get from config file.
        $this->controller = 'index';
        break;
      default:
        $this->controller = $this->uri->fragment(0);
        $this->action = $this->uri->fragment(1);
        $this->parameters[] = $this->uri->fragment(2);
        break;
    }

    if (empty($this->controller)) {
      $this->controller = 'index';
    }

    if (empty($this->action)) {
      $this->action = 'index';
    }

    $this->file = $this->path . '/' . $this->controller . '/control/' . $this->controller . '.php';
  }

  public function LoadRoute() {
    $this->GetRoute();

    if (!$this->IsValidRoute()) {
      $this->file = $this->path . '/error/control/r404.php';
      $this->controller = 'r404';
    }

    if (!$this->CanAccessRoute()) {
      $this->file = $this->path . '/error/control/access.php';
      $this->controller = 'access';
    }

    include($this->file);

    $class = "Stint\\" . $this->controller . 'Controller';
    $controller = new $class();

    if (sizeof($this->parameters) > 0) {
      $controller->parameters = $this->parameters;
    }

    if (is_callable(array($controller, $this->action)) == false) {
      $action = 'index';
    } else {
      $action = $this->action;
    }
    $controller->$action();
  }
}

?>
