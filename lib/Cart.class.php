<?php
class Cart {
  private $_items = array();
  private $_token;

  function Cart() { }

  public function addItem() {
  }

  public function createToken() {
    return uniqid();
  }

  public function getToken() {
    return $token;
  }

  public function setCart() {
    return $this->_items;
  }

  public function removeItem() {
  }

  public function setCart($cart) {
  }

  public function setToken($token) {
    $this->_token = $token;
  }

  public function updateCart() {
  }
}
?>
