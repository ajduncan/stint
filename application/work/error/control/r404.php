<?php

namespace Stint;

class r404Controller extends Controller {

  private $view;

  public function __construct() {
    parent::__construct();

    $this->view = new view();
    $this->view->setViewFolder(__APPL_PATH . 'work/error/view');
  }

  public function __destruct() {
    parent::__destruct();
  }

  public function index() {
    $this->view->title = "404 Not Found";
    print $this->view->render('404.phtml');
  }
}
?>
