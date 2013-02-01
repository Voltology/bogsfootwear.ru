<?php
require(".local.inc.php");
require(LIB_PATH . "Fulfillment.class.php");
$data['Subtotal'] = 200;
$data['GrandTotal'] = 200;
$data['ShippingTotal'] = 0;
$data['HandlingTotal'] = 0;
$data['CouponsTotal'] = 0;
$data['TaxTotal'] = 0;
$data['CustomerEmail'] = '';
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
$data['ShipToFirstName'] = '';
$data['ShipToAddressLine1'] = '';
$data['ShipToAddressLine2'] = '';
$data['ShipToAddressCity'] = '';
$data['ShipToAddressState'] = '';
$data['ShipToAddressCountry'] = '';
$data['ShipToAddressPostalCode'] = '';
$data['ShipToPhone'] = '';
$data['ShipToPhoneExt'] = '';
$data['ShipToPhoneFax'] = '';
$data['ShipToCustomerNotes'] = '';
$data['ReferenceID'] = '';
$data['ShipMethodDesc'] = 'Standard';
$data['Items'] = array();

$item['SKU'] = '123-456';
$item['QtyOrdered'] = '2';
$item['EachPrice'] = '50';
array_push($data['Items'], $item);
$data = json_encode($data);

Fulfillment::createOrder($data);
header("Location: /complete/");
?>
