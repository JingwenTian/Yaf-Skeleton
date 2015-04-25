<?php

define("APPLICATION_PATH",  realpath(dirname(__FILE__)));

Yaf_Loader::import(APPLICATION_PATH .'/application/Functions.php');
Yaf_Loader::import(APPLICATION_PATH .'/application/library/Debug/Kint.class.php'); //d() s()

$application = new Yaf_Application( APPLICATION_PATH . "/conf/application.ini", "development");

$application->bootstrap()->run();

?>
