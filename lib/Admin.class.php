<?php
class Admin {
  public function addItem($id) {
  }

  public function getUsers() {
    $users = array();
    $query = sprintf("SELECT id,email,firstname,lastname,role,timestamp FROM cart_users ORDER BY email ASC");
    $query = mysql_query($query);
    while ($row = mysql_fetch_assoc($query)) {
      array_push($users, $row);
    }
    return $users;
  }

  public function importCSV() {
  }
}
?>
