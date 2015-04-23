<?php
require(".local.inc.php");
if ($user->isLoggedIn()) {
  header("Location: /shipping/");
}
include("inc/header.php");
?>
      <span id="bannerimage"><img src="/img/about-us.jpg" width="998" height="225" /></span>
      <div id="maincontent">
        <div id="contentarea2">
          <div id="login">
            <table cellspacing="0" cellpadding="0" width="100%" class="login-table">
              <tr>
                <td width="50%">
                  <table border="0" width="100%">
                    <tr>
                      <td>
                        <fieldset>
                          <legend>&raquo; <?php echo t("My Account"); ?></legend>
                          <form action="/login-redirect.php" method="post">
                            <table cellpadding="2" cellspacing="0" border="0" class="login-table">
                              <tr>
                                <td colspan="2"><?php echo t("To continue with the checkout you can log in, register for an account, or continue as a guest."); ?></td>
                              </tr>
                              <?php
                              if ($_GET['fail'] == "true") {
                              ?>
                              <tr>
                                <td colspan="2" class="error"><?php echo t("Username and password incorrect."); ?></td>
                              </tr>
                              <?php
                              }
                              ?>
                              <tr>
                                <td width="80"><?php echo t("Email"); ?></td><td><input type="text" name="email" /></td>
                              </tr>
                              <tr>
                                <td width="80"><?php echo t("Password"); ?></td><td><input type="password" name="password"/></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td><td><input type="submit" value="<?php echo t("Log In"); ?>" /></td>
                              </tr>
                              <tr>
                                <td colspan="2"><a href="/register/"><?php echo t("Don't have an account? Click here to sign up!"); ?></a></td>
                              </tr>
                            </table>
                            <input type="hidden" name="logintype" value="checkout" />
                            <input type="hidden" name="ref" value="/shipping/" />
                          </form>
                        </fieldset>
                      </td>
                    </tr>
                  </table>
                </td>
                <td align="center">
                  <a href="/shipping/"><?php echo t("Click here to continue as guest."); ?></a>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>

<?php
include("inc/footer.php");
?>
