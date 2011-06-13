<?php

namespace Stint;

abstract class Controller {

  public $parameters = array();

  function __construct() {
  }

  function __destruct() {
  }

  abstract function index();
}

?>
