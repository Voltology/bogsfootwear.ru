<?php
require(".local.inc.php");
require(LIB_PATH . "Fulfillment.class.php");
$items = $cart->getCart();
$address = $user->getShippingAddressById($_SESSION['addressid']);
$data['Subtotal'] = 200;
$data['GrandTotal'] = 200;
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
$data['ShipToLastName'] = '';
$data['ShipToFirstName'] = $address['recipient'];
$data['ShipToAddressLine1'] = $address['address1'];
$data['ShipToAddressLine2'] = $address['address2'];
$data['ShipToAddressCity'] = $address['district'];
$data['ShipToAddressState'] = $address['province'];
//$data['ShipToAddressCountry'] = $address['country'];
$data['ShipToAddressCountry'] = "RU";
$data['ShipToAddressPostalCode'] = $address['postal_code'];
$data['ShipToPhone'] = '';
$data['ShipToPhoneExt'] = '';
$data['ShipToPhoneFax'] = '';
$data['ShipToCustomerNotes'] = '';
$data['ReferenceID'] = '';
$data['ShipMethodDesc'] = 'Standard';
$data['Items'] = array();

foreach ($items as $ordereditem) {
 // $item['SKU'] = $ordereditem['sku'];
  $item['SKU'] = '123-456';
  $item['QtyOrdered'] = $ordereditem['quantity'];
  $item['EachPrice'] = $ordereditem['price'];
  array_push($data['Items'], $item);
}
$data = json_encode($data);
echo Fulfillment::createOrder($data);
//header("Location: /complete/");
?>
