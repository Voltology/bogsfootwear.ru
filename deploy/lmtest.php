<?php
require(".local.inc.php");

$ch = curl_init(STORE_URL . "product/create");
$body = '[{"SKU":"HM123451","Name":"My Product 1","UPC":"001821017017","Summary":"My Product Description","LowStockThreshold": 100}]';

$headers = array();
$headers[] = "storeToken: " . STORE_TOKEN;
$headers[] = "clientToken: " . CLIENT_TOKEN;

$headers[] = "Content-Type: application/json; charset=UTF-8";
$headers[] = "Accept: application/json";

curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
//curl_setopt($ch, CURLOPT_PUT, TRUE);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_ENCODING, "");
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);

$data = curl_exec($ch);

echo $data;
?>
