<?php
require(".local.inc.php");
require(LIB_PATH . "PayPal.class.php");
$paypal = new PayPal();

$_SESSION["currencyCodeType"] = $paypal->getCurrency();
$_SESSION["PaymentType"] = $paypal->getPaymentType();

$url = "&PAYMENTREQUEST_0_AMT=" . $cart->getSubTotal();
$url .= "&PAYMENTREQUEST_0_PAYMENTACTION=" . $paypal->getPaymentType();
$url .= "&RETURNURL=" . PAYPAL_RETURN_URL;
$url .= "&CANCELURL=" . PAYPAL_CANCEL_URL;
$url .= "&PAYMENTREQUEST_0_CURRENCYCODE=". $paypal->getCurrency();
$url .= "&SOLUTIONTYPE=Sole";
$url .= "&LANDINGPAGE=Billing";

$res = $paypal->connect($url);
$ack = strtolower($res["ACK"]);

if ($ack == "success" || $ack == "successwithwarning") {
	$token = urldecode($res["TOKEN"]);
	$_SESSION['token'] = $token;
	header("Location: ". PAYPAL_URL . $token);
} else {
  include('inc/header.php');
  echo "There was an error connecting to PayPal.  Please try again later.";
  include('inc/footer.php');
}
?>
