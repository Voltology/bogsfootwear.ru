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
                          <legend>&raquo; My Account</legend>
                          <form action="/login-redirect.php" method="post">
                            <table cellpadding="2" cellspacing="0" border="0" class="login-table">
                              <tr>
                                <td colspan="2">To contiune with the checkout, you can log in, register for an account or continue as a guest.</td>
                              </tr>
                              <?php
                              if ($_GET['fail'] == "true") {
                              ?>
                              <tr>
                                <td colspan="2" class="error">Username and password incorrect.</td>
                              </tr>
                              <?php
                              }
                              ?>
                              <tr>
                                <td width="80">Email</td><td><input type="text" name="email" /></td>
                              </tr>
                              <tr>
                                <td width="80">Password</td><td><input type="password" name="password"/></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td><td><input type="submit" value="Log In" /></td>
                              </tr>
                              <tr>
                                <td colspan="2"><a href="/register/">Don't have an account? Click here to register!</a></td>
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
                  <a href="/shipping/">Click here to continue as guest.</a>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>

<?php
include("inc/footer.php");
?>
