<?php

namespace Stint;

class DB {

  private static $instance = NULL;
  private function __construct() {}
  private function __destruct() {}
  private function __clone() {}

  final public static function getInstance() {
    if (!self::$instance) {
      $config      = config::getInstance();
      $db_type     = $config->config_values['database']['db_type'];
      $hostname    = $config->config_values['database']['db_hostname'];
      $db_name     = $config->config_values['database']['db_name'];
      $db_password = $config->config_values['database']['db_password'];
      $db_username = $config->config_values['database']['db_username'];
      $db_port     = $config->config_values['database']['db_port'];

      self::$instance = new \PDO("$db_type:host=$hostname;port=$db_port;dbname=$db_name", $db_username, $db_password);
      self::$instance-> setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    return(self::$instance);
  }


}
?>
