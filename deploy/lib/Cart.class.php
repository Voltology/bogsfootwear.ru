<?php
class Cart  {
  private $_items = array();
  private $_token;

  function Cart($token) {
    $this->setToken($token);
    $this->setCart();
  }

  public function addItem($id) {
    $item = array();
    $query = sprintf("SELECT sku,name,description,color,price FROM cart_inventory WHERE id='%s' LIMIT 1",
      mysql_real_escape_string($id));
    $query = mysql_query($query);
    $row = mysql_fetch_assoc($query);
    foreach ($row as $key => $value) {
      $item[$key] = $value;
    }
    $query = sprintf("INSERT INTO cart_sessions SET token='%s', item_id='%s', price='%s', quantity='1', timestamp='%s'",
      mysql_real_escape_string($this->_token),
      mysql_real_escape_string($id),
      mysql_real_escape_string($row['price']),
      mysql_real_escape_string(time()));
    mysql_query($query);
    $item['id'] = mysql_insert_id();
    $item['quantity'] = 1;
    array_push($this->_items, $item);
    return true;
  }

  public function clearCart() {
    $query = sprintf("DELETE FROM cart_sessions WHERE token='%s'",
      mysql_real_escape_string($this->_token));
    mysql_query($query);
    return true;
  }

  public function getCart() {
    return $this->_items;
  }

  public function getItemCount() {
    return count($this->getCart());
  }

  public function getItemsByGenderAndGroup($gender, $group) {
    $items = array();
    $query = sprintf("SELECT * FROM cart_inventory WHERE `gender`='%s' AND `group`='%s'",
      mysql_real_escape_string($gender),
      mysql_real_escape_string($group));
    $query = mysql_query($query);
    while ($row = mysql_fetch_assoc($query)) {
      array_push($items, $row);
    }
    return $items;
  }

  public function getItemTotals() {
    $totals = array();
    foreach ($this->_items as $item) {
      $totals[$item['sku']] = $item['quantity'] * $item['price'];
    }
    return $totals;
  }

  public function getSubTotal() {
    $subtotal = 0;
    foreach ($this->_items as $item) {
      $subtotal += $item['quantity'] * $item['price'];
    }
    return $subtotal;
  }

  public function removeItem($id) {
    $query = sprintf("DELETE FROM cart_sessions WHERE token='%s' AND id='%s'",
      mysql_real_escape_string($this->_token),
      mysql_real_escape_string($id));
    mysql_query($query);
    $count = 0;
    foreach ($this->_items as $item) {
      if ($item['id'] == $id) {
        array_splice($this->_items, $count, 1);
      }
      $count++;
    }
    return true;
  }

  public function setCart() {
    $query = sprintf("SELECT id,item_id,quantity FROM cart_sessions WHERE token='%s' ORDER BY timestamp ASC",
      mysql_real_escape_string($this->_token));
    $query = mysql_query($query);
    while ($row = mysql_fetch_assoc($query)) {
      $item = array();
      foreach ($row as $key => $value) {
        $item[$key] = $value;
      }
      array_push($this->_items, $item);
    }
    return true;
  }

  public function setToken($token) {
    $this->_token = $token;
  }

  public function updateQuantity($id, $quantity) {
    if ($quantity > 20) {
      $quantity = 20;
    }
    $query = sprintf("UPDATE cart_sessions SET quantity='%s' WHERE token='%s' AND id='%s'",
      mysql_real_escape_string($quantity),
      mysql_real_escape_string($this->_token),
      mysql_real_escape_string($id));
    mysql_query($query);
    $count = 0;
    foreach ($this->_items as $item) {
      if ($item['id'] == $id) {
        $this->_items[$count]['quantity'] = $quantity;
      }
      $count++;
    }
    return true;
  }
}
?>
