<?php

namespace Stint;

class Index {
  public function __construct() {
    $this->add_include_path(__CORE_PATH . 'classes/');

    require_once('config.class.php');
    require_once('db.class.php');
    require_once('session.class.php');
    require_once('view.class.php');
    require_once('uri.class.php');
    require_once('controller.class.php');
    require_once('router.class.php');
  }

  public function __destruct() {
  }

  public function add_include_path($path) {
    foreach (func_get_args() as $path) {
      if (!file_exists($path) or (file_exists($path) && filetype($path) !== 'dir')) {
        trigger_error("Include path: '{$path}' does not exist.", E_USER_WARNING);
        continue;
      }
      $paths = explode(PATH_SEPARATOR, get_include_path());

      if (array_search($path, $paths) === false) {
        array_push($paths, $path);
      }

      set_include_path(implode(PATH_SEPARATOR, $paths));
    }
  }

  public function Start() {
    $router = Router::getInstance();
    $router->setPath (__APPL_PATH . 'work');
    $router->LoadRoute();
  }
}

?>
