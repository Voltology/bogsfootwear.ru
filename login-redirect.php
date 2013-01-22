<?php
require(".local.inc.php");
if ($user->checkPassword($_POST['email'], md5($_POST['password']))) {
  setcookie("user", $_POST['email']);
  setcookie("password", md5($_POST['password']));
  header("Location: /catalog");
} else {
  header("Location: /login?fail=true");
}
?>
