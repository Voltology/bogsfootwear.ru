<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <META http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Bogs Footwear Russia | ДЛЯ ЛЮБОЙ НЕПОГОДЫ</title>
    <link rel="stylesheet" href="/css/nivo-gallery.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/css/galleriffic-2.css" type="text/css" />
    <link rel="shortcut icon" href="favicon.ico" >
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
    <script type="text/javascript" src="/js/jquery-1.3.2.js" language="javascript"></script>
    <script type="text/javascript" src="/js/jquery-ui-1.7.2.min.js" language="javascript"></script>
    <script type="text/javascript" src="/js/home.js" language="javascript"></script>
    <script type="text/javascript" src="/js/jquery.galleriffic.js" language="javascript"></script>
    <script type="text/javascript" src="/js/jquery.opacityrollover.js" language="javascript"></script>
    <script type="text/javascript" src="/js/cart.js" language="javascript"></script>
    <script type="text/javascript">document.write('<style>.noscript { display: none; }</style>');</script>
    <script src="/js/modernizr-1.7.min.js"></script>
    <script src="/js/jquery.nivo.gallery.js"></script>
    <script type="text/javascript">$(document).ready(function() { $('#gallery').nivoGallery(); });</script>
    <!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <script type="text/javascript" src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>
    <div id="modal-blanket"></div>
    <div id="dialog">
      <p>Loading PayPal...</p>
      <img src="/img/ajax-loader.gif" />
    </div>
    <div id="maincontainer">
      <span id="logo"><a href="<?php echo BASE_URL; ?>"><img src="/img/transparent.gif" width="211" height="64" vspace="0" hspace="0" border="0"></a></span>
      <span id="navarea">
        <div class="account-links">
          <?php
          if ($user->isLoggedIn()) {
            echo "<strong>" . t("Hello") . ", " . $user->getFirstName() . "</strong> -  <a href=\"/account\">" . t("My Account") . "</a>";
            if ($user->getRole() == 2) { echo " | <a href=\"/admin/\">" . t("Admin Area") . "</a>"; }
            echo " | <a href=\"/logout\">" . t("Log Out") . "</a>";
          } else {
            echo "<a href=\"/login/\">" . t("Sign In") . "</a> | <a href=\"/register/\">" . t("Register") . "</a>";
          }
          ?>
        </div>
        <span id="navigation">
          <a href="/about-us"><?php echo t("About Us"); ?></a>
          <a href="/catalog/womens/womens%20outdo"><?php echo t("Catalog"); ?></a>
          <a href="/contact-us"><?php echo t("Contact Us"); ?></a>
          <a href="/where-to-buy"><?php echo t("Where to Buy"); ?></a>
          <?php
          if ($cart->getItemCount() < 1) {
            echo "<a href=\"/cart\"><img src=\"/img/cart.png\" class=\"cart-icon\" border=\"0\" /> <span id=\"cart-text\">" . t("Cart is empty") . "</span></a></span>";
          } else {
            echo "<a href=\"/cart\"><img src=\"/img/cart.png\" class=\"cart-icon\" border=\"0\" /> <span id=\"item-count\">" . $cart->getItemCount() . "</span> " . t("items in cart") . "</a></span>";
          }
          ?>
        </span>
        <div class="clear"></div>
      </span>
      <?php
      if ($shippingbanner) {
      ?>
      <div class="shipping-banner"><?php echo t("Free shipping from the USA"); ?> <img src="/img/usflag.gif" class="flag" /></div>
      <?php
      }
      ?>
