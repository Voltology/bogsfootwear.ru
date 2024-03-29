<?php
class Fulfillment {
  public static function call($method, $action, $data = null) {
    $headers = array();
    if ($action == "migratecreate") {
      $headers[] = "storeToken: " . PROD_STORE_TOKEN;
      $headers[] = "clientToken: " . PROD_CLIENT_TOKEN;
      $headers[] = "Content-Type: application/json; charset=UTF-8";
      $headers[] = "Accept: application/json";
      $ch = curl_init(PROD_STORE_URL . "product/create");
    } else if ($action == "migrateupdate") {
      $headers[] = "storeToken: " . PROD_STORE_TOKEN;
      $headers[] = "clientToken: " . PROD_CLIENT_TOKEN;
      $headers[] = "Content-Type: application/json; charset=UTF-8";
      $headers[] = "Accept: application/json";
      $ch = curl_init(PROD_STORE_URL . "product/update");
    } else {
      $headers[] = "storeToken: " . STORE_TOKEN;
      $headers[] = "clientToken: " . CLIENT_TOKEN;
      $headers[] = "Content-Type: application/json; charset=UTF-8";
      $headers[] = "Accept: application/json";
      $ch = curl_init(STORE_URL . $action);
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    if ($method === "post") {
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    } else if ($method === "put") {
      curl_setopt($ch, CURLOPT_PUT, TRUE);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    } else if ($method === "delete") {
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);

    return $response;
  }

  public function cancelOrder($id) {
    return self::call("delete", "order/cancel/" . $id);
  }

  public function createOrder($data) {
    return self::call("post", "order/create", $data);
  }

  public function createProduct($data) {
    return self::call("post", "product/create", $data);
  }

  public function deleteProduct($sku) {
    return self::call("delete", "product/delete/" . $sku);
  }

  public function getOrder($id) {
    return self::call("get", "order/get/" . $id);
  }

  public function getProduct($sku) {
    return self::call("get", "product/get/" . $sku);
  }

  public function migrate($data) {
    self::call("post", "migratecreate", $data);
    self::call("post", "migrateupdate", $data);
    return true;
  }

  public function updateOrder($data) {
    return self::call("put", "order/update", $data);
  }

  public function updateProduct($data) {
    return self::call("put", "product/update", $data);
  }
}
?>
