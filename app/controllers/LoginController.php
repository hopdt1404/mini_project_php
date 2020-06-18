<?php

class LoginController extends Controller
{
    private $login = null;

    public function __construct()
    {
        $this->login = $this->model("Login");
    }

    public function login()
    {
        if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
            $result = $this->login->checkCookie($_COOKIE['username'], $_COOKIE['password']);

            if ($result) {
                session_start();
                $_SESSION['loggedIn'] = true;
                $_SESSION['id'] = $result['id'];
                $_SESSION['username'] = $result['username'];
            }
        }

        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
            header("location: " . SCHEMA . DOMAIN . ROOT_PATH . "/post/getAll");
            exit();
        }

        $username = '';
        $password = '';
        $loginErr = '';
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $username = trim($_POST['username']);
            $password = trim($_POST('password'));
            if (empty($username) || empty($password)) {
                $loginErr = "";
            }

        }

    }
}