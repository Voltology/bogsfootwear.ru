<?php
require(".local.inc.php");
include("inc/header.php");

$gender = $_GET['gender'];
$group = $_GET['group'];
?>
    <span id="bannerimage"><img src="/img/womens-plimsoll.jpg" width="998" height="225" /></span>
    <div class="clear"></div>
      <div id="maincontent">
        <div id="subnav">
          <span id="navcontent">
            <?php
            $list = $cart->getGenderGroupList();
            foreach ($list as $key => $value) {
              echo "<br /><a href=\"/catalog/" . $key . "\"><b>" . strToUpper(t($key)) . " " . t("Collection") . "</b></a><br/>";
              foreach ($list[$key] as $groupname) {
                echo "<a href=\"/catalog/" . $key . "/" . $groupname . "\">" . ucwords($groupname) . "</a><br/>";
              }
            }
            ?>
            <br/>
            <br/>
            &nbsp;&nbsp;&nbsp;&nbsp;Пересчет валют:  1$ = 32 руб.<br/>
            &nbsp;&nbsp;&nbsp;&nbsp;Все цены включают НДС.
          </span>
        </div>
        <div id="contentarea">
          <div id="content">
            <span id="breadcrumb"><a href="/"><?php echo t("Home"); ?></a> | <a href="/catalog/<?php echo $gender; ?>/"><?php echo t($gender); ?></a> | <?php echo t($gender); ?> <?php echo t($group); ?></span>
            <h2><?php echo t($gender); ?> <?php echo ucwords(t($group)); ?></h2>
            <div id="page">
              <div id="container">
                <div id="gallery" class="content">
                  <div class="slideshow-container">
                    <div id="loading" class="loader"></div>
                    <div id="slideshow" class="slideshow"></div>
                  </div>
                  <div id="caption" class="caption-container"></div>
                </div>
                <div id="thumbs" class="navigation">
                  <ul class="thumbs noscript">
                  <?php
                  $items = $cart->getItemsByGenderAndGroup($gender, $group);
                  foreach ($items as $item) {
                  ?>
                    <li>
                      <form id="form-<?php echo $item['id']; ?>">
                        <a class="thumb" href="/img/catalog/womens-collections/womens-plimsoll/71141-300.jpg" alt="71141-300" /><img src="/img/catalog/womens-collections/womens-plimsoll/thumbs/71141-300.jpg" alt="71141-300" /></a>
                        <div class="caption">
                          <div class="image-title">
                          </div>
                          <div class="image-desc">
                            <table class="image-desc" width="300">
                              <tr>
                                <td align="center" colspan="2">
                                  <ul id="multiview-images">
                                    <li class="thumb"><img src="/img/catalog/71055-202.jpg" alt="71141-300" onclick="catalog.multiview.load('/img/catalog/71055-202.jpg')" /></li>
                                    <li class="thumb"><img src="/img/catalog/71063-001.jpg" alt="71141-300" onclick="catalog.multiview.load('/img/catalog/71063-001.jpg')" /></li>
                                    <li class="thumb"><img src="/img/catalog/71055-202.jpg" alt="71141-300" onclick="catalog.multiview.load('/img/catalog/71055-202.jpg')" /></li>
                                    <li class="thumb"><img src="/img/catalog/71063-001.jpg" alt="71141-300" onclick="catalog.multiview.load('/img/catalog/71063-001.jpg')" /></li>
                                  </ul>
                                </td>
                              </tr>
                              <tr>
                                <td class="product-desc">
                                  <b><?php echo $item['name']; ?></b><br />
                                  <?php echo $item['color']; ?> <i>(<?php echo $item['sku']; ?>)</i><br/>
                                  (зеленый)<br/>
                                  <b>MSRP</b> $<?php echo number_format($item['price'], 2); ?> USD</div>
                                </td>
                                <td valign="top">
                                  <select id="size-<?php echo $item['id']; ?>">
                                    <option value="null">РАЗМЕРЫ</option>
                                    <?php
                                    for ($i = 1; $i <= 22; $i++) {
                                      if ($item['size_' . $i] > 5) {
                                        echo "<option value=\"" . $i . "\">" .$i ."</option>";
                                      }
                                    }
                                    ?>
                                  </select>
                                </td>
                              </tr>
                              </table>
                            <div class="features">100% водонепроницаемость / Больше изящества с удобной посадкой / Надежное резиновое покрытие ручной формовки поверх эластичного во всех направлениях голенища / 7 мм водонепроницаемого материала Neo-Tech™ / Влагоотводящее покрытие Max-Wick™ дарит сухость и комфорт / Не оставляющая следов и самоочищающаяся подошва / Антимикробная стелька Aegis с защитой от запаха / Легко надеваются при помощи ручек / Комфорт гарантирован от умеренных температур до -40°С</div>
                            <input type="button" value="Add To Cart" onclick="cart.add('<?php echo $item['id']; ?>', '<?php echo $item['sku']; ?>')" />
                          </div>
                      </form>
                    </li>
                  <?php
                  }
                  ?>
                </ul>
              </div>
            </div>
          </div>
          <a style="font-size: 9pt; line-height: 31pt; text-decoration: underline;" href="javascript:mdlMusic()">&gt; <?php echo t("Click here for shoe sizing information"); ?></a>
        </div>
      </div>
      <script type="text/javascript" src="/js/addfunctions.js"></script>
<?php
$sizingguide = true;
include("inc/footer.php");
?>
