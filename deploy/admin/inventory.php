<?php
if (!isset($action)) {
  $sortby = $_GET['sortby'] ? $_GET['sortby'] : "last_modified";
  $dir = $_GET['dir'] == "0" ? "ASC" : "DESC";
  echo "<h3>Inventory</h3>";
  if ($_GET['save'] === "true") {
    if (isset($_POST['id'])) {
      echo "<div class=\"success\">Inventory item has been saved.</div>";
      Admin::updateItem($_POST['id'], $_POST);
    } else {
      echo "<div class=\"success\">Inventory item has been created.</div>";
      Admin::addItem($_POST);
    }
  } else if ($_GET['delete'] === "true") {
      echo "<div class=\"error\">Inventory item has been removed.</div>";
      Admin::removeItem($_GET['id']);
  }
  echo "<p class=\"addnew\"><a href=\"?p=inventory&a=add\"><img src=\"/img/add.png\" />&nbsp;Add New Item</a></p>";
  $items = Admin::getItems($sortby, $dir);
  $bgcolor = array('#efefef','#ffffff');
  echo "<table cellpadding=\"4\" cellspacing=\"0\" width=\"100%\" class=\"inventory-table\">";
  echo "<tr class=\"table-header\">";
  echo "<td width=\"24\">#</td>";
  echo "<td><a href=\"?p=inventory&sortby=name&dir=0\">Product Name (sku)</a></td>";
  echo "<td><a href=\"?p=inventory&sortby=color&dir=0\">Color</a></td>";
  echo "<td><a href=\"?p=inventory&sortby=group&dir=0\">Group</a></td>";
  echo "<td><a href=\"?p=inventory&sortby=gender&dir=0\">Gender</a></td>";
  echo "<td><a href=\"?p=inventory&sortby=price&dir=0\">Price</a></td>";
  echo "<td><a href=\"?p=inventory&sortby=active&dir=1\">Published</a></td>";
  echo "<td><a href=\"?p=inventory&sortby=last_modified&dir=1\">Last Modified</a></td>";
  echo "<td align=\"right\">Operations</td>";
  echo "</tr>";
  $count = 1;
  foreach ($items as $item) {
    echo "<tr bgcolor=\"" . $bgcolor[$count % 2] . "\">";
    echo "<td><strong>" . $count . "</strong></td>";
    echo "<td><strong>" . ucwords($item['name']) . "</strong> (" . $item['sku'] . ")</td>";
    echo "<td>" . ucwords($item['color']) . "</td>";
    echo "<td>" . ucwords($item['group']) . "</td>";
    echo "<td>" . ucwords($item['gender']) . "</td>";
    echo "<td>\$" . number_format($item['price'], 2) . "</td>";
    if ($item['active'] == 0) {
      echo "<td><span style=\"color: #CC0000;\">No</span></td>";
    } else {
      echo "<td><span style=\"color: #00BB00;\">Yes</span></td>";
    }
    echo "<td>" . date("M j, Y, g:i a", $item['last_modified']) . "</td>";
    echo "<td align=\"right\" class=\"table-operations\">";
    echo "<a href=\"?p=inventory&a=edit&id=" . $item['id'] . "\"><img src=\"/img/pencil.png\" alt=\"Edit Item\" title=\"Edit Item\" /></a>&nbsp;&nbsp;&nbsp;";
    echo "<img src=\"/img/cross.png\" alt=\"Remove Item\" title=\"Remove Item\" onclick=\"admin.delete('?p=inventory&delete=true&id=" . $item['id'] . "');\" />";
    echo "</td>";
    echo "</tr>";
    $count++;
  }
  echo "</table>";
  echo "<p class=\"addnew\"><a href=\"?p=inventory&a=add\"><img src=\"/img/add.png\" />&nbsp;Add New Item</a></p>";
} else if ($action === "add" || $action === "edit") {
  $item = Admin::getItemById($_GET['id']);
?>
  <h3>Inventory - <?php echo ucwords($action); ?> Item</h3>
  <form method="post" action="?p=inventory&save=true">
    <h4>Product Information</h4>
    <table class="editTable">
      <tr><td class="editLabel">Product Name</td><td class="editField"><input type="text" name="name" value="<?php echo $item['name']; ?>" /></td></tr>
      <tr><td class="editLabel">Sku</td><td class="editField"><input type="text" name="sku" value="<?php echo $item['sku']; ?>" /></td></tr>
      <tr><td class="editLabel">Description</td><td class="editField"><textarea name="description" value=""><?php echo $item['description']; ?></textarea></td></tr>
      <tr><td class="editLabel">Color</td><td class="editField"><input type="text" name="color" value="<?php echo $item['color']; ?>" /></td></tr>
      <tr><td class="editLabel">Group</td><td class="editField">
        <select>
          <option>Select Group</option>
          <?php
          $groups = Admin::getGroups();
          foreach ($groups as $group) {
          ?>
          <option value="<?php echo $group['id']; ?>"><?php echo ucwords($group['group']); ?></option>
          <?php
          }
          ?>
        </select>
      </td></tr>
      <tr><td class="editLabel">Gender</td><td class="editField">
        <select name="gender">
          <option value="null">Select Gender</option>
          <?php
          $genders = Admin::getGenders();
          foreach ($genders as $gender) {
          ?>
          <option value="<?php echo $gender['id']; ?>"><?php echo ucwords($gender['gender']); ?></option>
          <?php
          }
          ?>
        </select>
      </td></tr>
      <tr><td class="editLabel">Price</td><td class="editField"><input type="text" name="price" class="number_value" value="<?php echo number_format($item['price'], 2); ?>" /></td></tr>
      <tr><td class="editLabel">Image</td><td class="editField"><input type="file" name="image" value="" /></td></tr>
      <tr><td class="editLabel">Thumbnail</td><td class="editField"><input type="file" name="thumbnail" value="" /></td></tr>
      <tr><td class="editLabel">Publish</td><td class="editField"><input type="checkbox" name="active" value="1" <?php if ($item['active'] == "1") { echo "checked "; } ?>/></td></tr>
    </table>
    <!--
    <h4>Stock</h4>
    <table class="editTable">
      <?php
      for ($i = 1; $i <= 22; $i++) {
      ?>
      <tr><td class="editLabel">Size <?php echo $i; ?></td><td class="editField"><input type="text" name="size_" class="number_value" value="<?php echo $item['size_' . $i]; ?>" /></td></tr>
      <?php
      }
      ?>
    </table>
    -->
    <?php
    if (isset($_GET['id'])) { echo "<input type=\"hidden\" name=\"id\" value=\"" . $_GET['id'] . "\" />"; }
    ?>
    <input type="submit" value="Save Item" />
    <input type="button" value="Cancel" onclick="document.location='?p=inventory'"/>
  </form>
<?php
}
?>
