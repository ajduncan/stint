<?php

namespace Stint;

class URI {
  public static $fragments = array();
  public static $uri;

  private static $instance = null;

  private function __clone() {}

  private function __construct() {
    self::$uri = $_SERVER['QUERY_STRING'];
    self::$fragments =  explode('/', $_SERVER['QUERY_STRING']);
  }

  public static function getInstance() {
    if (is_null(self::$instance)) {
      self::$instance = new uri;
    }

    return(self::$instance);
  }

  public function uri() {
    return(self::$uri);
  }
  public function size() {
    return(sizeof(self::$fragments));
  }

  public function fragment($key) {
    if (array_key_exists($key, self::$fragments)) {
      return(self::$fragments[$key]);
    }

    return(false);
  }
}

?>
