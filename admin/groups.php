<?php
if (!$action) {
  $sortby = $_GET['sortby'] ? $_GET['sortby'] : "group";
  $dir = $_GET['dir'] == "1" ? "DESC" : "ASC";
  echo "<h3>Groups</h3>";
  if ($_GET['save'] === "true") {
    if (isset($_POST['id'])) {
      echo "<div class=\"success\" style=\"margin-left: 0px;\">Group name has been saved.</div>";
      Admin::updateGroup($_POST['id'], $_POST);
    } else {
      echo "<div class=\"success\" style=\"margin-left: 0px;\">Group has been created.</div>";
      Admin::addGroup($_POST);
    }
  } else if ($_GET['delete'] === "true") {
      if (Admin::getItemCountByGroup($_GET['group']) > 0) {
        echo "<div class=\"error\">This group cannot be deleted because some inventory items are still associated with it.</div>";
      } else {
        echo "<div class=\"error\">Group has been removed.</div>";
        //Admin::removeGroup($_GET['id']);
      }
  }
  $groups = Admin::getGroups($sortby, $dir);
?>
<p class="addnew" style="float: none;"><img src="/img/add.png" />&nbsp;<a href="?p=groups&a=add">Add New Group</a></p>
<table cellpadding="4" cellspacing="0" width="400">
  <tr class="table-header">
    <td>#</td>
    <td><a href="?p=groups&sortby=email&dir=0">Group Name</a></td>
    <td align="right">Operations</td>
  </tr>
  <?php
  $count = 1;
  $bgcolor = array("#efefef", "#ffffff");
  foreach ($groups as $group) {
    echo "<tr bgcolor=\"" . $bgcolor[$count % 2] . "\">";
    echo "<td><strong>" . $count . "</strong></td>";
    echo "<td>" . ucwords($group['group']) . "</td>";
    echo "<td align=\"right\" class=\"table-operations\">";
    echo "<a href=\"?p=groups&a=edit&id=" . $group['id'] . "\"><img src=\"/img/pencil.png\" alt=\"Edit Group\" title=\"Edit Group\" /></a>&nbsp;&nbsp;<img src=\"/img/cross.png\" onclick=\"admin.delete('?p=groups&delete=true&group=" . $group['group'] . "')\" alt=\"Remove Group\" title=\"Remove Group\" />";
    echo "</td>";
    echo "</tr>";
    $count++;
  }
  ?>
</table>
<p class="addnew"><img src="/img/add.png" />&nbsp;<a href="?p=groups&a=add">Add New Group</a></p>
<?php
} else if ($action === "add" || $action === "edit") {
  $group = Admin::getGroupById($_GET['id']);
?>
    <h3>Group - <?php echo ucwords($action); ?> Group</h3>
    <form method="post" action="?p=groups&save=true">
      <h4>Group Information</h4>
      <table class="editTable">
        <tr><td class="editLabel">Group Name</td><td class="editField"><input type="text" name="group" value="<?php echo $group['group']; ?>" /></td></tr>
      </table>
      <?php
      if (isset($_GET['id'])) {
        echo "<input type=\"hidden\" name=\"group_old\" value=\"" . $group['group'] . "\" />";
        echo "<input type=\"hidden\" name=\"id\" value=\"" . $_GET['id'] . "\" />";
      }
      ?>
      <input type="submit" value="Save Group" />
      <input type="button" value="Cancel" onclick="document.location='?p=groups'"/>
    </form>
<?
}
?>
