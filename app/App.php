<?php

$dir = dirname(__FILE__);
require_once $dir . "/configs/config.php";
require_once $dir . "/core/Session.php";
require_once $dir . "/core/Database.php";
require_once $dir . "/core/Controller.php";
require_once $dir . "/core/Router.php";

class App
{
    private static $instance = null;
    private $router = null;

    private function __construct()
    {
        $this->router = new Router();
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function run()
    {
        return $this->router;
    }
}
