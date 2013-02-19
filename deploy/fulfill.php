<?php
require(".local.inc.php");
require(LIB_PATH . "Fulfillment.class.php");
$paypaltoken = $_GET['token'];
if ($paypaltoken == $cart->getPayPalToken()) {
  $address = $user->getShippingAddressById($_SESSION['addressid']);
  $data['Subtotal'] = $cart->getSubTotal();
  $data['GrandTotal'] = $cart->getSubTotal();
  $data['ShippingTotal'] = 0;
  $data['HandlingTotal'] = 0;
  $data['CouponsTotal'] = 0;
  $data['TaxTotal'] = 0;
  $data['CustomerEmail'] = $user->getEmail();
  $data['BillToLastName'] = '';
  $data['BillToFirstName'] = '';
  $data['BillToAddressLine1'] = '';
  $data['BillToAddressLine2'] = '';
  $data['BillToAddressCity'] = '';
  $data['BillToAddressState'] = '';
  $data['BillToAddressCountry'] = '';
  $data['BillToAddressPostalCode'] = '';
  $data['BillToPhone'] = '';
  $data['BillToPhoneExt'] = '';
  $data['BillToPhoneFax'] = '';
  $data['BillToCustomerNotes'] = '';
  $data['ShipToFirstName'] = $address['firstname'];
  $data['ShipToLastName'] = $address['lastname'];
  $data['ShipToAddressLine1'] = $address['address1'];
  $data['ShipToAddressLine2'] = $address['address2'];
  $data['ShipToAddressCity'] = $address['district'];
  $data['ShipToAddressState'] = $address['province'];
  $data['ShipToAddressPostalCode'] = $address['postal_code'];
  $data['ShipToAddressCountry'] = $address['country'];
  $data['ShipToPhone'] = '';
  $data['ShipToPhoneExt'] = '';
  $data['ShipToPhoneFax'] = '';
  $data['ShipToCustomerNotes'] = '';
  $data['ReferenceID'] = '';
  $data['ShipMethodDesc'] = 'Standard';
  $data['Items'] = array();

  $items = $cart->getCart();
  foreach ($items as $ordereditem) {
    $item['SKU'] = $ordereditem['sku'];
    $item['QtyOrdered'] = $ordereditem['quantity'];
    $item['EachPrice'] = number_format($ordereditem['price'], 2);
    $item['ProductOption'] = "Color: " . ucwords($ordereditem['color']) . ", Size: " . $ordereditem['size'];
    array_push($data['Items'], $item);
  }

  $data = json_encode($data);
  $response = json_decode(Fulfillment::createOrder($data), true);
  $_SESSION['fulfillment_response'] = $response;
  if ($response['Status'] == 1) {
    $cart->setCompletedOrder($user->getId(), $_SESSION['addressid'], $response['Order']);
    $cart->clearCart();
    header("Location: /complete/");
  } else {
    $cart->setCompletedOrder($user->getId(), $_SESSION['addressid'], $response['Order']);
    $cart->clearCart();
    header("Location: /error/?type=status");
  }
} else {
  header("Location: /error/?type=token");
}
?>
