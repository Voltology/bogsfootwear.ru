<?php
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
            echo "<form method=\"post\" action=\"?p=upload&s=upload&a=approve\">";
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
        <form method="post" action="?p=upload&s=upload&a=approve" enctype="multipart/form-data">
            <table class="editTable">
                <tr><td class="editLabel" width="80">Select File</td><td class="editField"><input type="file" name="csv" value="" /></td></tr>
            </table>
            <input type="submit" value="Upload" />
        </form>
<?php
    }
?>
