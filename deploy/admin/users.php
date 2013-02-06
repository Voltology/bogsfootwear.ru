<?php
if (!$action) {
  echo "<h3>Users</h3>";
  if ($_GET['save'] === "true") {
    if (isset($_POST['id'])) {
      echo "<div class=\"success\">Inventory item has been saved.</div>";
      Admin::updateUser($_POST['id'], $_POST);
    } else {
      echo "<div class=\"success\">Inventory item has been created.</div>";
      Admin::addUser($_POST);
    }
  }
  $userlist = Admin::getUsers();
?>
<p class="addnew"><a href="?a="><img src="/img/add.png" />&nbsp;Add New User</a></p>
<table cellpadding="4" cellspacing="0" width="100%">
  <tr class="table-header">
    <td width="28">#</td>
    <td>Email</td>
    <td>First Name</td>
    <td>Last Name</td>
    <td>Role</td>
    <td>Joined</td>
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
    echo "<a href=\"?p=users&a=edit&id=" . $userrow['id'] . "\"><img src=\"/img/pencil.png\" /></a>&nbsp;&nbsp;<img src=\"/img/cross.png\" onclick=\"admin.delete('?p=users&a=delete&id=" . $userrow['id'] . "')\" />";
    echo "</td>";
    echo "</tr>";
    $count++;
  }
  ?>
  <tr><td colspan="7" align="center"><img src="/img/excel.png" style="vertical-align: bottom;"/> <a href="export.php" target="_blank">Export This List</a></td></tr>
</table>
<?php
} else if ($action === "add" || $action === "edit") {
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
    </form>
<?
}
?>
