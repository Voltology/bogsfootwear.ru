<?php
class Admin {
  public function addItem($data) {
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
  }
}
?>
