<?php

namespace Stint;

// Include sub controller classes here
include_once(__APPL_PATH . "work/index/control/doc.class.php");

class indexController extends Controller {

  private $view;

  public function __construct() {
    parent::__construct();

    $this->view = new view();
    $this->view->setViewFolder(__APPL_PATH . 'work/index/view');

    // specify sub-controllers
    $this->docController          = new docController();
  }

  public function __destruct() {
    parent::__destruct();
  }

  public function index() {
    // $view = View::build(__APPL_PATH . 'work/index/view/index.phtml', $vars);
    // print $view->data;
    $this->view->title = "Main site index";
    print $this->view->render('index.phtml');
  }

}

?>
