<?php

namespace Stint;

class View {

  private $view_dir = null;

  public $view;
  public $variables;
  public $data;

  public function __construct() {
  }

  public function __destruct() {
  }

  public function setViewFolder($folder) {
    $view_dir = realpath($folder);
    if (is_dir($view_dir)) {
      $this->view_dir = $view_dir;
    } else {
      throw new \Exception("The view folder '$folder' does not exist.");
    }
  }

  public function __set($name, $value) {
    $this->variables[$name] = $value;
  }

  public static function build($dview, $variables = array()) {
    $view = new self();
    $view->view      = $dview;
    $view->variables = $variables;
    $view->data      = $this->render($view);

    return ($view);
  }

  public function render($view) {
    extract($this->variables);

    if (!empty($this->view_dir)) {
      $view = realpath($this->view_dir) . '/' . $view;
    }

    if (file_exists($view)) {
      ob_start();
      include($view);
      $contents = ob_get_contents();
      ob_end_clean();
    } else {
      throw new \Exception("The view: '$view' does not exist");
    }

    if (!empty($contents)) {
      return($contents);
    } else {
      return(false);
    }
  }

}

?>
