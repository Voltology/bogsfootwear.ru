<?php
class Admin {
  public function addItem($data) {
  }

  public function exportUsers() {
    $users = array();
    $query = sprintf("SELECT email,firstname,lastname FROM cart_users WHERE role='1'");
    $query = mysql_query($query);
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

  public function getGroups() {
    $groups = array();
    $query = sprintf("SELECT `id`,`group` FROM cart_groups ORDER BY `group` ASC");
    $query = mysql_query($query);
    while ($row = mysql_fetch_assoc($query)) {
      array_push($groups, $row);
    }
    return $groups;
  }

  public function getItemById($id) {
    $query = sprintf("SELECT * FROM cart_inventory WHERE id='%s' LIMIT 1",
      mysql_real_escape_string($id));
    $query = mysql_query($query);
    return mysql_fetch_assoc($query);
  }

  public function getUserById($id) {
    $query = sprintf("SELECT cart_users.id,email,firstname,lastname,cart_roles.role,timestamp FROM cart_users LEFT JOIN cart_roles ON (cart_users.role = cart_roles.id) WHERE cart_users.id='%s' ORDER BY email ASC",
      mysql_real_escape_string($id));
    $query = mysql_query($query);
    return mysql_fetch_assoc($query);
  }

  public function getUsers() {
    $users = array();
    $query = sprintf("SELECT cart_users.id,email,firstname,lastname,cart_roles.role,timestamp FROM cart_users LEFT JOIN cart_roles ON (cart_users.role = cart_roles.id) ORDER BY email ASC");
    $query = mysql_query($query);
    while ($row = mysql_fetch_assoc($query)) {
      array_push($users, $row);
    }
    return $users;
  }

  public function importCSV() {
  }

  public function updateItem($id, $data) {
    $query = sprintf("UPDATE cart_inventory SET name='%s', price='%s', active='%s' WHERE id='%s'",
      mysql_real_escape_string($data['name']),
      mysql_real_escape_string($data['price']),
      mysql_real_escape_string($data['active']),
      mysql_real_escape_string($id));
    mysql_query($query);
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
