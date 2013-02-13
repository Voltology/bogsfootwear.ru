<?php
class Admin {
  public function addGroup($data) {
    $query = sprintf("INSERT INTO cart_groups" . DB_EXT . " SET `group`='%s'",
      mysql_real_escape_string($data['group']));
    mysql_query($query);
  }

  public function addItem($data) {
    $query = sprintf("INSERT INTO cart_inventory" . DB_EXT . " SET name='%s', sku='%s', description='%s', color='%s', price='%s', gender='%s', `group`='%s', active='%s', last_modified='%s'",
      mysql_real_escape_string($data['name']),
      mysql_real_escape_string($data['sku']),
      mysql_real_escape_string($data['description']),
      mysql_real_escape_string($data['color']),
      mysql_real_escape_string($data['price']),
      mysql_real_escape_string($data['gender']),
      mysql_real_escape_string($data['group']),
      mysql_real_escape_string($data['active']),
      mysql_real_escape_string(time()));
    mysql_query($query);
  }

  public function exportUsers() {
    $users = array();
    $query = sprintf("SELECT email,firstname,lastname FROM cart_users WHERE role='1'");
    $query = mysql_query($query);
    echo "email,firstname,lastname\n";
    while ($row = mysql_fetch_assoc($query)) {
      foreach ($row as $key => $value) {
        $row[$key] = preg_replace("/\"/", "\"\"", $value);
        if (preg_match("/,/", $row[$key])) {
          $row[$key] = "\"" . $row[$key] . "\"";
        }
      }
      echo implode(",", $row) . "\n";
    }
  }

  public function getGenders() {
    $genders = array();
    $query = sprintf("SELECT `id`,`gender` FROM cart_genders ORDER BY gender ASC");
    $query = mysql_query($query);
    while ($row = mysql_fetch_assoc($query)) {
      array_push($genders, $row);
    }
    return $genders;
  }

  public function getGroups($order, $dir) {
    $groups = array();
    $query = sprintf("SELECT `id`,`group` FROM cart_groups" . DB_EXT . " ORDER BY `%s` %s",
      mysql_real_escape_string($order),
      mysql_real_escape_string($dir));
    $query = mysql_query($query);
    while ($row = mysql_fetch_assoc($query)) {
      array_push($groups, $row);
    }
    return $groups;
  }

  public function getItems($order, $dir) {
    $items = array();
    $query = sprintf("SELECT id,name,sku,color,`group`,gender,price,active,last_modified FROM cart_inventory" . DB_EXT . " ORDER BY `%s` %s",
      mysql_real_escape_string($order),
      mysql_real_escape_string($dir));
    $query = mysql_query($query);
    while ($row = mysql_fetch_array($query)) {
      array_push($items, $row);
    }
    return $items;
  }

  public function getItemCountByGroup($group) {
    $items = array();
    $query = sprintf("SELECT id FROM cart_inventory" . DB_EXT . " WHERE `group`='%s'",
      mysql_real_escape_string($group));
    $query = mysql_query($query);
    return mysql_num_rows($query);
  }

  public function getGroupById($id) {
    $query = sprintf("SELECT `id`,`group` FROM cart_groups" . DB_EXT . " WHERE id='%s' LIMIT 1",
      mysql_real_escape_string($id));
    $query = mysql_query($query);
    return mysql_fetch_assoc($query);
  }

  public function getItemById($id) {
    $query = sprintf("SELECT * FROM cart_inventory" . DB_EXT . " WHERE id='%s' LIMIT 1",
      mysql_real_escape_string($id));
    $query = mysql_query($query);
    return mysql_fetch_assoc($query);
  }

  public function getOrders($order, $dir) {
    $orders = array();
    $query = sprintf("SELECT id,user_id,timestamp FROM cart_completed_orders ORDER BY `%s` %s",
      mysql_real_escape_string($order),
      mysql_real_escape_string($dir));
    $query = mysql_query($query);
    while ($row = mysql_fetch_array($query)) {
      array_push($orders, $row);
    }
    return $orders;
  }

  public function getUserById($id) {
    $query = sprintf("SELECT cart_users.id,email,firstname,lastname,cart_roles.role,timestamp FROM cart_users LEFT JOIN cart_roles ON (cart_users.role = cart_roles.id) WHERE cart_users.id='%s' ORDER BY email ASC",
      mysql_real_escape_string($id));
    $query = mysql_query($query);
    return mysql_fetch_assoc($query);
  }

