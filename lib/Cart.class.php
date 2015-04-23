<?php
class Cart  {
  private $_items = array();
  private $_token;
  private $_paypaltoken;
  private $_stockthreshold = 5;

  function Cart($token) {
    $this->setToken($token);
    $this->setCart();
  }

  public function addItem($id, $sku, $size) {
    $exists = false;
    $count = 0;
    foreach ($this->_items as $item) {
      if ($item['sku'] == $sku && $item['size'] == $size) {
        $query = sprintf("UPDATE cart_sessions SET quantity=quantity+1 WHERE token='%s' AND sku='%s' AND size='%s'",
          mysql_real_escape_string($this->_token),
          mysql_real_escape_string($sku),
          mysql_real_escape_string($size));
        mysql_query($query);
        $this->_items[$count]['quantity']++;
        $exists = true;
      }
      $count++;
    }
    if (!$exists) {
      $item = array();
      $query = sprintf("SELECT sku,name,description,color,price FROM cart_inventory" . DB_EXT . " WHERE id='%s' LIMIT 1",
        mysql_real_escape_string($id));
      $query = mysql_query($query);
      $row = mysql_fetch_assoc($query);
      foreach ($row as $key => $value) {
        $item[$key] = $value;
      }
      $query = sprintf("INSERT INTO cart_sessions SET token='%s', item_id='%s', size='%s', price='%s', quantity='1', timestamp='%s'",
        mysql_real_escape_string($this->_token),
        mysql_real_escape_string($id),
        mysql_real_escape_string($size),
        mysql_real_escape_string($row['price']),
        mysql_real_escape_string(time()));
      mysql_query($query);
//      $item['id'] = mysql_insert_id();
      $item['id'] = $id;
      $item['quantity'] = 1;
      $item['size'] = $size;
      array_push($this->_items, $item);
    }
    return true;
  }

  public function checkout($paypal) {
    $url = "&PAYMENTREQUEST_0_AMT=" . $this->getSubTotal();
    $url .= "&PAYMENTREQUEST_0_PAYMENTACTION=" . $paypal->getPaymentType();
    $url .= "&RETURNURL=" . PAYPAL_RETURN_URL;
    $url .= "&CANCELURL=" . PAYPAL_CANCEL_URL;
    $url .= "&PAYMENTREQUEST_0_CURRENCYCODE=". $paypal->getCurrency();
    $url .= "&SOLUTIONTYPE=Sole";
    $url .= "&LANDINGPAGE=Billing";
    return $paypal->connect($url);
  }

  public function clearCart() {
    $query = sprintf("DELETE FROM cart_sessions WHERE token='%s'",
      mysql_real_escape_string($this->_token));
    mysql_query($query);
    $this->_items = array();
    return true;
  }

  public function getCart() {
    return $this->_items;
  }

  public function getCompletedOrdersByUserId($id) {
    $orders = array();
    $query = sprintf("SELECT id,shipping_address_id,timestamp FROM cart_completed_orders WHERE user_id='%s' ORDER BY timestamp DESC",
      mysql_real_escape_string($id));
    $query = mysql_query($query);
    while ($row = mysql_fetch_assoc($query)) {
      $row['items'] = array();
      $query2 = sprintf("SELECT item_id,quantity,cart_ordered_items.size,cart_ordered_items.price,cart_inventory" . DB_EXT . ".sku,cart_inventory" . DB_EXT . ".name,cart_inventory" . DB_EXT . ".color FROM cart_ordered_items LEFT JOIN cart_inventory" . DB_EXT . " ON (cart_ordered_items.item_id = cart_inventory" . DB_EXT . ".id) WHERE order_id='%s'",
        mysql_real_escape_string($row['id']));
      $query2 = mysql_query($query2);
      while ($row2 = mysql_fetch_assoc($query2)) {
        array_push($row['items'], $row2);
      }
      array_push($orders, $row);
    }
    return $orders;
  }

  public function getCountryNameByCode($code) {
    $query = sprintf("SELECT name FROM cart_countries WHERE iso1_code='%s'",
      mysql_real_escape_string($code));
    $query = mysql_query($query);
    $row = mysql_fetch_assoc($query);
    return $row['name'];
  }

