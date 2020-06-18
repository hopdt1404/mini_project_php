<?php
require_once dirname(__FILE__) . "/app/App.php";
var_dump("hello");
$app = App::getInstance();

$app->run();

