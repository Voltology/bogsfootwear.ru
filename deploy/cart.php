<?php
require(".local.inc.php");
require("inc/header.php");
?>
      <span id="bannerimage"><img src="/img/about-us.jpg" width="998" height="225" /></span>


      <div id="maincontent">
        <div id="contentarea2">
          <span id="content2">
        <div>
      <div>
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
              <input type="image" src="/img/btn-checkout.png" class="btn-checkout" id="btn-checkout" onclick="document.location='/checkout/'" />
              <? } ?>
            </td>
          </tr>
        </table>
    </div>
    </div>

    </div>

    </div>
    </div>

    <div class="clear"></div>

    <div id="footer"><span style="color: #ffffff; font-size: 6pt; margin: 230px; line-height: 18pt;">&copy; Copyright 2012. Global Supply Management Inc. All Rights Reserved</span></div>

    <div class="clear"></div>

    </div>
    &nbsp;<br/>
    &nbsp;<br/>

    <div class="modal modalMusic">

    <div class="modalHeader">&nbsp;</div>
    <div class="modalBack"><a>&nbsp;</a></div>
    <div class="clear"></div>

    <div class="modalBody">

    <table width="830" cellpadding="0" cellspacing="0" border="0">

    <tr>

    <td width="830" valign="middle" align="left"><h1>Fall 2012 Stocking Order</h1>
    We will be stocking the following boots in Moscow and Sakhalin in the fall of 2012.<br/>
    <br/>
    <h2>Sakhalin</h2>
    <table class="sizingTable" border="1" cellpadding="0" cellspacing="0" bgcolor="#000000" nobevel noshade>
            <tr>
                <td>STK#</td>
                <td>STYLE</td>
                <td>COLOR</td>
                <td colspan="16">SIZES</td>
            </tr>
            <tr>
                <td colspan="4"><b>MEN'S</b></td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>14</td>
                <td>15</td>
                <td>16</td>
                <td>17</td>
                <td>18</td>
            </tr>
            <tr>
                <td>51377-001</td>
                <td>ULTRA HIGH</td>
                <td>BLACK</td>
                <td>7-18</td>
                 <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>25</td>
                <td>50</td>
                <td>75</td>
                <td>75</td>
                <td>50</td>
                <td>25</td>
                <td>6</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
           </tr>
            <tr>
                <td>69172-001</td>
                <td>RANCHER STEEL TOE</td>
                <td>BLACK</td>
                <td>4-18</td>
                 <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>12</td>
                <td>25</td>
                <td>38</td>
                <td>38</td>
                <td>25</td>
                <td>13</td>
                <td>4</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
           </tr>

            <tr>
                <td colspan="4"><b>HUNT 365</b></td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>14</td>
                <td>15</td>
                <td>16</td>
                <td>17</td>
                <td>18</td>

            </tr>
            <tr>
                <td>71069-974</td>
                <td>BLAZE EXTREME</td>
                <td>REAL TREE</td>
                <td>8-14</td>
                 <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>10</td>
                <td>26</td>
                <td>34</td>
                <td>34</td>
                <td>26</td>
                <td>14</td>
                <td>7</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>
            <tr>
                <td>50325-973</td>
                <td>BLAZE 1000</td>
                <td>MOSSY OAK</td>
                <td>7-14</td>
               <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>10</td>
                <td>26</td>
                <td>34</td>
                <td>34</td>
                <td>26</td>
                <td>14</td>
                <td>7</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>

            <tr>
                <td colspan="4"><b>WOMEN'S</b></td>
                 <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>

            </tr>
            <tr>
                <td>71219-302</td>
                <td>CLASSIC MID VINTAGE</td>
                <td>OLIVE</td>
                <td>6-12</td>
                 <td>25</td>
                <td>50</td>
                <td>75</td>
                <td>75</td>
                <td>50</td>
                <td>25</td>
                <td></td>
            </tr>
            <tr>
                <td>71084-202</td>
                <td>SEYMOUR</td>
                <td>CHOCOLATE</td>
                <td>6-11</td>
                <td>13</td>
                <td>26</td>
                <td>36</td>
                <td>36</td>
                <td>26</td>
                <td>13</td>
                <td></td>
            </tr>

            <tr>
                <td colspan="4"><b>KID'S</b></td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
            </tr>
            <tr>
                <td>71192-544</td>
                <td>CLASSIC SPROUT</td>
                <td>GRAPE</td>
                <td>7-6</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>25</td>
                <td>25</td>
                <td>25</td>
                <td>25</td>
                <td>25</td>
                <td>25</td>
                <td>25</td>
            </tr>
            <tr>
                <td>52510-001</td>
                <td>CLASSIC HI SPIDERS</td>
                <td>BLACK</td>
                <td>7-6</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>25</td>
                <td>25</td>
                <td>25</td>
                <td>25</td>
                <td>25</td>
                <td>25</td>
                <td>25</td>
             </tr>
    </table>


    <h2>Moscow</h2>
    <table class="sizingTable" border="1" cellpadding="0" cellspacing="0" bgcolor="#000000" nobevel noshade>
            <tr>
                <td>STK#</td>
                <td>STYLE</td>
                <td>COLOR</td>
                <td colspan="16">SIZES</td>
            </tr>
            <tr>
                <td colspan="4"><b>MEN'S</b></td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>14</td>
                <td>15</td>
                <td>16</td>
                <td>17</td>
                <td>18</td>
            </tr>
            <tr>
                <td>51377-001</td>
                <td>ULTRA HIGH</td>
                <td>BLACK</td>
                <td>7-18</td>
                 <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>50</td>
                <td>100</td>
                <td>150</td>
                <td>150</td>
                <td>100</td>
                <td>50</td>
                <td>12</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
           </tr>
            <tr>
                <td>51407-001</td>
                <td>ULTRA MID</td>
                <td>BLACK</td>
                <td>7-18</td>
                 <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>50</td>
                <td>100</td>
                <td>150</td>
                <td>150</td>
                <td>100</td>
                <td>50</td>
                <td>12</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
           </tr>

            <tr>
                <td colspan="4"><b>HUNT 365</b></td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>14</td>
                <td>15</td>
                <td>16</td>
                <td>17</td>
                <td>18</td>

            </tr>
            <tr>
                <td>71072-974</td>
                <td>BOWMAN</td>
                <td>REAL TREE</td>
                <td>4-14</td>
                 <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>12</td>
                <td>25</td>
                <td>34</td>
                <td>34</td>
                <td>25</td>
                <td>13</td>
                <td>7</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>
            <tr>
                <td>71068-973</td>
                <td>BLAZE EXTREME</td>
                <td>MOSSY OAK</td>
                <td>8-14</td>
               <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>25</td>
                <td>50</td>
                <td>75</td>
                <td>75</td>
                <td>50</td>
                <td>25</td>
                <td>6</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>

            <tr>
                <td colspan="4"><b>WOMEN'S</b></td>
                 <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>

            </tr>
            <tr>
                <td>71223-207</td>
                <td>CLASSIC MID STARGAZER</td>
                <td>CHOCOLATE</td>
                <td>6-12</td>
                 <td>25</td>
                <td>50</td>
                <td>75</td>
                <td>75</td>
                <td>50</td>
                <td>25</td>
                <td></td>
            </tr>
             <tr>
                <td>71224-492</td>
                <td>CLASSIC MID STARGAZER</td>
                <td>NAVY</td>
                <td>6-12</td>
                 <td>25</td>
                <td>50</td>
                <td>75</td>
                <td>75</td>
                <td>50</td>
                <td>25</td>
                <td></td>
            </tr>
            <tr>
                <td>71084-202</td>
                <td>SEYMOUR</td>
                <td>CHOCOLATE</td>
                <td>6-11</td>
                <td>13</td>
                <td>30</td>
                <td>34</td>
                <td>34</td>
                <td>26</td>
                <td>13</td>
                <td></td>
            </tr>
            <tr>
                <td>52440-001</td>
                <td>MCKENNA</td>
                <td>BLACK</td>
                <td>6-11</td>
                <td>13</td>
                <td>30</td>
                <td>34</td>
                <td>34</td>
                <td>26</td>
                <td>13</td>
                <td></td>
            </tr>

            <tr>
                <td colspan="4"><b>KID'S</b></td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
            </tr>
            <tr>
                <td>71187-690</td>
                <td>CLASSIC CRAZY DAISY</td>
                <td>PINK</td>
                <td>7-6</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>25</td>
                <td>25</td>
                <td>25</td>
                <td>25</td>
                <td>25</td>
                <td>25</td>
                <td>25</td>
            </tr>
            <tr>
                <td>71179-009</td>
                <td>CLASSIC SNAKE</td>
                <td>BLACK</td>
                <td>7-6</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>25</td>
                <td>25</td>
                <td>25</td>
                <td>25</td>
                <td>25</td>
                <td>25</td>
                <td>25</td>
             </tr>
    </table>

    </div></div>
    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-33670595-1']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>
  </body>
</html>
<?php
require("inc/footer.php");
?>
