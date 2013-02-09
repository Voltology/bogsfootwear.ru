<?php
require("../.local.inc.php");
require(LIB_PATH . "/Admin.class.php");
require(LIB_PATH . "/Fulfillment.class.php");
$page = $_GET['p'] ? $_GET['p'] : "home";
$subpage = $_GET['s'] ? $_GET['s'] : null;
$action = $_GET['a'] ? $_GET['a'] : null;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title><?php echo COMPANY_NAME; ?> &raquo; Admin</title>
    <link rel="stylesheet" href="/css/admin.css"/>
    <script type="text/javascript" src="/js/cart.js"></script>
  </head>
  <body>
    <table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2" valign="middle">
          <div class="headerlogo">
            <a href="<?php echo BASE_URL; ?>"><img src="/img/admin/<?php echo ADMIN_LOGO; ?>" /></a><div class="headertext">Administration Area</div>
          </div>
        </td>
      </tr>
      <tr>
        <td valign="top" class="sidebarCell" width="120" style="border-top: 2px solid #000;">
          <div id="sidebar" style="line-height: 1.3em;">
          <?php
          if ($user->isLoggedIn()) {
          ?>
            <div class="<?php if ($page === "home") { ?>active<?php } ?>menuitem"><a href="?p=">Home</a></div>
            <div class="<?php if ($page === "inventory") { ?>active<?php } ?>menuitem"><a href="?p=inventory">Inventory</a></div>
            <div class="<?php if ($page === "groups") { ?>active<?php } ?>menuitem"><a href="?p=groups">Groups</a></div>
            <div class="<?php if ($page === "upload") { ?>active<?php } ?>menuitem"><a href="?p=upload">Upload CSV</a></div>
            <div class="<?php if ($page === "orders") { ?>active<?php } ?>menuitem"><a href="?p=orders">Orders</a></div>
            <div class="<?php if ($page === "users") { ?>active<?php } ?>menuitem"><a href="?p=users">Users</a></div>
            <div class="<?php if ($page === "settings") { ?>active<?php } ?>menuitem"><a href="?p=settings">Settings</a></div>
            <br />
            <div class="logout"><a href="../logout?admin=true">Log Out</a></div>
            <br />
          <?php
          }
          ?>
          </div>
        </td>
        <td valign="top" align="left" class="page" style="border-top: 2px solid #000;">
          <?php
          if (!$user->isLoggedIn()) {
          ?>
          <h3>Log In</h3>
          <form method="post" action="/login-redirect.php">
            <?php
            if ($_GET['fail'] === "true") {
              echo "<div class=\"error\">Username/password incorrect.</div>";
            }
            ?>
            <table class="editTable">
              <tr><td class="editLabel">Email</td><td class="editField"><input type="text" name="email" value="" /></td></tr>
              <tr><td class="editLabel">Password</td><td class="editField"><input type="password" name="password" /></td></tr>
              <tr><td class="editLabel">Keep me logged in</td><td class="editField"><input type="checkbox" name="remme" value="true" /></td></tr>
            </table>
            <input type="hidden" name="logintype" value="admin" />
            <input type="submit" value="Log In" />
          </form>
          <?php
          } else {
            if ($page === "home") {
              require("home.php");
            } else if ($page === "inventory") {
              require("inventory.php");
            } else if ($page === "orders") {
              require("orders.php");
            } else if ($page === "users") {
              require("users.php");
            } else if ($page === "upload") {
              require("upload.php");
            } else if ($page === "settings") {
              require("settings.php");
            } else {
              require("error.php");
            }
          }
          ?>
          <br />
          <br />
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <div id="footer">&copy; <?php echo date("Y"); ?> <a href="<?php echo BASE_URL; ?>"><?php echo COMPANY_NAME; ?></a>, All Rights Reserved.</div>
        </td>
      </tr>
    </table>
    <br />
    <br />
    <br />
	</body>
</html>
