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
  $action = $_GET['a'];
  if (!isset($action)) {
    echo "<h3>Inventory</h3>";
    echo "<p class=\"addnew\"><a href=\"?p=inventory&a=add\"><img src=\"/img/add.png\" />&nbsp;Add New Item</a></p>";
    $query = "SELECT * FROM cart_inventory";
    $query = mysql_query($query);
    $count = 1;
    $bgcolor = array('#efefef','#ffffff');
    echo "<table cellpadding=\"4\" cellspacing=\"0\" width=\"100%\" class=\"inventory-table\">";
    echo "<tr class=\"table-header\">";
    echo "<td width=\"24\">#</td><td>Product Name (sku)</td><td>Color</td><td>Group</td><td>Gender</td><td>Active</td><td align=\"right\">Operations</td>";
    echo "</tr>";
    while ($row = mysql_fetch_assoc($query)) {
      echo "<tr bgcolor=\"" . $bgcolor[$count % 2] . "\">";
      echo "<td><strong>" . $count . "</strong></td>";
      echo "<td><strong>" . ucwords($row['name']) . "</strong> (" . $row['sku'] . ")</td>";
      echo "<td>" . ucwords($row['color']) . "</td>";
      echo "<td>" . ucwords($row['group']) . "</td>";
      echo "<td>" . ucwords($row['gender']) . "</td>";
      echo "<td>No</td>";
      echo "<td align=\"right\">";
      echo "<a href=\"?p=inventory&a=edit&id=" . $row['id'] . "\"><img src=\"/img/pencil.png\" alt=\"Edit Item\" title=\"Edit Item\" /></a>&nbsp;&nbsp;&nbsp;";
      echo "<a href=\"javascript:\"><img src=\"/img/cross.png\" alt=\"Delete Item\" title=\"Delete Item\" /></a></td>";
      echo "</tr>";
      $count++;
    }
    echo "</table>";
    echo "<p class=\"addnew\"><a href=\"?p=inventory&a=add\"><img src=\"/img/add.png\" />&nbsp;Add New Item</a></p>";
  } else if ($action === "edit") {
?>
  <h3>Inventory - Edit Item</h3>
  <form method="post" action="?p=inventory&a=save">
    <table class="editTable">
      <tr><td class="editLabel">Product Name</td><td class="editField"><input type="text" name="email" value="" /></td></tr>
      <tr><td class="editLabel">Sku</td><td class="editField"><input type="text" name="email" value="" /></td></tr>
      <tr><td class="editLabel">Description</td><td class="editField"><input type="text" name="email" value="" /></td></tr>
      <tr><td class="editLabel">Color</td><td class="editField"><input type="text" name="email" value="" /></td></tr>
      <tr><td class="editLabel">Group</td><td class="editField"><input type="text" name="email" value="" /></td></tr>
      <tr><td class="editLabel">Gender</td><td class="editField"><input type="text" name="email" value="" /></td></tr>
      <tr><td class="editLabel">Price</td><td class="editField"><input type="text" name="email" value="" /></td></tr>
      <tr><td class="editLabel">Image</td><td class="editField"><input type="text" name="email" value="" /></td></tr>
      <tr><td class="editLabel">Thumbnail</td><td class="editField"><input type="text" name="email" value="" /></td></tr>
      <tr><td class="editLabel">Active</td><td class="editField"><input type="checkbox" name="" value="" /></td></tr>
    </table>
    <input type="submit" value="Save Item" />
  </form>
<?php
  } else if ($action === "save") {
  }
}
?>
