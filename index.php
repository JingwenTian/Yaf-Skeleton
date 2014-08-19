<?php

define("APPLICATION_PATH",  realpath(dirname(__FILE__)));

require_once APPLICATION_PATH .'/application/Functions.php';

$application = new Yaf_Application( APPLICATION_PATH . "/conf/application.ini", "development");

$application->bootstrap()->run();

?>
