<?php
require(".local.inc.php");
$ref = $_POST['ref'] ? $_POST['ref'] : $_SERVER['HTTP_REFERER'];
if ($user->isLoggedIn()) {
  header("Location: /");
} else if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $errors = $user->validate($_POST['email'], $_POST['password1'], $_POST['password2'], $_POST['firstname'], $_POST['lastname']);
  if (count($errors) == 0) {
    $user->register($_POST['email'], md5($_POST['password1']), $_POST['firstname'], $_POST['lastname']);
    setcookie("email", $_POST['email']);
    setcookie("password", md5($_POST['password1']));
  }
}
include("inc/header.php");
?>
      <span id="bannerimage"><img src="/img/about-us.jpg" width="998" height="225" /></span>
      <div id="maincontent">
        <div id="contentarea2">
        <div id="register">
          <table border="0" width="500">
            <tr>
              <td>
              <?php
              if ($_SERVER['REQUEST_METHOD'] == "POST" && count($errors) == 0) {
              ?>
                <fieldset>
                  <legend>&raquo; Registration Complete</legend>
                    <table cellpadding="2" cellspacing="0" border="0" class="register-table">
                      <tr>
                        <td>Thank you for registering!  You will now be able to view your account and order history.</td>
                      </tr>
                    </table>
                </fieldset>
              <?php
              } else {
              ?>
                <fieldset>
                  <legend>&raquo; Register for an Account</legend>
                  <form action="/register" method="post">
                    <table cellpadding="2" cellspacing="0" border="0" class="register-table">
                      <tr>
                        <td colspan="2">Welcome! Complete the form below to register for your free account.</td>
                      </tr>
                      <?php
                      if (count($errors) > 0) {
                        echo "<tr><td colspan=\"2\" align=\"center\" class=\"register-errors\">";
                        foreach ($errors as $error) {
                          echo $error . "<br />";
                        }
                        echo "</td></tr>";
                      }
                      ?>
                      <tr>
                        <td width="120">First Name</td><td><input type="text" name="firstname" value="<?php echo $_POST['firstname']; ?>" /></td>
                      </tr>
                      <tr>
                        <td width="120">Last Name</td><td><input type="text" name="lastname" value="<?php echo $_POST['lastname']; ?>" /></td>
                      </tr>
                      <tr>
                        <td width="120">Email</td><td><input type="text" name="email" value="<?php echo $_POST['email']; ?>" /></td>
                      </tr>
                      <tr>
                        <td width="120">Password</td><td><input type="password" name="password1" /></td>
                      </tr>
                      <tr>
                        <td width="120">Re-enter Password</td><td><input type="password" name="password2" /></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td><td><input type="submit" value="Register" /></td>
                      </tr>
                    </table>
                    <input type="hidden" name="ref" value="<?php echo $ref; ?>" />
                  </form>
                </fieldset>
              <?php
              }
              ?>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>

<?php
include("inc/footer.php");
?>
