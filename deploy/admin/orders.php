<?php
if (!isset($action)) {
  $sortby = $_GET['sortby'] ? $_GET['sortby'] : "timestamp";
  $dir = $_GET['dir'] == "0" ? "ASC" : "DESC";
  echo "<h3>Orders</h3>";
  $orders = Admin::getOrders($sortby, $dir);
  $bgcolor = array('#efefef','#ffffff');
  echo "<p>&nbsp;</p>";
  echo "<table cellpadding=\"4\" cellspacing=\"0\" width=\"100%\" class=\"inventory-table\">";
  echo "<tr class=\"table-header\">";
  echo "<td width=\"24\">#</td>";
  echo "<td><a href=\"?p=inventory&sortby=name&dir=0\">Customer Email</a></td>";
  echo "<td><a href=\"?p=inventory&sortby=color&dir=0\">Subtotal</a></td>";
  echo "<td><a href=\"?p=inventory&sortby=fulfillment_id&dir=0\">Order ID</a></td>";
  echo "<td><a href=\"?p=inventory&sortby=color&dir=0\">Status</a></td>";
  echo "<td><a href=\"?p=inventory&sortby=last_modified&dir=1\">Order Date</a></td>";
  echo "</tr>";
  $count = 1;
  foreach ($orders as $order) {
    echo "<tr bgcolor=\"" . $bgcolor[$count % 2] . "\">";
    echo "<td><strong>" . $count . "</strong></td>";
    echo "<td>--</td>";
    echo "<td>--</td>";
    echo "<td>" . $order['fulfillment_id'] . "</td>";
    echo "<td>" . $order['status'] . "</td>";
    echo "<td>" . date("M j, Y, g:i a", $order['timestamp']) . "</td>";
    echo "</tr>";
    $count++;
  }
  echo "</table>";
}
?>
