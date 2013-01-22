<?php
require(".local.inc.php");
$user->logout();
setcookie("email", "");
setcookie("password", "");
unset($_SESSION['cart']);
unset($_SESSION['user']);
header("Location: /");
?>
