<?php

include "config.php";
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
	function validateData($data) {
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

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
            $hash = $temp[0]['password'];
            if ($password === $hash) {
                session_start();
                $_SESSION['username'] = $username;
                if (isset($_POST['remember-me'])) {
                    setcookie("username", $username, time() + 86400, "/");
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