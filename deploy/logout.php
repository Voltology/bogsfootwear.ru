<?php
require(".local.inc.php");
$user->logout();
setcookie("email", "");
setcookie("password", "");
unset($_SESSION['cart']);
unset($_SESSION['user']);
if ($_GET['admin'] === "true") {
  header("Location: /admin");
} else {
  header("Location: /");
}
?>
