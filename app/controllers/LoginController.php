<?php

class LoginController extends Controller
{
    private $loginModel = null;

    public function __construct()
    {
        $this->loginModel = $this->model("Login");
    }

    public function access()
    {
        var_dump('helo');


       if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
           $result = $this->loginModel->checkCookie($_COOKIE['username'], $_COOKIE['password']);

           if ($result) {
               session_start();
               $_SESSION['loggedIn'] = true;
               $_SESSION['id'] = $result['id'];
               $_SESSION['username'] = $result['username'];
           }

       } else {
           echo "else";
       }

       if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
           echo "if";
           header("location: " . SCHEMA . DOMAIN . ROOT_PATH . "/post/getAll");

           exit();
       } else {
           echo "else";
       }
        $result = $this->loginModel->test();
        var_dump($result);
        $username = '';
        $password = '';
        $loginErr = '';


       if ($_SERVER['REQUEST_METHOD'] == "POST") {
           var_dump($_POST['username']);
           die();
           echo "abc   awf";
           $username = trim($_POST['username']);
           $password = trim($_POST('password'));
           if (empty($username) || empty($password)) {
               $loginErr = "Incorrect username or password.";
           }
           if (empty($loginErr)) {
               echo "hello";
               $auth = $this->loginModel->authenticate($username, $password);
               if ($auth = "Incorrect username or password.") {
                   $loginErr = "Incorrect username or password.";
               } else {
                   session_start();
                   $_SESSION['loggedIn'] = true;
                   $_SESSION['id'] = $auth['id'];
                   $_SESSION['username'] = $auth['username'];

                   if (isset($_POST['remember-me'])) {
                       // 86400 ~ 24h ~ 1day
                       setcookie('username', $auth['username'], time() + 86400, '/');
                       setcookie('password', $auth['password'], time() + 86400, '/');
                   }
                   header("location: " . SCHEMA . DOMAIN . ROOT_PATH . "/posts/getAll");
                   exit();
               }

           }

       }
        $data = [
            'title' => 'Login',
            'username' => $username,
            'password' => $password,
            'loginErr' => $loginErr,
        ];

        $this->view("LoginView", $data);


    }
}