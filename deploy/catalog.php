<?php
require(".local.inc.php");
include("inc/header.php");

$gender = $_GET['gender'];
$group = $_GET['group'] ? $_GET['group'] : null;
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
            <span id="breadcrumb"><a href="/"><?php echo t("Home"); ?></a> | <a href="/catalog/<?php echo $gender; ?>/"><?php echo ucwords(t($gender)); ?></a> <?php if ($group) { ?>| <?php echo ucwords(t($group)); } ?></span>
            <h2><?php echo ucwords(t($group)); ?></h2>
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
                  if ($group) {
                    $items = $cart->getItemsByGenderAndGroup($gender, $group);
                  } else {
                    $items = $cart->getItemsByGender($gender);
                  }
                  foreach ($items as $item) {
                  ?>
                    <li>
                      <form id="form-<?php echo $item['id']; ?>">
                        <a class="thumb" href="/img/catalog/<?php echo $item['sku']; ?>/1.jpg" alt="<?php echo $item['sku']; ?>" /><img src="/img/catalog/<?php echo $item['sku']; ?>/1-thumb.jpg" alt="<?php echo $item['sku']; ?>" /></a>
                        <div class="caption">
                          <?php if ($user->getRole() == 2) { echo "<span style=\"font-size: 12px; float: right;\"><a href=\"" . ADMIN_BASE_URL . "?p=inventory&a=edit&id=" . $item['id'] . "\">Edit Product</a></span>"; } ?>
                          <div class="image-title">
                          </div>
                          <div class="image-desc">
                            <table class="image-desc" width="300">
                              <tr>
                                <td align="center" colspan="2">
                                  <ul id="multiview-images">
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                      if (file_exists("img/catalog/" . $item['sku'] . "/" . $i . "-thumb.jpg")) {
                                      ?>
                                      <li class="thumb"><img src="/img/catalog/<?php echo $item['sku']; ?>/<?php echo $i; ?>-thumb.jpg" alt="71141-300" onclick="catalog.multiview.load('/img/catalog/<?php echo $item['sku']; ?>/<?php echo $i; ?>.jpg')" /></li>
                                      <?php
                                      }
                                    }
                                    ?>
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
                                      if ($item['size_' . $i] > STOCK_THRESHOLD) {
                                        echo "<option value=\"" . $i . "\">" .$i ."</option>";
                                      }
                                    }
                                    ?>
                                  </select>
                                </td>
                              </tr>
                              </table>
                            <div class="features">100% водонепроницаемость / Больше изящества с удобной посадкой / Надежное резиновое покрытие ручной формовки поверх эластичного во всех направлениях голенища / 7 мм водонепроницаемого материала Neo-Tech™ / Влагоотводящее покрытие Max-Wick™ дарит сухость и комфорт / Не оставляющая следов и самоочищающаяся подошва / Антимикробная стелька Aegis с защитой от запаха / Легко надеваются при помощи ручек / Комфорт гарантирован от умеренных температур до -40°С</div>
                            <input type="button" value="<?php echo t("Add To Cart"); ?>" onclick="cart.add('<?php echo $item['id']; ?>', '<?php echo $item['sku']; ?>')" />
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
