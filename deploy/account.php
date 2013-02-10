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
              <legend>&raquo; <?php echo t("My Account"); ?></legend>
              <table cellpadding="2" cellspacing="0" border="0" class="account-table">
                <tr>
                  <td><a href="/account/vieworders"><?php echo t("View Orders"); ?></a></td>
                </tr>
                <tr>
                  <td><a href="/account/edit"><?php echo t("Edit Account Information"); ?></a></td>
                </tr>
                <tr>
                  <td><a href="/account/editpassword"><?php echo t("Change Password"); ?></a></td>
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
              <legend>&raquo; <?php echo t("My Orders"); ?></legend>
              Order #1
            </fieldset>
          </td>
        </tr>
      </table>
      <?php
      } else if ($page === "edit") {
      ?>
      <table border="0" width="500">
        <tr>
          <td>
            <fieldset>
              <legend>&raquo; <?php echo t("Edit Account Information"); ?></legend>
              <form method="post" action="/account/edit">
                <table cellpadding="2" cellspacing="2" border="0" class="account-table" width="400">
                  <?php
                  if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    echo "<tr><td colspan=\"2\" align=\"center\" class=\"success\">" . t("Account Saved") . "</td></tr>";
                  }
                  ?>
                  <tr>
                    <td><?php echo t("First Name"); ?></td>
                    <td><input type="firstname" value="<?php echo $user->getFirstName();?>" /></td>
                  </tr>
                  <tr>
                    <td><?php echo t("Last Name"); ?></td>
                    <td><input type="lastname" value="<?php echo $user->getLastName();?>" /></td>
                  </tr>
                  <tr>
                    <td><?php echo t("Email"); ?></td>
                    <td><input type="email" value="<?php echo $user->getEmail(); ?>" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td><td align="left"><input type="submit" value="<?php echo t("Save"); ?>" /></td>
                  </tr>
                </table>
              </form>
            </fieldset>
          </td>
        </tr>
      </table>
      <?php
      } else if ($page === "editpassword") {
      ?>
      <table border="0" width="500">
        <tr>
          <td>
            <fieldset>
              <legend>&raquo; <?php echo t("Change Password"); ?></legend>
              <form method="post" action="/account/editpassword">
                <table cellpadding="2" cellspacing="2" border="0" class="account-table" width="400">
                  <?php
                  if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    echo "<tr><td colspan=\"2\" align=\"center\" class=\"success\">" . t("Password Saved") . "</td></tr>";
                  }
                  ?>
                  <tr>
                    <td><?php echo t("Current Password"); ?></td>
                    <td><input type="password" /></td>
                  </tr>
                  <tr>
                    <td><?php echo t("New Password"); ?></td>
                    <td><input type="password" /></td>
                  </tr>
                  <tr>
                    <td><?php echo t("Re-enter New Password"); ?></td>
                    <td><input type="password" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td><td align="left"><input type="submit" value="<?php echo t("Change Password"); ?>" /></td>
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
