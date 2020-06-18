<?php

abstract class Controller
{
    protected final function model($model)
    {
        require_once dirname(__FILE__) . "/../models/" . $model . ".php";
        return new $model();
    }

    protected final function view($view, $data = [], $script = false)
    {
        require_once dirname(__FILE__) . "/../views/" . $view . ".php";
    }

    protected final function authenticate()
    {
        if (!isset($_REQUEST['loggedIn']) || ($_SESSION['loggedIn'] != true)) {
            header("location: " . SCHEMA . DOMAIN . ROOT_PATH . "/login/access");
            exit();
        }
    }
}

