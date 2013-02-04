<?php
class User {
  private $_isloggedin = false;
  private $_id;
  private $_email;
  private $_firstname;
  private $_lastname;
  private $_role;
  private $_token;

  private $_orders = array();

  public function addShippingAddress($name, $addr1, $addr2, $district, $province, $postalcode, $country) {
    $query = sprintf("INSERT INTO cart_shipping_addresses SET user_id='%s', recipient='%s', address1='%s', address2='%s', district='%s', province='%s', postal_code='%s', country='%s', timestamp='%s'",
      mysql_real_escape_string($this->_id),
      mysql_real_escape_string($name),
      mysql_real_escape_string($addr1),
      mysql_real_escape_string($addr2),
      mysql_real_escape_string($district),
      mysql_real_escape_string($province),
      mysql_real_escape_string($postalcode),
      mysql_real_escape_string($country),
      mysql_real_escape_string(time()));
    $query = mysql_query($query);
    return mysql_insert_id();
  }

  public function changePassword($password) {
    $query = sprintf("UPDATE cart_users SET password='%s' WHERE id='%s'",
      mysql_real_escape_string($password),
      mysql_real_escape_string($this->_id));
  }

  public function checkPassword($email, $password) {
    $query = sprintf("SELECT id,role,email,firstname,lastname FROM cart_users WHERE email='%s' AND (password='%s' OR password_reset='%s') LIMIT 1",
      mysql_real_escape_string($email),
      mysql_real_escape_string($password),
      mysql_real_escape_string($password));
    $query = mysql_query($query);
    if (mysql_num_rows($query) > 0) {
      $row = mysql_fetch_assoc($query);
      $this->setId($row['id']);
      $this->setEmail($row['email']);
      $this->setFirstName($row['firstname']);
      $this->setLastName($row['lastname']);
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

  public function getOrders() {
    return $this->_orders;
  }

  public function getRole() {
    return $this->_role;
  }

  public function getShippingAddressById($id) {
    $query = sprintf("SELECT * FROM cart_shipping_addresses WHERE id='%s' AND user_id='%s' ORDER BY timestamp DESC LIMIT 1",
      mysql_real_escape_string($id),
      mysql_real_escape_string($this->_id));
    $query = mysql_query($query);
    return  mysql_fetch_assoc($query);
  }

  public function getShippingAddresses() {
    $addresses = array();
    $query = sprintf("SELECT * FROM cart_shipping_addresses WHERE user_id='%s' ORDER BY timestamp DESC",
      mysql_real_escape_string($this->_id));
    $query = mysql_query($query);
    while ($row = mysql_fetch_assoc($query)) {
      array_push($addresses, $row);
    }
    return $addresses;
  }

  public function getToken() {
    return $this->_token;
  }

  public function isLoggedIn() {
    return $this->_isloggedin;
  }

  public function login() {
    $this->_isloggedin = false;
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

  public function removeShippingAddress($id) {
    $query = sprintf("DELETE FROM cart_shipping_addresses WHERE user_id='%s' AND id='%s'",
      mysql_real_escape_string($this->_id),
      mysql_real_escape_string($id));
    mysql_query($query);
  }

  public function resetPassword($email) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 8; $i++) {
      $randstring .= $chars[rand(0, strlen($chars))];
    }
    $query = sprintf("UPDATE cart_users SET password_reset='%s' WHERE email='%s'",
      mysql_real_escape_string(md5($randstring)),
      mysql_real_escape_string($email));
    mysql_query($query);
    $message = "New Password: " . $randstring;
    $headers = 'From: do-not-reply@bogsfootwear.ru' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
    mail($email, "Password Reset", $message, $headers);
  }

  public function setEmail($email) {
    $this->_email = $email;
  }

  public function setFirstName($firstname) {
    $this->_firstname = $firstname;
  }

  public function setId($id) {
    $this->_id = $id;
  }

  public function setLastName($lastname) {
    $this->_lastname = $lastname;
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
