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
    $json['itemcount'] = $cart->getItemCount();
  } else if ($action === "clear") {
    $cart->clearCart();
  } else if ($action === "remove") {
    $cart->removeItem($_POST['id']);
    $json['subtotal'] = $cart->getSubTotal();
    $json['itemcount'] = $cart->getItemCount();
  } else if ($action === "update") {
    $cart->updateQuantity($_POST['id'], $_POST['quantity']);
    $json['totals'] = $cart->getItemTotals();
    $json['itemcount'] = $cart->getItemCount();
  }
} else {
  $json['success'] = "false";
  array_push($json['errors'], "Not Authorized");
}
echo json_encode($json);
?>
