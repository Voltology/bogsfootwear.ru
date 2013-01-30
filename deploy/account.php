<?php
require(".local.inc.php");
if (!$user->isLoggedIn()) {
  header("Location: /login/");
}
include("inc/header.php");
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
              <table cellpadding="2" cellspacing="0" border="0" class="login-table">
                <tr>
                  <td><a href="">View Orders</a></td>
                </tr>
                <tr>
                  <td><a href="">Change Account Information</a></td>
                </tr>
                <tr>
                  <td><a href="">Change Password</a></td>
                </tr>
              </table>
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
