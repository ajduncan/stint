<?php

namespace Stint;

class Session {

  public function __construct() {
    // Re-establish session
    if (!session_id()) {
      session_cache_expire(1);
      session_name(APPLICATION_NAME);
      session_cache_limiter("must-revalidate");
      session_start();
      // todo, set from config
      $integerLifeTime    = (60 * 300);
      $integerTimeNow     = time();
      if (
        (!empty($_SESSION['last_access'])) &&
        ($_SESSION['last_access'] >= ($integerTimeNow + $integerLifeTime))
      )  {
      } else {
        $_SESSION['last_access'] = time();
      }
    }

    // todo, set from config
    $_SESSION['type'] = 'anyone';

  }

  public function __destruct() {
  }
}
?>
