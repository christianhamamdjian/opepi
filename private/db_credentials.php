<?php
$local = in_array($_SERVER['REMOTE_ADDR'],array('','REMOTE_ADDR' => '::1'));
if (!$local) {	
    define("DB_SERVER", "");
    define("DB_USER", "");
    define("DB_PASS", "");
    define("DB_NAME", "");
  }
else {
    define("DB_SERVER", "");
    define("DB_USER", "");
    define("DB_PASS", "");
    define("DB_NAME", "");
  }
?>
