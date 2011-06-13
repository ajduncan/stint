<?php

namespace Stint;

class accessController extends Controller {

  private $view;

  public function __construct() {
    parent::__construct();

    $this->view = new view();
    $this->view->setTemplateDir(__APPL_PATH . 'work/error/view');
  }

  public function __destruct() {
    parent::__destruct();
  }

  public function index() {
    $this->view->title = "403 Forbidden";
    print $this->view->fetch('403.phtml');

  }
}
?>
