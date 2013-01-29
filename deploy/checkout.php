<?php
require(".local.inc.php");

if (PAYPAL_ENV == "production") {
	$API_Endpoint = "https://api-3t.paypal.com/nvp";
	$PAYPAL_URL = "https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=";
} else {
	$API_Endpoint = "https://api-3t.sandbox.paypal.com/nvp";
	$PAYPAL_URL = "https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=";
}

$_SESSION["currencyCodeType"] = "USD";
$_SESSION["PaymentType"] = "Sale";
//$total = $cart->getSubTotal();
$total = 100;

$nvpstr = "&PAYMENTREQUEST_0_AMT=" . $total;
$nvpstr .= "&PAYMENTREQUEST_0_PAYMENTACTION=Sale";
$nvpstr .= "&RETURNURL=" . PAYPAL_RETURN_URL;
$nvpstr .= "&CANCELURL=" . PAYPAL_CANCEL_URL;
$nvpstr .= "&PAYMENTREQUEST_0_CURRENCYCODE=USD";
$nvpstr .= "&SOLUTIONTYPE=Sole";
$nvpstr .= "&LANDINGPAGE=Billing";


$resArray = hash_call("SetExpressCheckout", $nvpstr);
$ack = strtoupper($resArray["ACK"]);

if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
	$token = urldecode($resArray["TOKEN"]);
	$_SESSION['TOKEN']=$token;
}

$ack = strtoupper($resArray["ACK"]);
if ($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING") {
	$payPalURL = $PAYPAL_URL . $token;
	header("Location: ".$payPalURL);
} else {
  echo "There was an error connecting to PayPal.  Please try again later.";
  //Errors
	//$ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
	//$ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
	//$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
	//$ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
	//echo "SetExpressCheckout API call failed. ";
	//echo "Detailed Error Message: " . $ErrorLongMsg;
	//echo "Short Error Message: " . $ErrorShortMsg;
	//echo "Error Code: " . $ErrorCode;
	//echo "Error Severity Code: " . $ErrorSeverityCode;
}

function hash_call($methodName,$nvpStr) {
  global $API_Endpoint, $version, $API_UserName, $API_Password, $API_Signature;
  global $gv_ApiErrorURL;

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,$API_Endpoint);
  curl_setopt($ch, CURLOPT_VERBOSE, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch, CURLOPT_POST, 1);

  if ($USE_PROXY) {
    curl_setopt ($ch, CURLOPT_PROXY, $PROXY_HOST. ":" . $PROXY_PORT);
  }

  $nvpreq="METHOD=" . urlencode($methodName) . "&VERSION=" . urlencode(PAYPAL_VER) . "&PWD=" . urlencode(PAYPAL_PASS) . "&USER=" . urlencode(PAYPAL_USER) . "&SIGNATURE=" . urlencode(PAYPAL_SIG) . $nvpStr . "&BUTTONSOURCE=" . urlencode($sBNCode);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

  $response = curl_exec($ch);
  $nvpResArray = deformatNVP($response);
  $nvpReqArray = deformatNVP($nvpreq);
  $_SESSION['nvpReqArray'] = $nvpReqArray;

  if (curl_errno($ch)) {
      $_SESSION['curl_error_no'] = curl_errno($ch) ;
      $_SESSION['curl_error_msg'] = curl_error($ch);
  } else {
      curl_close($ch);
  }

  return $nvpResArray;
}

function deformatNVP($nvpstr) {
  $intial = 0;
  $nvpArray = array();

  while (strlen($nvpstr)) {
    $keypos = strpos($nvpstr, '=');
    $valuepos = strpos($nvpstr, '&') ? strpos($nvpstr,'&') : strlen($nvpstr);
    $keyval = substr($nvpstr, $intial, $keypos);
    $valval = substr($nvpstr, $keypos + 1, $valuepos - $keypos-1);
    $nvpArray[urldecode($keyval)] = urldecode( $valval);
    $nvpstr = substr($nvpstr, $valuepos + 1, strlen($nvpstr));
  }
  return $nvpArray;
}
?>
