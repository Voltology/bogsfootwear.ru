<?php
if (!isset($action)) {
  if ($_GET['t'] == "cancel") {
    Admin::cancelOrder($_GET['id']);
  }
  $sortby = $_GET['sortby'] ? $_GET['sortby'] : "timestamp";
  $dir = $_GET['dir'] == "0" ? "ASC" : "DESC";
  echo "<h3>Orders</h3>";
  $orders = Admin::getOrders($sortby, $dir);
  $bgcolor = array('#efefef','#ffffff');
  echo "<p>&nbsp;</p>";
  echo "<table cellpadding=\"4\" cellspacing=\"0\" width=\"100%\" class=\"inventory-table\">";
  echo "<tr class=\"table-header\">";
  echo "<td width=\"24\">#</td>";
  echo "<td><a href=\"?p=inventory&sortby=email&dir=0\">Customer</a></td>";
  echo "<td>Order ID</td>";
  echo "<td>Reference ID</td>";
  echo "<td><a href=\"?p=inventory&sortby=status&dir=0\">Status</a></td>";
  echo "<td><a href=\"?p=inventory&sortby=timestamp&dir=1\">Order Date</a></td>";
  echo "<td align=\"right\">Operations</td>";
  echo "</tr>";
  $count = 1;
  foreach ($orders as $order) {
    echo "<tr bgcolor=\"" . $bgcolor[$count % 2] . "\">";
    echo "<td><strong>" . $count . "</strong></td>";
    echo "<td>";
    if ($order['user_id'] == 0) {
      echo "Guest";
    } else {
      echo $order['email'];
    }
    echo "</td>";
    echo "<td><a href=\"?p=orders&a=view&id=" . $order['id'] . "\">" . $order['fulfillment_id'] . "</td>";
    echo "<td>" . $order['reference_id'] . "</td>";
    echo "<td>" . $order['status'] . "</td>";
    echo "<td>" . date("M j, Y, g:i a", $order['timestamp']) . "</td>";
    echo "<td align=\"right\"><a href=\"?p=orders&a=view&id=" . $order['id'] . "\"><img src=\"/img/pencil.png\" border=\"0\" /></a></td>";
    echo "</tr>";
    $count++;
  }
  echo "</table>";
} else if ($action == "view") {
  $order = Admin::getOrderById($_GET['id']);
  ?>
  <h3>Orders</h3>
  <h4>Order Details</h4>
  <table class="editTable">
    <tr><td class="editLabel">Order ID</td><td class="editField"><?php echo $order['fulfillment_id']; ?></td></tr>
    <tr><td class="editLabel">Reference ID</td><td class="editField"><?php echo $order['reference_id']; ?></td></tr>
    <tr><td class="editLabel">Status</td><td class="editField"><?php echo $order['status']; ?></td></tr>
    <tr><td class="editLabel">Order Date</td><td><?php echo date("M j, Y, g:i a", $order['timestamp']); ?></td></tr>
    <tr>
      <td class="editLabel">Shipping Address</td>
      <td class="editField">
        <strong><?php echo $order['firstname'] . " " . $order['lastname']; ?></strong><br />
        <?php echo $order['address1']; ?><br />
        <?php if ($order['address2'] !== "") { echo $order['address2'] . "<br />"; } ?>
        <?php if ($order['district'] !== "") { echo $order['district'] . ", "; } ?>
        <?php if ($order['province'] !== "") { echo $order['province'] . " "; } ?>
        <?php echo $order['postal_code']; ?><br />
        <?php echo $cart->getCountryNameByCode($order['country']); ?><br />
      </td>
    </tr>
    <tr>
      <td class="editLabel">Ordered Items</td>
      <td class="editField">
        <table width="600" cellpadding="4" cellspacing="0" border="0" class="cart-table" id="cart-table">
          <thead align="left">
            <tr>
              <th>Product</th>
              <th>Description</th>
              <th>Price</th>
              <th>Qty</th>
              <th>Total</th>
            </tr>
          </thead>
          <?php
          $items = Admin::getOrderedItemsById($order['id']);
          $subtotal = 0;
          foreach ($items as $item) {
          ?>
            <tr id="item-<?php echo $count; ?>" class="item-row">
              <td width="30%">
                <span><img src="/img/catalog/<?php echo $item['sku']; ?>/1-thumb.jpg" class="item-thumbnail" /></span>
              </td>
              <td valign="top" width="30%"><?php echo "<strong>" . ucwords($item['name']) . "</strong><br />(<a href=\"?p=inventory&a=edit&id=" . $item['item_id'] . "\">" . $item['sku'] . "</a>)<br />Color: " . ucwords($item['color']); ?><br />Size: <?php echo $item['size']; ?></td>
              <td valign="top" width="13%"><?php echo "\$" . number_format($item['price'], 2); ?></td>
              <td valign="top" width="13%"><?php echo $item['quantity']; ?></td>
              <td valign="top" width="*"><?php echo "\$<span class=\"total-price\" id=\"total-price-" . $item['sku'] . "-" . $item['size'] . "\">" . number_format($item['price'] * $item['quantity'], 2) . "</span>"; ?></td>
            </tr>
            <?php
            $subtotal += ($item['price'] * $item['quantity']);
          }
          ?>
        </table>
      </td>
    </tr>
    <tr><td class="editLabel">Subtotal</td><td class="editField">$<?php echo number_format($subtotal, 2);  ?></td></tr>
  </table>
  <p class="addnew"><a href="#" onclick="admin.delete('?p=orders&t=cancel&id=<?php echo $order['fulfillment_id']; ?>');"><img src="/img/cross.png" />&nbsp;Cancel This Order</a></p>
  <?
}
?>
