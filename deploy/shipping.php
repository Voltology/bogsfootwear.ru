<?php
require(".local.inc.php");
$action = $_GET['a'] ? $_GET['a'] : null;
$errors = array();
if ($_SERVER['REQUEST_METHOD'] === "POST" || isset($action)) {
  if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isRussian($_POST['firstname']) || isRussian($_POST['lastname']) || isRussian($_POST['address1']) || isRussian($_POST['address2']) || isRussian($_POST['district']) || isRussian($_POST['province']) || isRussian($_POST['postalcode']) || isRussian($_POST['country'])) {
      $errors[] = "Your address must be in English.";
    }
    if ($_POST['firstname'] == "") { $errors[] = "You must enter a first name."; }
    if ($_POST['lastname'] == "") { $errors[] = "You must enter a last name."; }
    if ($_POST['address1'] == "") { $errors[] = "You must enter an address."; }
    if ($_POST['postalcode'] == "") { $errors[] = "You must enter a postal code."; }
    if ($_POST['country'] == "") { $errors[] = "You must enter a country."; }
  }
  if ($action == "save" && $user->isLoggedIn()) {
    if (count($errors) == 0) {
      $addressid = $user->addShippingAddress($_POST['firstname'], $_POST['lastname'], $_POST['address1'], $_POST['address2'], $_POST['district'], $_POST['province'], $_POST['postalcode'], $_POST['country']);
    }
  } else if ($action == "remove" && $user->isLoggedIn()) {
    $user->removeShippingAddress($_GET['id']);
  } else {
    if (count($errors) == 0) {
      $_SESSION['addressid'] = $user->addShippingAddress($_POST['firstname'], $_POST['lastname'], $_POST['address1'], $_POST['address2'], $_POST['district'], $_POST['province'], $_POST['postalcode'], $_POST['country']);
      header("Location: /confirm/");
    } else if ($action == "continue") {
      $_SESSION['addressid'] = $_POST['shippingaddress'];
      header("Location: /confirm/");
    }
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
                          <legend>&raquo; <?php echo t("Select Shipping Address"); ?></legend>
                          <form action="/shipping/?a=continue" method="post">
                            <table cellpadding="2" cellspacing="0" border="0" class="shipping-table">
                              <?php
                              $addresses = $user->getShippingAddresses();
                              if (count($addresses) === 0) {
                              ?>
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2"><?php echo t("You do not have any shipping addresses associated with this account. Use the form on the right to create a new one."); ?></td>
                              </tr>
                              <?php
                              } else {
                              ?>
                              <tr>
                                <td colspan="2"><?php echo t("Select the shipping address you'd like to use or create a new one using the form on the right."); ?></td>
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
                                      <strong><?php echo $address['firstname'] . " " . $address['lastname']; ?></strong><br />
                                      <?php echo $address['address1']; ?><br />
                                      <?php if ($address['address2'] !== "") { echo $address['address2'] . "<br />"; } ?>
                                      <?php if ($address['district'] !== "") { echo $address['district'] . ", "; } ?>
                                      <?php if ($address['province'] !== "") { echo $address['province'] . " "; } ?>
                                      <?php echo $address['postal_code']; ?><br />
                                      <?php echo $cart->getCountryNameByCode($address['country']); ?><br />
                                      <a href="javascript:if(confirm('<?php echo t("Are you sure you want to remove this address?"); ?>')) { document.location = '/shipping/?a=remove&id=<?php echo $address['id']; ?>'; }"><?php echo t("Remove Address"); ?></a>
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
                                <td colspan="2"><input type="submit" value="<?php echo t("Use This Address"); ?>" /></td>
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
                          <legend>&raquo; <?php if ($user->isLoggedIn()) { echo t("New"); } else { echo "Your"; } ?> <?php echo t("Shipping Address"); ?></legend>
                          <?php
                          if (count($errors) > 0) {
                            echo "<div class=\"error\">";
                            foreach ($errors as $error) {
                              echo $error . "<br />";
                            }
                            echo "</div>";
                          }
                          ?>
                          <form action="/shipping/?a=save" method="post">
                            <table cellpadding="2" cellspacing="0" border="0" class="shipping-table">
                              <tr>
                                <td colspan="2"><strong>*<?php echo t("Note:"); ?></strong> <?php echo t("Shipping address must be a residential address."); ?></td>
                              </tr>
                              <tr>
                                <td><?php echo t("First Name"); ?></td>
                                <td><input type="text" name="firstname" value="<?php echo $_POST['firstname']; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo t("Last Name"); ?></td>
                                <td><input type="text" name="lastname" value="<?php echo $_POST['lastname']; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo t("Address Line 1"); ?></td>
                                <td><input type="text" name="address1" value="<?php echo $_POST['address1']; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo t("Address Line 2"); ?></td>
                                <td><input type="text" name="address2" value="<?php echo $_POST['address2']; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo t("District"); ?></td>
                                <td><input type="text" name="district" value="<?php echo $_POST['district']; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo t("Province"); ?></td>
                                <td><input type="text" name="province" value="<?php echo $_POST['province']; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo t("Postal Code"); ?></td>
                                <td><input type="text" name="postalcode" value="<?php echo $_POST['postalcode']; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo t("Country"); ?></td>
                                <td>
                                  <select name="country">
                                    <option value="">Select Country</option>
                                    <option value="RU">Russian Federation</option>
                                    <option value="US">United States</option>
                                    <?php
                                      $countries = $cart->getCountries();
                                      foreach ($countries as $country) {
                                        echo "<option value=" . $country['iso1_code'];
                                        if ($country['iso1_code'] == $_POST['country']) { echo " selected"; }
                                        echo ">" . $country['name'] . "</option>";
                                      }
                                    ?>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <?php
                                if ($user->isLoggedIn()) {
                                  echo "<td><input type=\"submit\" value=\"" . t("Save Address") . "\" /></td>";
                                } else {
                                  echo "<td><input type=\"submit\" value=\"" . t("Continue with Checkout") . "\" />&nbsp;<input type=\"button\" value=\"Cancel\" onclick=\"window.location='/checkoutlogin/'\"/></td>";
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
