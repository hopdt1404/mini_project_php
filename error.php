<?php

if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    $username = validateData($_COOKIE['username']);
    $password = validateData($_COOKIE['password']);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    $tmp = $result->fetch_all(MYSQLI_ASSOC);
    if (count($tmp) == 0) {
        $_SESSION['class'] = "alert alert-danger";
        $_SESSION['message'] = "Authentication error";
        header("Location: index.php");
        exit();
    }
    $_SESSION['username'] = $username;

} else {
    if (!isset($_SESSION['username'])) {
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 750px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Invalid Request</h1>
                    </div>
                    <div class="alert alert-danger fade in">
                        <p>Sorry, you've made an invalid request. Please try later. <a href="index.php" class="alert-link">Home</a></p>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
