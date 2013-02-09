<?php
require(".local.inc.php");
require(LIB_PATH . "PayPal.class.php");
$paypal = new PayPal();

$_SESSION["currencyCodeType"] = $paypal->getCurrency();
$_SESSION["PaymentType"] = $paypal->getPaymentType();

$res = $cart->checkout($paypal);
$ack = strtolower($res["ACK"]);

if ($ack == "success" || $ack == "successwithwarning") {
	$token = urldecode($res["TOKEN"]);
  $cart->setPayPalToken($token);
  $cart->setPendingOrder($user->getId(), $_SESSION['addressid']);
	$_SESSION['token'] = $token;
	header("Location: ". PAYPAL_URL . $token);
} else {
  include('inc/header.php');
  echo "There was an error connecting to PayPal.  Please try again later.";
  include('inc/footer.php');
}
?>
