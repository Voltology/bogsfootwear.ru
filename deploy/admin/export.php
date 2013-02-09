<?php
require("../.local.inc.php");
require(LIB_PATH . "/Admin.class.php");

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=users.csv");
header("Pragma: no-cache");
header("Expires: 0");

Admin::exportUsers();
?>
