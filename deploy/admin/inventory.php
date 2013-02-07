<?php
if ($subpage === "upload") {
    echo "<h3>Inventory - Upload CSV</h3>";
    if ($_GET['a'] == "approve") {
        $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
//                                if (in_array($_FILES['csv']['type'], $mimes) && $_FILES['csv']['size'] < 20000) {
            if ($_FILES['csv']['error'] > 0) {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
            } else {
                $location = "uploads/" . md5(microtime() . rand(0, 99999)) . ".csv";
                move_uploaded_file($_FILES['csv']['tmp_name'], $location);
                $file_array = array();
                $fields = array(
                  'name' => 1,
                  'color' => 3,
                  'gender' => 4,
                  'group' => 5,
                  'size_1' => 9,
                  'size_2' => 10,
                  'size_3' => 11,
                  'size_4' => 12,
                  'size_5' => 13,
                  'size_6' => 14,
                  'size_7' => 15,
                  'size_8' => 16,
                  'size_9' => 17,
                  'size_10' => 18,
                  'size_11' => 19,
                  'size_12' => 20,
                  'size_13' => 21,
                  'size_14' => 22,
                  'size_15' => 23,
                  'size_16' => 24,
                  'size_17' => 25,
                  'size_18' => 26,
                  'size_19' => 27,
                  'size_20' => 28,
                  'size_21' => 29,
                  'size_22' => 30,
                  'size_s' => 31,
                  'size_m' => 32,
                  'size_l' => 33,
                  'size_xl' => 34);
                if (($handle = fopen($location, "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                      if ($data[6] == "1" ) {
                        $query = "INSERT INTO cart_inventory SET sku='" . mysql_real_escape_string(trim($data[0]) . "-" . trim($data[2])) . "'";
                        foreach ($fields as $key => $value) {
                          $query .= ", `" . mysql_real_escape_string($key) . "`='" . mysql_real_escape_string(trim(strtolower($data[$value]))) . "'";
                        }
                        echo $query;
                        mysql_query($query);
                      }
                    }
                    fclose($handle);
                }
/*
                echo "<h3>Data Samples</h3>";
                echo "<table cellspacing=\"0\" cellpadding=\"5\" border=\"0\"><tr>";
                for ($i = 0; $i < 4; $i++) {
                    echo "<td width=\"250\"><strong>Sample #" . ($i + 1) . "</strong><br />";
                    foreach ($file_array[rand(0, count($file_array))] as $key => $value) {
                        echo "<strong>" . $key . "</strong>: " . trim($value) . "<br />";
                    }
                    echo "</td>";
                }
                echo "</tr></table>";
*/
            }
            echo "<br />";
            echo "<h3>Do these results make sense?</h3>";
            echo "<form method=\"post\" action=\"?p=inventory&s=upload&a=approved\">";
            echo "<input type=\"hidden\" name=\"filename\" value=\"" . $location  . "\" />";
            echo "<input type=\"submit\" value=\"Yes - Complete the upload\" />&nbsp;";
            echo "<input type=\"button\" value=\"No - Go back\" onclick=\"document.location='?p=inventory&s=upload'\" />";
            echo "</form>";
    } else if ($_GET['a'] == "approved") {
        $data = file($_POST['filename']);
        foreach ($data as $line) {
            $query = "INSERT INTO cart_inventory VALUES('')";
            echo $query . "<br />";
        }

    } else {
?>
        <form method="post" action="?p=inventory&s=upload&a=approve" enctype="multipart/form-data">
            <table class="editTable">
                <tr><td class="editLabel" width="80">Select File</td><td class="editField"><input type="file" name="csv" value="" /></td></tr>
            </table>
            <input type="submit" value="Upload" />
        </form>
<?php
    }
} else {
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
      echo "<img src=\"/img/cross.png\" alt=\"Remove Item\" title=\"Remove Item\" onclick=\"admin.delete('?p=inventory&a=delete&id=" . $item['id'] . "');\" />";
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
}
?>
