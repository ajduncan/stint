<?php

namespace Stint;

class Config {
  public $config_values       = array();
  private static $config_file = 'config.ini.php';
  private static $instance    = null;

  private function __clone() {}

  private function __construct() {
    $this->config_values = parse_ini_file(__CORE_PATH . self::$config_file, true);

    $uri = uri::getInstance();
    $work_conf =  __APPL_PATH . '/work/' . $uri->fragment(0) . '/config/config.ini.php';
    if (file_exists($work_conf)) {
      $work_array = parse_ini_file($work_conf, true);
      $this->config_values = array_merge($this->config_values, $work_array);
    }
  }

  public static function getInstance() {
    if (is_null(self::$instance)) {
      self::$instance = new config;
    }

    return(self::$instance);
  }

  public function getValue($key) {
    return(self::$config_values[$key]);
  }
}
?>
