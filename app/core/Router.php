<?php

define("DEFAULT_PAGE","Login");
define("DEFAULT_CONTROLLER", "LoginController");
define("DEFAULT_ACTION", "access");
define("PATH_CONTROLLER", "/../controllers/");
class Router
{
    private $controllerName;
    private $action;
    private $params = [];
    private $controller;


    function __construct()
    {
        $arr = $this->urlProcess();
        if (file_exists(dirname(__FILE__) . PATH_CONTROLLER .
            ucfirst($arr[0]) . "Controller.php")) {
            $this->controllerName = ucfirst($arr[0]) . "Controller";
        } else {
            $this->controllerName = DEFAULT_CONTROLLER;
        }
        require_once dirname(__FILE__) . PATH_CONTROLLER .
            $this->controllerName . '.php';

        // require ok


        if (isset($arr[1])) {
            if (method_exists($this->controllerName, $arr[1])) {

                $this->action = $arr[1];
                unset($arr[1]);
            } else {

                $this->action = DEFAULT_ACTION;
            }

        } else {
            $this->action = DEFAULT_ACTION;
        }

        $this->params = $arr ? array_values($arr) : [];
        $this->controller = new $this->controllerName();

        call_user_func_array([$this->controller, $this->action], $this->params);

    }

    public function urlProcess()
    {
//        var_dump($_GET['url']);
        if (isset($_GET['url'])) {
            return explode('/', filter_var(trim($_GET['url'], '/')));
        } else {
//            return ['home'];
            return [''];
        }
    }
}
