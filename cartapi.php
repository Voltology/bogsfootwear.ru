<?php
header('Content-type: application/json');
include('.local.inc.php');
//if ($_SERVER['HTTP_HOST'] === PERMISSIONED_SERVER && $_SERVER['REQUEST_METHOD'] == "POST") {
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    session_start();
    $json['errors'] = array();
    $json['success'] = "true";
} else {
    $json['success'] = "false";
    array_push($json['errors'], "Not Authorized");
}
echo json_encode($json);
?>
