<?php
$action = $_GET['a'] ? $_GET['a'] : null;
if ($action == "") {
  $sortby = $_GET['sortby'] ? $_GET['sortby'] : "timestamp";
  $dir = $_GET['dir'] == "1" ? "DESC" : "ASC";
  echo "<h3>Users</h3>";
  if ($_GET['save'] === "true") {
    if (isset($_POST['id'])) {
      echo "<div class=\"success\">Inventory item has been saved.</div>";
      Admin::updateUser($_POST['id'], $_POST);
    } else {
      echo "<div class=\"success\">Inventory item has been created.</div>";
      Admin::addUser($_POST);
    }
  } else if ($_GET['delete'] === "true") {
      echo "<div class=\"error\">User has been removed.</div>";
      Admin::removeUser($_GET['id']);
  }
  $userlist = Admin::getUsers($sortby, $dir);
?>
<p class="addnew"><img src="/img/add.png" />&nbsp;<a href="?p=users&a=add">Add New User</a></p>
<p class="export"><img src="/img/excel.png" style="vertical-align: bottom;"/>&nbsp;<a href="export.php" target="_blank">Export This List</a></p>
<table cellpadding="4" cellspacing="0" width="100%">
  <tr class="table-header">
    <td width="28">#</td>
    <td><a href="?p=users&sortby=email&dir=0">Email</a></td>
    <td><a href="?p=users&sortby=firstname&dir=0">First Name</a></td>
    <td><a href="?p=users&sortby=lastname&dir=0">Last Name</a></td>
    <td><a href="?p=users&sortby=role&dir=0">Role</a></td>
    <td><a href="?p=users&sortby=timestamp&dir=1">Joined</a></td>
    <td align="right">Operations</td>
  </tr>
  <?php
  $count = 1;
  $bgcolor = array("#efefef", "#ffffff");
  foreach ($userlist as $userrow) {
    echo "<tr bgcolor=\"" . $bgcolor[$count % 2] . "\">";
    echo "<td><strong>" . $count . "</strong></td>";
    echo "<td>" . $userrow['email'] . "</td>";
    echo "<td>" . $userrow['firstname'] . "</td>";
    echo "<td>" . $userrow['lastname'] . "</td>";
    echo "<td>" . $userrow['role'] . "</td>";
    echo "<td>" . date("M j, Y, g:i a", $userrow['timestamp']) . "</td>";
    echo "<td align=\"right\" class=\"table-operations\">";
    if ($user->getId() !== $userrow['id']) {
      echo "<a href=\"?p=users&a=edit&id=" . $userrow['id'] . "\"><img src=\"/img/pencil.png\" alt=\"Edit User\" title=\"Edit User\" /></a>&nbsp;&nbsp;<img src=\"/img/cross.png\" onclick=\"admin.delete('?p=users&delete=true&id=" . $userrow['id'] . "')\" alt=\"Remove User\" title=\"Remove User\" />";
    } else {
      echo "--";
    }
    echo "</td>";
    echo "</tr>";
    $count++;
  }
  ?>
</table>
<p class="addnew"><img src="/img/add.png" />&nbsp;<a href="?p=users&a=add">Add New User</a></p>
<?php
} else if ($action == "add" || $action == "edit") {
  $data = Admin::getUserById($_GET['id']);
?>
    <h3>Users - <?php echo ucwords($action); ?> User</h3>
    <form method="post" action="?p=users&save=true">
      <h4>User Information</h4>
      <table class="editTable">
        <tr><td class="editLabel">First Name</td><td class="editField"><input type="text" name="firstname" value="<?php echo $data['firstname']; ?>" /></td></tr>
        <tr><td class="editLabel">Last Name</td><td class="editField"><input type="text" name="lastname" value="<?php echo $data['lastname']; ?>" /></td></tr>
        <tr><td class="editLabel">Email</td><td class="editField"><input type="text" name="email" value="<?php echo $data['email']; ?>" /></td></tr>
        <tr>
          <td class="editLabel">Role</td>
          <td class="editField">
            <select name="role">
              <option value="1"<?php if ($data['role'] == "Customer") { echo " selected"; } ?>>Customer</option>
              <option value="2"<?php if ($data['role'] == "Administrator") { echo " selected"; } ?>>Administrator</option>
            </select>
          </td>
        </tr>
      </table>
      <?php
      if (isset($_GET['id'])) { echo "<input type=\"hidden\" name=\"id\" value=\"" . $_GET['id'] . "\" />"; }
      ?>
      <input type="submit" value="Save User" />
      <input type="button" value="Cancel" onclick="document.location='?p=users'"/>
    </form>
<?
}
?>
