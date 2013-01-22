<?php
class User {
  private $_isloggedin = false;
  private $_id;
  private $_email;
  private $_firstname;
  private $_lastname;
  private $_token;

  public function changePassword($password) {
    $query = sprintf("UPDATE cart_users SET password='%s' WHERE id='%s'",
      mysql_real_escape_string($password),
      mysql_real_escape_string($this->_id));
  }

  public function checkPassword($email, $password) {
    $query = sprintf("SELECT id,role FROM cart_users WHERE email='%s' AND password='%s' LIMIT 1",
      mysql_real_escape_string($email),
      mysql_real_escape_string($password));
    $query = mysql_query($query);
    if (mysql_num_rows($query) > 0) {
      $row = mysql_fetch_assoc($query);
      $this->setRole($row['role']);
      $this->_isloggedin = true;
      return true;
    } else {
      $this->_isloggedin = false;
      return false;
    }
  }

  public function getEmail() {
    return $this->_email;
  }

  public function getFirstName() {
    return $this->_firstname;
  }

  public function getLastName() {
    return $this->_lastname;
  }

  public function getRole() {
    return $this->_role;
  }

  public function getToken() {
    return $this->_token;
  }

  public function isLoggedIn() {
    return $this->_isloggedin;
  }

  public function logout() {
    $this->_isloggedin = false;
  }

  public function register($email, $password, $firstname, $lastname) {
    $query = sprintf("INSERT INTO cart_users SET email='%s', password='%s', firstname='%s', lastname='%s ', role='1', lastlogin='%s', timestamp='%s', ip='%s'",
      mysql_real_escape_string($email),
      mysql_real_escape_string($password),
      mysql_real_escape_string($firstname),
      mysql_real_escape_string($lastname),
      mysql_real_escape_string(time()),
      mysql_real_escape_string(time()),
      mysql_real_escape_string($_SERVER['REMOTE_ADDR']));
    mysql_query($query);
    $this->_isloggedin = true;
  }

  public function setRole($role) {
    $this->_role = $role;
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

  public function validate($email, $password1, $password2, $firstname, $lastname) {
    $errors = array();
    $query = sprintf("SELECT id FROM cart_users WHERE email='%s' LIMIT 1",
      mysql_real_escape_string($email));
    $query = mysql_query($query);
    if ($email === "" || $password1 === "" || $firstname === "" || $lastname === "") {
      array_push($errors, "You must make sure to fill out all fields.");
    }
    if (mysql_num_rows($query) > 0) {
      array_push($errors, "That email address is already tied to another account.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      array_push($errors, "You must enter a valid email address.");
    }
    if (strlen($password1) < 6) {
      array_push($errors, "Your password must be at least 6 characters long.");
    }
    if ($password1 != $password2) {
      array_push($errors, "Your passwords do not match.");
    }
    return $errors;
  }
}
?>
