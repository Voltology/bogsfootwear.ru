<?php
require(".local.inc.php");
if (!$user->isLoggedIn()) {
  header("Location: /login/");
}
$page = $_GET['page'] ? $_GET['page'] : null;
include("inc/header.php");
?>
<span id="bannerimage"><img src="/img/about-us.jpg" width="998" height="225" /></span>
<div id="maincontent">
  <div id="contentarea2">
    <div id="account">
      <?php
      if (!$page) {
      ?>
      <table border="0" width="500">
        <tr>
          <td>
            <fieldset>
              <legend>&raquo; <?php echo t("My Account"); ?></legend>
              <table cellpadding="2" cellspacing="0" border="0" class="account-table">
                <tr>
                  <td><a href="/account/vieworders"><?php echo t("View Orders"); ?></a></td>
                </tr>
                <tr>
                  <td><a href="/account/edit"><?php echo t("Edit Account Information"); ?></a></td>
                </tr>
                <tr>
                  <td><a href="/account/editpassword"><?php echo t("Change Password"); ?></a></td>
                </tr>
              </table>
            </fieldset>
          </td>
        </tr>
      </table>
      <?php
      } else if ($page === "vieworders") {
      ?>
      <table border="0" width="100%">
        <tr>
          <td>
            <fieldset>
              <legend>&raquo; <?php echo t("My Orders"); ?></legend>
                <br />
                <?php
                $orders = $cart->getCompletedOrdersByUserId($user->getId());
                $count = 0;
                foreach ($orders as $order) {
                ?>
                <span class="order-date"><strong>Order Date:</strong> <?php echo date('d/m/Y H:i:s', $order['timestamp']); ?></span>
                <table width="100%" cellpadding="4" cellspacing="0" border="0" class="cart-table" id="cart-table">
                  <thead>
                    <tr>
                      <th><?php echo t("Product"); ?></th>
                      <th><?php echo t("Description"); ?></th>
                      <th><?php echo t("Price"); ?></th>
                      <th><?php echo t("Quantity"); ?></th>
                      <th><?php echo t("Total"); ?></th>
                    </tr>
                  </thead>
                  <tbody id="cart-table-body">
                <?php
                  $subtotal = 0;
                  foreach ($order['items'] as $item) {
                ?>
                    <tr id="item-<?php echo $count; ?>" class="item-row">
                      <td width="30%">
                        <span><img src="/img/catalog/<?php echo $item['sku']; ?>/thumb.jpg" class="item-thumbnail" /></span>
                      </td>
                      <td valign="top" width="30%"><?php echo "<strong>" . $item['name'] . "</strong><br />" . $item['color']; ?><br /><?php echo t("Size"); ?> <?php echo $item['size']; ?></td>
                      <td valign="top" width="13%"><?php echo "\$" . number_format($item['price'], 2); ?></td>
                      <td valign="top" width="13%"><?php echo $item['quantity']; ?></td>
                      <td valign="top" width="*"><?php echo "\$<span class=\"total-price\" id=\"total-price-" . $item['sku'] . "-" . $item['size'] . "\">" . number_format($item['price'] * $item['quantity'], 2) . "</span>"; ?></td>
                    </tr>
                <?php
                    $subtotal += ($item['price'] * $item['quantity']);
                  }
                  $count++;
                ?>
                      <tr class="subtotal">
                        <td colspan="4"><?php echo t("Subtotal"); ?>:</td>
                        <td><?php echo "\$<span class=\"cart-subtotal\" id=\"cart-subtotal\">" . number_format($subtotal, 2); ?></span></td>
                      </tr>
                    </tbody>
                  </table>
                  <br /><br />
                <?php
                }
                ?>
              <?php
              if ($count == 0) {
                echo "<div style=\"text-align: center;\">You have no previous orders.</div>";
              }
              ?>
            </fieldset>
          </td>
        </tr>
      </table>
      <?php
      } else if ($page === "edit") {
      ?>
      <table border="0" width="500">
        <tr>
          <td>
            <fieldset>
              <legend>&raquo; <?php echo t("Edit Account Information"); ?></legend>
              <form method="post" action="/account/edit">
                <table cellpadding="2" cellspacing="2" border="0" class="account-table" width="400">
                  <?php
                  if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    echo "<tr><td colspan=\"2\" align=\"center\" class=\"success\">" . t("Account Saved") . "</td></tr>";
                  }
                  ?>
                  <tr>
                    <td><?php echo t("First Name"); ?></td>
                    <td><input type="firstname" value="<?php echo $user->getFirstName();?>" /></td>
                  </tr>
                  <tr>
                    <td><?php echo t("Last Name"); ?></td>
                    <td><input type="lastname" value="<?php echo $user->getLastName();?>" /></td>
                  </tr>
                  <tr>
                    <td><?php echo t("Email"); ?></td>
                    <td><input type="email" value="<?php echo $user->getEmail(); ?>" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td><td align="left"><input type="submit" value="<?php echo t("Save"); ?>" /></td>
                  </tr>
                </table>
              </form>
            </fieldset>
          </td>
        </tr>
      </table>
      <?php
      } else if ($page === "editpassword") {
      ?>
      <table border="0" width="500">
        <tr>
          <td>
            <fieldset>
              <legend>&raquo; <?php echo t("Change Password"); ?></legend>
              <form method="post" action="/account/editpassword">
                <table cellpadding="2" cellspacing="2" border="0" class="account-table" width="400">
                  <?php
                  if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    echo "<tr><td colspan=\"2\" align=\"center\" class=\"success\">" . t("Password Saved") . "</td></tr>";
                  }
                  ?>
                  <tr>
                    <td><?php echo t("Current Password"); ?></td>
                    <td><input type="password" /></td>
                  </tr>
                  <tr>
                    <td><?php echo t("New Password"); ?></td>
                    <td><input type="password" /></td>
                  </tr>
                  <tr>
                    <td><?php echo t("Re-enter New Password"); ?></td>
                    <td><input type="password" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td><td align="left"><input type="submit" value="<?php echo t("Change Password"); ?>" /></td>
                  </tr>
                </table>
              </form>
            </fieldset>
          </td>
        </tr>
      </table>
      <?php
      }
      ?>
    </div>
  </div>
</div>
<?php
include("inc/footer.php");
?>
