<?php
class Admin {
  public function addItem() {
  }

  public function getUsers() {
    $users = array();
    $query = sprintf("SELECT id,email,firstname,lastname,timestamp FROM cart_users ORDER BY email ASC");
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
