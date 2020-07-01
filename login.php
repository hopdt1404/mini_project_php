<?php

require_once "config.php";
require_once "lib.php";

session_start();
try {
    if (isset($_POST['username']) && isset($_POST['password'])) {

        function loginError () {
            $_SESSION['class'] = "alert alert-danger";
            $_SESSION['message'] = "Username or Password invalid";
            header("Location: index.php");
            exit();
        }

        $username = validateData($_POST['username']);
        $password = validateData($_POST['password']);

        if (empty($username) || empty($password)) {
            loginError();
        } else {
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = $conn->query($sql);
            $temp = $result->fetch_all(MYSQLI_ASSOC);
            if ($temp) {
                $passwordHash = $temp[0]['password'];
                if ($password == $passwordHash) {
                    session_start();
                    $_SESSION['username'] = $username;
                    if (isset($_POST['remember-me'])) {
                        setcookie("username", $username, time() + 86400, "/");
                        setcookie("password", $password, time() + 86400, "/");
                    }
                    $_SESSION['class'] = "alert alert-success";
                    $_SESSION['message'] = "Login Successful";
                    header("Location: home.php");
                    exit();
                } else {
                    loginError();
                }

            } else {
                loginError();
            }
        }

    } else {
        header("Location: index.php");
        exit();
    }
} catch (Exception $e) {
    header("location: error.php");
    exit();
}
