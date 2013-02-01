<?php
require(".local.inc.php");
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
                          <form action="/checkout/" method="post">
                            <table cellpadding="2" cellspacing="0" border="0" class="shipping-table">
                              <tr>
                                <td colspan="2">You do not have any shipping addresses associated with this account.  Use the form on the right to create a new one.</td>
                              </tr>
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td width="50%">
                                  <table cellpadding="0" cellspacing="0" border="0" class="shipping-table" width="100%">
                                    <tr>
                                      <td valign="top" width="24">
                                        <input type="radio" name="shippingaddress" />
                                      </td>
                                      <td>
                                        Recipient Name<br />
                                        Address Line 1<br />
                                        Address Line 2<br />
                                        Line 3<br />
                                        Russia<br />
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                                <td>
                                  <table cellpadding="0" cellspacing="0" border="0" class="shipping-table" width="100%">
                                    <tr>
                                      <td valign="top" width="24">
                                        <input type="radio" name="shippingaddress" />
                                      </td>
                                      <td>
                                        Recipient Name<br />
                                        Address Line 1<br />
                                        Address Line 2<br />
                                        Line 3<br />
                                        Russia<br />
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2"><input type="submit" value="Use This Address" onclick="dialog.open();" /></td>
                              </tr>
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
                <td>
                  <table border="0" width="<?php if ($user->isLoggedIn()) { echo "100"; } else { echo "50"; } ?>%">
                    <tr>
                      <td>
                        <fieldset>
                          <legend>&raquo; New Shipping Address</legend>
                          <form action="/checkout/" method="post">
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
                                <td><input type="submit" value="Save Address" onclick="dialog.open();" /></td>
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
