<?php
class User {
  private $_isloggedin = true;

  function User() {
  }

  public function isLoggedIn() {
    return $this->_isloggedin;
  }
}
?>
