<?php
require(".local.inc.php");
$action = $_GET['a'] ? $_GET['a'] : null;
if ($_SERVER['REQUEST_METHOD'] === "POST" || isset($action)) {
  if ($action == "save" && $user->isLoggedIn()) {
    $addressid = $user->addShippingAddress($_POST['recipient'], $_POST['address1'], $_POST['address2'], $_POST['district'], $_POST['province'], $_POST['postalcode'], $_POST['country']);
  } else if ($action == "remove" && $user->isLoggedIn()) {
    $user->removeShippingAddress($_GET['id']);
  } else {
    $_SESSION['addressid'] = $_POST['shippingaddress'];
    header("Location: /confirm/");
  }
}
include("inc/header.php");
?>
      <span id="bannerimage"><img src="/img/about-us.jpg" width="998" height="225" /></span>
      <div id="maincontent">
        <div id="contentarea2">
          <div id="shipping">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
              <tr>
                <?php
                if ($user->isLoggedIn()) {
                ?>
                <td width="50%" valign="top">
                  <table border="0" width="<?php if ($user->isLoggedIn()) { echo "100"; } else { echo "50"; } ?>%">
                    <tr>
                      <td>
                        <fieldset>
                          <legend>&raquo; Select Shipping Address</legend>
                          <form action="/shipping/" method="post">
                            <table cellpadding="2" cellspacing="0" border="0" class="shipping-table">
                              <?php
                              $addresses = $user->getShippingAddresses();
                              if (count($addresses) === 0) {
                              ?>
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2">You do not have any shipping addresses associated with this account.  Use the form on the right to create a new one.</td>
                              </tr>
                              <?php
                              } else {
                              ?>
                              <tr>
                                <td colspan="2">Select the shipping address you'd like to use or create a new one using the form on the right.</td>
                              </tr>
                              <?php
                              }
                              ?>
                              <?php
                              $count = 0;
                              foreach ($addresses as $address) {
                                if ($count % 2 === 0) {
                                  echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
                                  echo "<tr>";
                                }
                              ?>
                              <td width="50%" valign="top">
                                <table cellpadding="0" cellspacing="0" border="0" class="shipping-table" width="100%">
                                  <tr>
                                    <td valign="top" width="24">
                                      <input type="radio" name="shippingaddress" value="<?php echo $address['id']; ?>" <?php if ($addressid == $address['id'] || (!isset($addressid) && $count === 0)) { echo "checked "; } ?>/>
                                    </td>
                                    <td valign="top">
                                      <strong><?php echo $address['recipient']; ?></strong><br />
                                      <?php echo $address['address1']; ?><br />
                                      <?php if ($address['address2'] !== "") { echo $address['address2'] . "<br />"; } ?>
                                      <?php if ($address['district'] !== "") { echo $address['district'] . "<br />"; } ?>
                                      <?php if ($address['province'] !== "") { echo $address['province'] . "<br />"; } ?>
                                      <?php echo $address['postal_code']; ?><br />
                                      <?php echo $address['country']; ?><br />
                                      <a href="javascript:if(confirm('Are you sure you want to remove this address?')) { document.location = '/shipping/?a=remove&id=<?php echo $address['id']; ?>'; }">Remove Address</a>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                              <?php
                                if ($count % 2 === 1) {
                                  echo "</tr>";
                                  echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
                                }
                                $count++;
                              }
                              ?>
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <?php
                              if (count($addresses) > 0) {
                              ?>
                              <tr>
                                <td colspan="2"><input type="submit" value="Use This Address" /></td>
                              </tr>
                              <?php
                              }
                              ?>
                            </table>
                          </form>
                        </fieldset>
                      </td>
                    </tr>
                  </table>
                </td>
                <?php
                }
                ?>
                <td valign="top">
                  <table border="0" width="<?php if ($user->isLoggedIn()) { echo "100"; } else { echo "50"; } ?>%">
                    <tr>
                      <td>
                        <fieldset>
                          <legend>&raquo; <?php if ($user->isLoggedIn()) { echo "New"; } else { echo "Your"; } ?> Shipping Address</legend>
                          <form action="/shipping/?a=save" method="post">
                            <table cellpadding="2" cellspacing="0" border="0" class="shipping-table">
                              <tr>
                                <td>Recipient Name</td>
                                <td><input type="text" name="recipient" /></td>
                              </tr>
                              <tr>
                                <td>Address Line 1</td>
                                <td><input type="text" name="address1" /></td>
                              </tr>
                              <tr>
                                <td>Address Line 2</td>
                                <td><input type="text" name="address2" /></td>
                              </tr>
                              <tr>
                                <td>District</td>
                                <td><input type="text" name="district" /></td>
                              </tr>
                              <tr>
                                <td>Province</td>
                                <td><input type="text" name="province" /></td>
                              </tr>
                              <tr>
                                <td>Postal Code</td>
                                <td><input type="text" name="postalcode" /></td>
                              </tr>
                              <tr>
                                <td>Country</td>
                                <td><input type="text" name="country" /></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <?php
                                if ($user->isLoggedIn()) {
                                  echo "<td><input type=\"submit\" value=\"Save Address\" /></td>";
                                } else {
                                  echo "<td><input type=\"submit\" value=\"Continue with Checkout\" /></td>";
                                }
                                ?>

                              </tr>
                            </table>
                          </form>
                        </fieldset>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
<?php
include("inc/footer.php");
?>
