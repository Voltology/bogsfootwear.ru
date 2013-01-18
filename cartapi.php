<?php
header('Content-type: application/json');
include('.local.inc.php');
//if ($_SERVER['HTTP_HOST'] === PERMISSIONED_SERVER && $_SERVER['REQUEST_METHOD'] == "POST") {
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $json['errors'] = array();
  $json['success'] = "true";
  $action = $_POST['a'];
  if ($action === "add") {
    $cart->addItem($_POST['id']);
  } else if ($action === "clear") {
    $cart->clearCart();
  } else if ($action === "remove") {
    $cart->removeItem($_POST['id']);
  }
} else {
  $json['success'] = "false";
  array_push($json['errors'], "Not Authorized");
}
echo json_encode($json);
?>
