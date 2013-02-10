<?php
require(".local.inc.php");
include("inc/header.php");
?>
      <span id="bannerimage"><img src="/img/about-us.jpg" width="998" height="225" /></span>
      <div id="maincontent">
        <div id="contentarea2">
          <span id="content2">
        <div id="confirm">
        <table border="0" width="100%">
          <tr>
            <td>
              <fieldset>
                <legend>&raquo; <?php echo t("Your Shopping Cart"); ?></legend>
                <table width="100%" cellpadding="4" cellspacing="0" border="0" class="cart-table">
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
                    $items = $cart->getCart();
                    $count = 0;
                    $subtotal = 0;
                    foreach ($items as $item) {
                    ?>
                    <tr id="item-<?php echo $count; ?>" class="item-row">
                      <td width="30%">
                        <span><img src="/img/catalog/thumbs/<?php echo $item['sku']; ?>-thumb.jpg<?php echo $item['thumbnail']; ?>" class="item-thumbnail" /></span>
                      </td>
                      <td valign="top" width="30%"><?php echo "<strong>" . $item['name'] . "</strong><br />" . $item['color']; ?><br />Size <?php echo $item['size']; ?></td>
                      <td valign="top" width="13%"><?php echo "\$" . number_format($item['price'], 2); ?></td>
                      <td valign="top" width="13%"><?php echo $item['quantity']; ?></td>
                      <td valign="top" width="*"><?php echo "\$<span class=\"total-price\" id=\"total-price-" . $item['sku'] . "\">" . number_format($item['price'] * $item['quantity'], 2) . "</span>"; ?></td>
                    </tr>
                    <?php
                      $subtotal += ($item['price'] * $item['quantity']);
                      $count++;
                    }
                    if ($count == 0) {
                      echo "<tr><td align=\"center\" colspan=\"5\">No items in cart.</td></tr>";
                    }
                    ?>
                    <tr class="shipping">
                      <td colspan="4"><?php echo t("Shipping"); ?>:<br /><small>(<?php echo t("US / Russian Express Mail with Tracking"); ?>)</small></td>
                      <td valign="top"><span class="cart-subtotal">$0.00</span></td>
                    </tr>
                    <tr><td colspan="5">&nbsp;</td></tr>
                    <tr class="subtotal">
                      <td colspan="4"><?php echo t("Subtotal"); ?>:</td>
                      <td><?php echo "\$<span class=\"cart-subtotal\" id=\"cart-subtotal\">" . number_format($subtotal, 2); ?></span></td>
                    </tr>
                  </tbody>
                </table>
              </fieldset>
            </td>
          </tr>
        </table>
        <table cellpadding="0" cellspacing="0" border="0" width="100%">
          <tr>
            <td>
              <fieldset>
                <legend>&raquo; <?php echo t("Your Shipping Address"); ?></legend>
                <table width="100%" cellpadding="4" cellspacing="0" border="0" class="shipping-table">
                  <tr>
                    <td>
                      <?php
                      $address = $user->getShippingAddressById($_SESSION['addressid']);
                      ?>
                      <strong><?php echo $address['recipient']; ?></strong><br />
                      <?php echo $address['address1']; ?><br />
                      <?php if ($address['address2'] !== "") { echo $address['address2'] . "<br />"; } ?>
                      <?php if ($address['district'] !== "") { echo $address['district'] . "<br />"; } ?>
                      <?php if ($address['province'] !== "") { echo $address['province'] . "<br />"; } ?>
                      <?php echo $address['postal_code']; ?><br />
                      <?php echo $address['country']; ?><br />
                      <a href="/shipping/"><?php echo t("Edit Address") ?></a>
                    </td>
                  </tr>
                </table>
              </fieldset>
            </td>
          </tr>
        </table>
        <table cellpadding="0" cellspacing="0" border="0" width="100%">
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><?php echo t("If all the details above are correct, click the \"Check out with PayPal\" button to continue."); ?></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="right">
              <input type="button" value="<?php echo t("Cancel Checkout"); ?>" onclick="document.location='/cart/'" />
              <input type="image" src="/img/btn-checkout.png" class="btn-checkout" id="btn-checkout" onclick="dialog.open(); document.location='/checkout/'" />
            </td>
          </tr>
        </table>
</div>
  </div>
<?php
$sizingguide = true;
include("inc/footer.php");
?>
