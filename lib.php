<?php
require_once "config.php";

//public $conn = new mysqli( $serverName, $userName, $password, $dbname);

if ($conn->connect_errno) {
    echo "Connection failed!";
    die();
}

function validateData($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function checkCookie ($username, $password) {
    var_dump("checking");
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    var_dump("ok");


    $result =
    var_dump('affter');
    die();
    $temp = $result->fetch_all(MYSQLI_ASSOC);

}