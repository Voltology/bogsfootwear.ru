<?php
require(".local.inc.php");
include("inc/header.php");
$action = $_GET['a'];
$ref = $_POST['ref'] ? $_POST['ref'] : $_SERVER['HTTP_REFERER'];
if ($action === "reset") {
  $user->resetPassword($_POST['reset-email']);
}
?>
      <span id="bannerimage"><img src="/img/about-us.jpg" width="998" height="225" /></span>
      <div id="maincontent">
        <div id="contentarea2">
          <div id="login">
            <table border="0" width="500">
              <tr>
                <td>
                  <fieldset>
                    <legend>&raquo; My Account</legend>
                    <form action="/login-redirect.php" method="post">
                      <table cellpadding="2" cellspacing="0" border="0" class="login-table">
                        <tr>
                          <td colspan="2">Welcome back. To access your account, enter your email and password.</td>
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
                          <td colspan="2"><a href="/register">Don't have an account? Click here to sign up!</a></td>
                        </tr>
                      </table>
                      <input type="hidden" name="ref" value="<?php echo $ref; ?>" />
                    </form>
                  </fieldset>
                </td>
              </tr>
              <tr>
                <td>
                  <fieldset>
                    <legend>&raquo; Reset Password</legend>
                    <form action="/login.php?a=reset" method="post">
                      <table cellpadding="2" cellspacing="0" border="0" class="login-reset-table">
                        <?php
                        if ($action === "reset") {
                          echo "<tr class=\"success\"><td align=\"center\" colspan=\"2\">A temporary password has been emailed to you.</td></tr>";
                        }
                        ?>
                        <tr>
                          <td colspan="2">Enter your email address and a new password will be immediately sent to you. You may change your replacement password later under Sign In.</td>
                        </tr>
                        <tr>
                          <td width="80">Email</td><td><input type="text" name="reset-email" /></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td><td><input type="submit" value="Reset Password" /></td>
                        </tr>
                      </table>
                    </form>
                  </fieldset>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>

<?php
include("inc/footer.php");
?>
