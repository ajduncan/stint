<?php
/*
 * Bypass router with statically defined logic
 */

return array(
  'GET /' => function() {
    $view = View::build(__APPL_PATH . 'work/index/view/index.phtml', array());
    print $view->data;
  },

  'GET /methods' => function() {
  }
);

?>
