<?php
require(".local.inc.php");
include("inc/header.php");
?>
      <span id="bannerimage"><img src="/img/about-us.jpg" width="998" height="225" /></span>
      <div id="maincontent">
        <div id="contentarea2">
          <span id="content2">
        <div id="cart">
        <table border="0" width="100%">
          <tr>
            <td>
              <fieldset>
                <legend>&raquo; Your Shopping Cart</legend>
                <table width="100%" cellpadding="4" cellspacing="0" border="0" class="cart-table" id="cart-table">
                  <thead>
                    <tr>
                      <th>Products</th>
                      <th>Description</th>
                      <th>Price</th>
                      <th>Qty</th>
                      <th>Total</th>
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
                        <span><img src="/img/catalog/womens-collections/womens-plimsoll/thumbs/71111-009.jpg<?php echo $item['thumbnail']; ?>" class="item-thumbnail" /></span>
                        <img src="/img/cross.png" class="item-remove" alt="Remove Item" title="Remove Item" onclick="cart.remove('<?php echo $item['id']; ?>', '<?php echo $count; ?>');" />
                      </td>
                      <td valign="top" width="30%"><?php echo "<strong>" . $item['name'] . "</strong><br />" . $item['color']; ?></td>
                      <td valign="top" width="13%"><?php echo "\$" . number_format($item['price'], 2); ?></td>
                      <td valign="top" width="13%">
                        <select onchange="cart.update('<?php echo $item['id']; ?>', this.options[this.selectedIndex].value)">
                          <?php
                          for ($i = 1; $i <= 20; $i++) {
                            echo "<option";
                            if ($item['quantity'] == $i) { echo " selected"; }
                            echo ">" . $i . "</option>";
                          }
                          ?>
                        </select>
                      </td>
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
                    <tr class="subtotal">
                      <td colspan="4">Subtotal:</td>
                      <td><?php echo "\$<span class=\"cart-subtotal\" id=\"cart-subtotal\">" . number_format($subtotal, 2); ?></span></td>
                    </tr>
                  </tbody>
                </table>
              </fieldset>
            </td>
          </tr>
          <tr>
            <td align="right">
              <input type="button" value="Continue Shopping" onclick="document.location='/catalog/'" />
              <?php if ($count !== 0) { ?>
              <input type="image" src="/img/btn-checkout.png" class="btn-checkout" id="btn-checkout" onclick="dialog.open(); document.location='/checkout/'" />
              <? } ?>
            </td>
          </tr>
        </table>
    </div>
  </div>
<?php
$sizingguide = true;
include("inc/footer.php");
?>
