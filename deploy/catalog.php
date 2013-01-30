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
            <a href="/catalog/womens/plimsoll/"><b>ЖЕНСКИЕ коллекции</b></a><br/>
            <a href="/catalog/womens/plimsoll/">ЖЕНСКИЕ Plimsoll</a><br/>
            <a href="/catalog/womens/classic/">ЖЕНСКИЕ Classic</a><br/>
            <a href="/catalog/womens/market/">ЖЕНСКИЕ Market</a><br/>
            <a href="/catalog/womens/bridgetown/">ЖЕНСКИЕ Bridgetown</a><br/>
            <a href="/catalog/womens/yaletown/">ЖЕНСКИЕ Yaletown</a><br/>
            <!--<a href="/catalog/womens-collections/womens-chicago/">ЖЕНСКИЕ Chicago</a><br/>-->
            <br/>
            <a href="/catalog/mens/classic/"><b>МУЖСКИЕ коллекции</b></a><br/>
            <a href="/catalog/mens/classic/">МУЖСКИЕ Classic</a><br/>
            <a href="/catalog/mens/bridgetown/">МУЖСКИЕ Bridgetown</a><br/>
            <a href="/catalog/mens/industrial/">МУЖСКИЕ Industrial</a><br/>
            <a href="/catalog/mens/hunting/">МУЖСКИЕ Hunting</a><br/>
            <br/>
            <a href="/catalog/kids/classic/"><b>ДЕТСКИЕ коллекции</b></a><br/>
            <a href="/catalog/kids/classic/">ДЕТСКИЕ Classic</a><br/>
            <a href="/catalog/kids/rainboot/">ДЕТСКИЕ Rainboot</a><br/>
            <a href="/catalog/kids/hunting/">ДЕТСКИЕ Hunting</a><br/>
            <a href="/catalog/kids/baby-bogs/">ДЕТСКИЕ Baby Bogs</a><br/>
            <br/>
            <br/>
            &nbsp;&nbsp;&nbsp;&nbsp;Пересчет валют:  1$ = 32 руб.<br/>
            &nbsp;&nbsp;&nbsp;&nbsp;Все цены включают НДС.
          </span>
        </div>
        <div id="contentarea">
          <div id="content">
            <span id="breadcrumb"><a href="/">Home</a> | <a href="/catalog/womens-collections/womens-plimsoll/">КАТАЛОГ</a> | ЖЕНСКИЕ коллекции</span>
            <h2>ЖЕНСКИЕ Plimsoll</h2>
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
                    <a class="thumb" href="/img/catalog/womens-collections/womens-plimsoll/71141-300.jpg" alt="71141-300" /><img src="/img/catalog/womens-collections/womens-plimsoll/thumbs/71141-300.jpg" alt="71141-300" /></a>
                    <div class="caption">
                    <div class="image-title">
                      <b><?php echo $row['name']; ?></b>
                      <select>
                        <option>РАЗМЕРЫ</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                      </select>
                    </div>
                    <input type="button" value="Add To Cart" onclick="cart.add('<?php echo $item['id']; ?>')" />
                    <div class="image-desc"><?php echo $item['color']; ?> <i>(<?php echo $item['sku']; ?>)</i><br/>
                    (зеленый)<br/>
                    <b>MSRP</b> $<?php number_format($item['price']); ?> USD</div>
                    <div class="features">100% водонепроницаемость / Больше изящества с удобной посадкой / Надежное резиновое покрытие ручной формовки поверх эластичного во всех направлениях голенища / 7 мм водонепроницаемого материала Neo-Tech™ / Влагоотводящее покрытие Max-Wick™ дарит сухость и комфорт / Не оставляющая следов и самоочищающаяся подошва / Антимикробная стелька Aegis с защитой от запаха / Легко надеваются при помощи ручек / Комфорт гарантирован от умеренных температур до -40°С</div>
                    </div>
                  </li>
                  <?php
                  }
                  ?>
                </ul>
              </div>
            </div>
          </div>
          <a style="font-size: 9pt; line-height: 31pt; text-decoration: underline;" href="javascript:mdlMusic()">> Click here for shoe sizing information</a>
        </div>
      </div>
      <script type="text/javascript" src="/js/addfunctions.js"></script>
<?php
$sizingguide = true;
include("inc/footer.php");
?>
