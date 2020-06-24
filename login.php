<?php
session_start();

include "config.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
	function validateData($data) {
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$username = validateData($_POST['username']);
	$password = validateData($_POST['password']);

	if (empty($username) || empty($password)) {
		header("Location: index.php?error=Username or Password invalid");
		exit();
	} else {
		$sql = "SELECT * FROM users WHERE username = \"" . $username . "\"";
		$result = $conn->query($sql);
		$temp = $result->fetch_all(MYSQLI_ASSOC);
		if ($temp) {
            $hash = $temp[0]['password'];
            if ($password === $hash) {
                $_SESSION['id'] = $temp[0]['id'];
                $_SESSION['username'] = $temp[0]['username'];
                
                header("Location: home.php");
            } else {
                header("Location: index.php?error=Username or Password invalid");
                exit();
            }

        } else {
            header("Location: index.php?error=Username or Password invalid");
            exit();
        }
	}

} else {
	header("Location: index.php");
	exit();
}