  public function getUsers($order, $dir) {
    $users = array();
    $query = sprintf("SELECT cart_users.id,email,firstname,lastname,cart_roles.role,timestamp FROM cart_users LEFT JOIN cart_roles ON (cart_users.role = cart_roles.id) ORDER BY %s %s",
      mysql_real_escape_string($order),
      mysql_real_escape_string($dir));
    $query = mysql_query($query);
    while ($row = mysql_fetch_assoc($query)) {
      array_push($users, $row);
    }
    return $users;
  }

  public function importCSV() {
  }

  public function migrate() {
    $tables = array("inventory", "genders", "groups");
    foreach ($tables as $table) {
      $query = sprintf("TRUNCATE cart_" . $table);
      mysql_query($query);
//      $query = sprintf("CREATE TABLE cart_" . $table . " LIKE cart_" . $table. "_staging");
//      mysql_query($query);
      $query = sprintf("INSERT INTO cart_" . $table . " SELECT * FROM cart_" . $table . "_staging");
      mysql_query($query);
    }
  }

  public function removeGroup($id) {
    $query = sprintf("DELETE FROM cart_groups" . DB_EXT . " WHERE id='%s'",
      mysql_real_escape_string($id));
    mysql_query($query);
  }

  public function removeItem($id) {
    $query = sprintf("SELECT sku FROM cart_inventory" . DB_EXT . " WHERE id='%s'",
      mysql_real_escape_string($id));
    $data = mysql_fetch_assoc(mysql_query($query));
    $response = Fulfillment::deleteProduct($data['sku']);
    $query = sprintf("DELETE FROM cart_inventory" . DB_EXT . " WHERE id='%s'",
      mysql_real_escape_string($id));
    mysql_query($query);
  }

  public function removeUser($id) {
    $query = sprintf("DELETE FROM cart_users WHERE id='%s'",
      mysql_real_escape_string($id));
    mysql_query($query);
  }

  public function updateItem($id, $data) {
    $query = sprintf("UPDATE cart_inventory" . DB_EXT . " SET name='%s', sku='%s', description='%s', color='%s', price='%s', gender='%s', `group`='%s', active='%s', last_modified='%s' WHERE id='%s'",
      mysql_real_escape_string($data['name']),
      mysql_real_escape_string($data['sku']),
      mysql_real_escape_string($data['description']),
      mysql_real_escape_string($data['color']),
      mysql_real_escape_string($data['price']),
      mysql_real_escape_string($data['gender']),
      mysql_real_escape_string($data['group']),
      mysql_real_escape_string($data['active']),
      mysql_real_escape_string(time()),
      mysql_real_escape_string($id));
    if ($data['active'] == 1) {
      $item = array();
      $json['SKU'] = $data['sku'];
      $json['UPC'] = $data['sku'];
      $json['Name'] = ucwords($data['name']);
      $json['Summary'] = $data['description'];
      array_push($item, $json);
      $response = json_decode(Fulfillment::createProduct(json_encode($item)), true);
      if ($response['Status'] == "1") {
        mysql_query($query);
        return true;
      } else {
        return false;
      }
    } else if ($data['active'] != 1) {
      $response = Fulfillment::deleteProduct($data['sku']);
      mysql_query($query);
      return true;
    }
  }

  public function updateGroup($id, $data) {
    $query = sprintf("UPDATE cart_groups" . DB_EXT . " SET `group`='%s' WHERE id='%s'",
      mysql_real_escape_string($data['group']),
      mysql_real_escape_string($id));
    mysql_query($query);
    if ($data['group_old']) {
      $query = sprintf("UPDATE cart_inventory" . DB_EXT . " SET `group`='%s' WHERE `group`='%s'",
        mysql_real_escape_string($data['group']),
        mysql_real_escape_string($data['group_old']));
      mysql_query($query);
    }
  }

  public function updateUser($id, $data) {
    $query = sprintf("UPDATE cart_users SET firstname='%s', lastname='%s', email='%s', role='%s' WHERE id='%s'",
      mysql_real_escape_string($data['firstname']),
      mysql_real_escape_string($data['lastname']),
      mysql_real_escape_string($data['email']),
      mysql_real_escape_string($data['role']),
      mysql_real_escape_string($id));
    mysql_query($query);
  }
}
?>
