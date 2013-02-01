<?php
require(".local.inc.php");
if (!$user->isLoggedIn()) {
  header("Location: /login/");
}
$page = $_GET['page'] ? $_GET['page'] : null;
include("inc/header.php");
?>
<span id="bannerimage"><img src="/img/about-us.jpg" width="998" height="225" /></span>
<div id="maincontent">
  <div id="contentarea2">
    <div id="account">
      <?php
      if (!$page) {
      ?>
      <table border="0" width="500">
        <tr>
          <td>
            <fieldset>
              <legend>&raquo; My Account</legend>
              <table cellpadding="2" cellspacing="0" border="0" class="account-table">
                <tr>
                  <td><a href="/account/vieworders">View Orders</a></td>
                </tr>
                <tr>
                  <td><a href="/account/edit">Change Account Information</a></td>
                </tr>
                <tr>
                  <td><a href="/account/editpassword">Change Password</a></td>
                </tr>
              </table>
            </fieldset>
          </td>
        </tr>
      </table>
      <?php
      } else if ($page === "vieworders") {
      ?>
      <table border="0" width="100%">
        <tr>
          <td>
            <fieldset>
              <legend>&raquo; My Orders</legend>
              Order #1
            </fieldset>
          </td>
        </tr>
      </table>
      <?php
      } else if ($page === "edit") {
      } else if ($page === "editpassword") {
      ?>
      <table border="0" width="500">
        <tr>
          <td>
            <fieldset>
              <legend>&raquo; Change Password</legend>
              <form method="post" action="/account/editpassword">
                <table cellpadding="2" cellspacing="2" border="0" class="account-table" width="400">
                  <?php
                  if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    echo "<tr><td colspan=\"2\" align=\"center\" class=\"success\">Password Saved</td></tr>";
                  }
                  ?>
                  <tr>
                    <td>Current Password</td>
                    <td><input type="password" /></td>
                  </tr>
                  <tr>
                    <td>New Password</td>
                    <td><input type="password" /></td>
                  </tr>
                  <tr>
                    <td>Re-enter New Password</td>
                    <td><input type="password" /></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="right"><input type="submit" value="Change Password" /></td>
                  </tr>
                </table>
              </form>
            </fieldset>
          </td>
        </tr>
      </table>
      <?php
      }
      ?>
    </div>
  </div>
</div>
<?php
include("inc/footer.php");
?>
