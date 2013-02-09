<?php
function t($str) {
  if (LANGUAGE != BASE_LANGUAGE) {
    include("translations/" . strtolower(LANGUAGE) . ".po");
    for ($i = 0; $i < count($msg); $i++) {
      if ($str === $msg[$i]) {
        return $rep[$i];
      }
    }
    return $str;
  }
  return $str;
}
?>
