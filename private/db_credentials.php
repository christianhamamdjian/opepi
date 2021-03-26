<?php
$local = in_array($_SERVER['REMOTE_ADDR'],array('127.0.0.1','REMOTE_ADDR' => '::1'));
if (!$local) {	
    define("DB_SERVER", "localhost:49404");
    define("DB_USER", "azure");
    define("DB_PASS", "6#vWHD_$");
    define("DB_NAME", "opepi");
  }
else {
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "root");
    define("DB_NAME", "opepi");
  }
?>
