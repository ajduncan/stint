<?php

namespace Stint;

class docController extends Controller {

  private $view;

  public function __construct() {
    parent::__construct();

    $this->view = new view();
    $this->view->setViewFolder(__APPL_PATH . 'work/index/view');
  }

  public function __destruct() {
    parent::__destruct();
  }

  public function index() {
  }

}

?>
