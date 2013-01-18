<?php
class User {
  private $_isloggedin = true;
  private $_id;
  private $_email;
  private $_token;

  public function changePassword($password) {
    $query = sprintf("UPDATE cart_users SET password='%s' WHERE id='%s'",
      mysql_real_escape_string($password),
      mysql_real_escape_string($this->_id));
  }

  public function checkPassword($email, $password) {
    return true;
  }

  public function getEmail() {
    return $this->_email;
  }

  public function getToken() {
    return $this->_token;
  }

  public function isLoggedIn() {
    return $this->_isloggedin;
  }

  public function setToken($token = null) {
    if ($token) {
      $this->_token = $token;
    } else {
      $this->_token = uniqid("token_") . "_" . md5(rand(1, 999999)) . "_" . md5(microtime());
    }
  }

  public function setUserByEmail($email) {
    $this->_email = $email;
  }

  public function setUserByToken($token) {
    $this->_token = $token;
  }
}
?>
