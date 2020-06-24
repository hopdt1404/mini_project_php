<?php

$serverName = "localhost";
$userName = "root";
$password = "123456a@";

$dbname = "mini_project_php";

$conn = new mysqli( $serverName, $userName, $password, $dbname);

if ($conn->connect_errno) {
    echo "Connection failed!";
    die();
}

