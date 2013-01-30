<?php
require(".local.inc.php");
require(LIB_PATH . "Fulfillment.class.php");
$data = '{"Subtotal":200.0000, "GrandTotal":220.0000, "ShippingTotal":20.0000, "HandlingTotal":0.0000, "CouponsTotal":0.0000, "TaxTotal": 0.0000, "CustomerEmail":"test@test.com", "BillToLastName":"Doe", "BillToFirstName":"John", "BillToAddressLine1":"123 Main Street", "BillToAddressLine2":null, "BillToAddressCity":"Chicago", "BillToAddressState":"IL", "BillToAddressCountry":"US", "BillToAddressPostalCode":"60631", "BillToPhone":"800-555-5555", "BillToPhoneExt":"340", "BillToFax":null, "BillToCustomerNotes":"Leave behind side door", "ShipToLastName":"Doe", "ShipToFirstName":"John", "ShipToAddressLine1":"123 Main Street", "ShipToAddressLine2":"Unit 1", "ShipToAddressCity":"Chicago", "ShipToAddressState":"IL", "ShipToAddressCountry":"US", "ShipToAddressPostalCode":"60656", "ShipToPhone":null, "ShipToPhoneExt":null, "ShipToFax":null, "ShipToCustomerNotes":null, "ReferenceID":"A38274", "ShipMethodDesc": "Standard", "Items":[{"SKU":"HM123451", "QtyOrdered":1, "EachPrice":100.0000},{"SKU":"123-456", "QtyOrdered":1, "EachPrice":100.0000}]}';
Fulfillment::createOrder($data);
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
