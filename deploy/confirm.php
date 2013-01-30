<?php
require(".local.inc.php");
$ch = curl_init(STORE_URL . "/order/create");
$body = '';

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

include("inc/header.php");
?>
      <span id="bannerimage"><img src="/img/about-us.jpg" width="998" height="225" /></span>
      <div id="maincontent">
        <div id="contentarea2">
          <span id="content2">
            <div id="register">
              <table border="0" width="500">
                <tr>
                  <td>
                    <fieldset>
                      <legend>&raquo; Order Complete</legend>
                        <table cellpadding="2" cellspacing="0" border="0" class="register-table">
                          <tr>
                            <td>Thank you for your purchase!</td>
                          </tr>
                        </table>
                    </fieldset>
                  </td>
                </tr>
              </table>
            </div>
          </span>
        </div>
      </div>
<?php
include("inc/footer.php");
?>
