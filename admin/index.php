<?php
require("../.local.inc.php");
$page = $_GET['p'] ? $_GET['p'] : "home";
$subpage = $_GET['s'] ? $_GET['s'] : "";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title><?php echo COMPANY_NAME; ?> &raquo; Admin</title>
    <link rel="stylesheet" href="admin.css"/>
    <script type="text/javascript" src="/js/main.js"></script>
  </head>
  <body>
    <table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2" valign="middle">
          <div class="headerlogo">
            <a href="http://www.bogsfootwear.ru/"><img src="../img/admin/<?php echo ADMIN_LOGO; ?>" /></a><div class="headertext">Administration Area</div>
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
            <?php if ($page === "inventory") { ?>
            <div class="<?php if ($subpage === "modify") { ?>active<?php } ?>submenuitem"><a href="?p=inventory&s=modify">Modify</a></div>
            <div class="<?php if ($subpage === "upload") { ?>active<?php } ?>submenuitem"><a href="?p=inventory&s=upload">Upload</a></div>
            <? } ?>
            <div class="<?php if ($page === "users") { ?>active<?php } ?>menuitem"><a href="?p=users">Users</a></div>
            <div class="<?php if ($page === "settings") { ?>active<?php } ?>menuitem"><a href="?p=settings">Settings</a></div>
            <br />
            <div class="logout"><a href="../logout.php?admin=true">Log Out</a></div>
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
          <form method="post" action="../login.php">
            <table class="editTable">
              <tr><td class="editLabel">Username</td><td class="editField"><input type="text" name="email" value="" /></td></tr>
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
            } else if ($page === "users") {
              require("users.php");
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