  public function getCountries() {
    $query = sprintf("SELECT iso1_code,name FROM cart_countries");
    $query = mysql_query($query);
    $countries = array();
    while ($row = mysql_fetch_assoc($query)) {
      array_push($countries, $row);
    }
    return $countries;
  }

  public function getGenderGroupList() {
    $query = sprintf("SELECT DISTINCT gender,`group` FROM cart_inventory" . DB_EXT . " WHERE active='1' GROUP BY gender,`group`");
    $query = mysql_query($query);
    $list = array();
    while ($row = mysql_fetch_assoc($query)) {
      $gender = $row['gender'];
      if(!isset($list[$gender])) {
        $list[$gender] = array();
      }
      array_push($list[$gender], $row['group']);
    }
    return $list;
  }

  public function getItemCount() {
    $count = 0;
    foreach ($this->_items as $item) {
      $count += $item['quantity'];
    }
    return $count;
  }

  public function getItemsByGender($gender) {
    $items = array();
    $query = sprintf("SELECT * FROM cart_inventory" . DB_EXT . " WHERE `gender`='%s' AND active='1'",
      mysql_real_escape_string($gender));
    $query = mysql_query($query);
    while ($row = mysql_fetch_assoc($query)) {
      array_push($items, $row);
    }
    return $items;
  }

  public function getItemsByGenderAndGroup($gender, $group) {
    $items = array();
    $query = sprintf("SELECT * FROM cart_inventory" . DB_EXT . " WHERE `gender`='%s' AND `group`='%s' AND active='1'",
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
      $totals[$item['sku'] . "-" . $item['size']] = $item['quantity'] * $item['price'];
    }
    return $totals;
  }

  public function getPayPalToken() {
    return $this->_paypaltoken;
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

  public function setCompletedOrder($user_id, $shipping_id, $response) {
    $query = sprintf("INSERT INTO cart_completed_orders SET user_id='%s', shipping_address_id='%s', fulfillment_id='%s', reference_id='%s', tracking_number='%s', status='%s', token='%s', paypal_token='%s', timestamp='%s'",
      mysql_real_escape_string($user_id),
      mysql_real_escape_string($shipping_id),
      mysql_real_escape_string($response['ID']),
      mysql_real_escape_string($response['ReferenceID']),
      mysql_real_escape_string($response['ShipmentTrackingNumber']),
      mysql_real_escape_string($response['Status']),
      mysql_real_escape_string($this->_token),
      mysql_real_escape_string($this->_paypaltoken),
      mysql_real_escape_string(time()));
    mysql_query($query);
    $orderid = mysql_insert_id();
    foreach ($this->_items as $item) {
      $query = sprintf("INSERT INTO cart_ordered_items SET order_id='%s', item_id='%s', quantity='%s', size='%s', price='%s', token='%s', paypal_token='%s'",
        mysql_real_escape_string($orderid),
        mysql_real_escape_string($item['id']),
        mysql_real_escape_string($item['quantity']),
        mysql_real_escape_string($item['size']),
        mysql_real_escape_string($item['price']),
        mysql_real_escape_string($this->_token),
        mysql_real_escape_string($this->_paypaltoken));
      mysql_query($query);
    }
    $query = sprintf("DELETE FROM cart_pending_orders WHERE user_id='%s' AND token='%s' AND paypal_token='%s'",
      mysql_real_escape_string($user_id),
      mysql_real_escape_string($this->_token),
      mysql_real_escape_string($this->_paypaltoken));
    mysql_query($query);
  }

  public function setPayPalToken($token) {
    $this->_paypaltoken = $token;
  }

  public function setPendingOrder($user_id, $shipping_id) {
    $query = sprintf("INSERT INTO cart_pending_orders SET user_id='%s', shipping_address_id='%s', token='%s', paypal_token='%s', timestamp='%s'",
      mysql_real_escape_string($user_id),
      mysql_real_escape_string($shipping_id),
      mysql_real_escape_string($this->_token),
      mysql_real_escape_string($this->_paypaltoken),
      mysql_real_escape_string(time()));
    mysql_query($query);
  }

  public function setToken($token) {
    $this->_token = $token;
  }

  public function updateQuantity($id, $quantity) {
    if ($quantity > 20) {
      $quantity = 20;
    } else if ($quantity < 1) {
      $quantity = 1;
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
