<?php
require(".local.inc.php");
if ($user->checkPassword($_POST['email'], md5($_POST['password']))) {
  setcookie("user", $_POST['email']);
  setcookie("password", md5($_POST['password']));
  if ($_POST['logintype'] === "admin") {
    header("Location: /admin/");
  } else {
    header("Location: /catalog");
  }
} else {
  if ($_POST['logintype'] === "admin") {
    header("Location: /admin/?fail=true");
  } else {
    header("Location: /login?fail=true");
  }
}
?>
