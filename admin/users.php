<?php
$userlist = Admin::getUsers();
?>
<h3>Users</h3>
<table cellpadding="2" cellspacing="0" width="100%">
  <tr>
    <td>#</td>
    <td>Email</td>
    <td>First Name</td>
    <td>Last Name</td>
    <td>Role</td>
    <td>Registration</td>
    <td align="right">Operations</td>
  </tr>
  <?php
  $count = 1;
  $bgcolor = array("#efefef", "#ffffff");
  foreach ($userlist as $userrow) {
    echo "<tr bgcolor=\"" . $bgcolor[$count % 2] . "\">";
    echo "<td>" . $count . "</td>";
    echo "<td>" . $userrow['email'] . "</td>";
    echo "<td>" . $userrow['firstname'] . "</td>";
    echo "<td>" . $userrow['lastname'] . "</td>";
    echo "<td>" . $userrow['role'] . "</td>";
    echo "<td>" . date("M j, Y, g:i a", $userrow['timestamp']) . "</td>";
    echo "<td align=\"right\"><img src=\"/img/pencil.png\" />&nbsp;&nbsp;<img src=\"/img/cross.png\" /></td>";
    echo "</tr>";
    $count++;
  }
  ?>
</table>
