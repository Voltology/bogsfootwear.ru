<?php
class PayPal {
  private $_currency = "USD";
  private $_paymenttype = "Sale";
  private $_method = "SetExpressCheckout";

  public function connect($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, PAYPAL_API);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POST, 1);

    $req = "METHOD=" . urlencode($this->_method);
    $req .= "&VERSION=" . urlencode(PAYPAL_VER);
    $req .= "&PWD=" . urlencode(PAYPAL_PASS);
    $req .= "&USER=" . urlencode(PAYPAL_USER);
    $req .= "&SIGNATURE=" . urlencode(PAYPAL_SIG);
    $req .= "&BUTTONSOURCE=" . urlencode($sBNCode);
    $req .= $url;
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);

    $response = curl_exec($ch);
    $nvpresponse = $this->process($response);
    $nvprequest = $this->process($req);
    $_SESSION['nvprequest'] = $nvprequest;

    if (curl_errno($ch)) {
        $_SESSION['curl_error_no'] = curl_errno($ch) ;
        $_SESSION['curl_error_msg'] = curl_error($ch);
    } else {
        curl_close($ch);
    }

    return $nvpresponse;
  }

  public function getCurrency() {
    return $this->_currency;
  }

  public function getPaymentType() {
    return $this->_paymenttype;
  }

  public function process($response) {
    $intial = 0;
    $nvp = array();

    while (strlen($response)) {
      $keypos = strpos($response, '=');
      $valuepos = strpos($response, '&') ? strpos($response,'&') : strlen($response);
      $keyval = substr($response, $intial, $keypos);
      $valval = substr($response, $keypos + 1, $valuepos - $keypos-1);
      $nvp[urldecode($keyval)] = urldecode( $valval);
      $response = substr($response, $valuepos + 1, strlen($response));
    }
    return $nvp;
  }

  public function setCurrency($currency) {
    $this->_currency = $currency;
  }

  public function setPaymentType($paymenttype) {
    $this->_paymenttype = $paymenttype;
  }
}
