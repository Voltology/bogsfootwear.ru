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

require("inc/header.php");
?>
      <span id="bannerimage"><img src="/img/about-us.jpg" width="998" height="225" /></span>
      <div id="maincontent">
        <div id="contentarea2">
          <span id="content2">
        <div>
      <div>
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
      </div>
    </div>

    </div>
    </div>

    <div class="clear"></div>

    <div id="footer"><span style="color: #ffffff; font-size: 6pt; margin: 230px; line-height: 18pt;">&copy; Copyright 2012. Global Supply Management Inc. All Rights Reserved</span></div>

    <div class="clear"></div>

    </div>
    &nbsp;<br/>
    &nbsp;<br/>

    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-33670595-1']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>
  </body>
</html>
<?php
require("inc/footer.php");
?>
