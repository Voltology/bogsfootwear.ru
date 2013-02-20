bogsfootwear-russian
====================

.local.inc.php format
//Environment
switch($_SERVER['HTTP_HOST']) {
  case "bogsfootwear":
  case "bogsfootwear.cvuletich.com":
  case "bogsfootwear.chrisvuletich.com":
    define("ENV", "dev");
    define("DB_EXT", "_staging");
    break;
  case "staging.bogsfootwear.ru":
    define("ENV", "staging");
    define("DB_EXT", "_staging");
    break;
  case "bogsfootwear.ru":
    define("ENV", "production");
    define("DB_EXT", "");
    break;
  default:
    define("ENV", "");
    die("An error has occurred.  No environment has been set.");
}

if (ENV === "production") {
  #database
  define("DB_HOST", "localhost");
  define("DB_NAME", "bogsfootwear");
  define("DB_PORT", "");
  define("DB_USER", "bogsfootwear");
  define("DB_PASS", "");

  #generic
  define("COMPANY_NAME", "BogsFootwear");
  define("BASE_URL", "http://bogsfootwear.ru/");
  define("JQUERY_VERSION", "1.9.0");
  define("LIB_PATH", "/lib/");
  define("LOGIN_PATH", "/login.php");
  define("LOGOUT_PATH", "/logout.php");

  #admin
  define("ADMIN_LOGO", "hdr-logo.jpg");
  define("ADMIN_BASE_URL", "http://staging.bogsfootwear.ru/admin/");
  define("ADMIN_CSS_PATH", "/css/");
  define("ADMIN_IMG_PATH", "/img/admin/");
  define("ADMIN_JS_PATH", "/js/");

  #PayPal auth
  define("PAYPAL_VER", "64");
  define("PAYPAL_LANG", "EN");
  define("PAYPAL_USER", "");
  define("PAYPAL_PASS", "");
  define("PAYPAL_SIG", "");
  define("PAYPAL_API", "https://api-3t.paypal.com/nvp");
  define("PAYPAL_URL", "https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=");
  define("PAYPAL_CANCEL_URL", BASE_URL . "cart");
  define("PAYPAL_RETURN_URL", BASE_URL . "fulfill/");

  #Fulfillment auth
  define("STOCK_THRESHOLD", 5);
  define("STORE_URL", "https://api.pickandfulfill.com/");
  define("STORE_TOKEN", "");
  define("CLIENT_TOKEN", "");
  define("BASE_LANGUAGE", "en");
  define("LANGUAGE", "ru");
} else if (ENV === "staging") {
  #database
  define("DB_HOST", "bogsfootwear.db.3937984.hostedresource.com");
  define("DB_NAME", "bogsfootwear");
  define("DB_PORT", "");
  define("DB_USER", "bogsfootwear");
  define("DB_PASS", "c%");

  #generic
  define("COMPANY_NAME", "BogsFootwear");
  define("BASE_URL", "http://staging.bogsfootwear.ru/");
  define("JQUERY_VERSION", "1.9.0");
  define("LIB_PATH", "/home/content/u/s/h/ushj1234/html/staging.bogsfootwear/lib/");
  define("LOGIN_PATH", "/login.php");
  define("LOGOUT_PATH", "/logout.php");

  #admin
  define("ADMIN_LOGO", "hdr-logo.jpg");
  define("ADMIN_BASE_URL", "http://staging.bogsfootwear.ru/admin/");
  define("ADMIN_CSS_PATH", "css/");
  define("ADMIN_IMG_PATH", "img/admin/");
  define("ADMIN_JS_PATH", "js/");

  #PayPal auth
  define("PAYPAL_VER", "64");
  define("PAYPAL_LANG", "EN");
  define("PAYPAL_USER", "");
  define("PAYPAL_PASS", "");
  define("PAYPAL_SIG", "");
  define("PAYPAL_API", "https://api-3t.sandbox.paypal.com/nvp");
  define("PAYPAL_URL", "https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=");
  define("PAYPAL_CANCEL_URL", BASE_URL . "cart/");
  define("PAYPAL_RETURN_URL", BASE_URL . "fulfill/");

  #Fulfillment auth
  define("STOCK_THRESHOLD", 5);
  define("STORE_URL", "https://apisandbox.pickandfulfill.com/");
  define("STORE_TOKEN", "");
  define("CLIENT_TOKEN", "");
  define("BASE_LANGUAGE", "en");
  define("LANGUAGE", "ru");
} else if (ENV === "dev") {
  #database
  define("DB_HOST", "localhost");
  define("DB_NAME", "bogsfootwear");
  define("DB_PORT", "");
  define("DB_USER", "bogsfootwear");
  define("DB_PASS", "");

  #generic
  define("COMPANY_NAME", "BogsFootwear");
  define("BASE_URL", "http://bogsfootwear/");
  define("JQUERY_VERSION", "1.9.0");
  define("LIB_PATH", "/Users/christopher.vuletich/Development/Web/php/bogsfootwear/deploy/lib/");
  define("LOGIN_PATH", "/login.php");
  define("LOGOUT_PATH", "/logout.php");

  #admin
  define("ADMIN_LOGO", "hdr-logo.jpg");
  define("ADMIN_BASE_URL", "http://bogsfootwear/admin/");
  define("ADMIN_CSS_PATH", "css/");
  define("ADMIN_IMG_PATH", "img/admin/");
  define("ADMIN_JS_PATH", "js/");

  #PayPal auth
  define("PAYPAL_VER", "64");
  define("PAYPAL_LANG", "EN");
  define("PAYPAL_USER", "");
  define("PAYPAL_PASS", "");
  define("PAYPAL_SIG", "");
  define("PAYPAL_API", "https://api-3t.sandbox.paypal.com/nvp");
  define("PAYPAL_URL", "https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=");
  define("PAYPAL_CANCEL_URL", BASE_URL . "cart/");
  define("PAYPAL_RETURN_URL", BASE_URL . "fulfill/");

  #Fulfillment auth
  define("STOCK_THRESHOLD", 5);
  define("STORE_URL", "https://apisandbox.pickandfulfill.com/");
  define("STORE_TOKEN", "");
  define("CLIENT_TOKEN", "");
  define("BASE_LANGUAGE", "en");
  define("LANGUAGE", "en");
}
define("PROD_STORE_URL", "https://api.pickandfulfill.com/");
define("PROD_STORE_TOKEN", "");
define("PROD_CLIENT_TOKEN", "");

require(LIB_PATH . "Database.class.php");
require(LIB_PATH . "User.class.php");
require(LIB_PATH . "Cart.class.php");
require(LIB_PATH . "Utilities.php");

$db = new Database();
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = new User();
    $_SESSION['user']->setToken();
}
$user =& $_SESSION['user'];
$user->checkPassword($_COOKIE['email'], $_COOKIE['password']);
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = new Cart($user->getToken());
}
$cart =& $_SESSION['cart'];
?>
