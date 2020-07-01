<?php

session_start();
require_once "lib.php";
require_once "config.php";

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
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
        form {
             margin-left: 1530px;
        }
        h4 {
            text-align: center;
        }
        h5 {
            text-align: center;
        }
        td {
            text-align: center;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</head>
<body>
    <div class="alert alert-info">
        <h2><strong>Welcome <?php echo $_SESSION['username']; ?></strong></h2>
    </div>

    <?php if (isset($_SESSION['class'])) { ?>
        <div class="<?php echo $_SESSION['class']; $_SESSION['class'] = ''; ?>">
            <strong><?php echo $_SESSION['message']; $_SESSION['message'] = ''; ?></strong>
        </div>
    <?php } ?>

    <form>
        <a href="logout.php">Logout</a><br>
    </form>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Employees Details</h2>
                        <a href="create.php" class="btn btn-success pull-right">Add New Employee</a>
                    </div>

                    <?php
                    try {
                        $sql = "SELECT * FROM employees";
                        $result = $conn->query($sql);
                        $temp = $result->fetch_all(MYSQLI_ASSOC);
                        if (count($temp) > 0) {
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th><h4>#</h4></th>";
                            echo "<th><h4>Name</h4></th>";
                            echo "<th><h4>Address</h4></th>";
                            echo "<th><h4>Salary</h4></th>";
                            echo "<th><h4>Action</h4></th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            $numberRecord = count($temp);
                            for ($i = 0; $i < $numberRecord; $i++) {
                                echo "<tr>";
                                echo "<td><h5>" . ($i + 1). "</td></h5>";
                                echo "<td><h5>" . $temp[$i]['name'] . "</td></h5>";
                                echo "<td><h5>" . $temp[$i]['address'] . "</td></h5>";
                                echo "<td><h5>" . number_format($temp[$i]['salary'], 2, ',', ' ') . "</td></h5>";
                                echo "<td>";
                                echo "<a href='read.php?id=". $temp[$i]['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                echo "<a href='update.php?id=". $temp[$i]['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                echo "<a href='delete.php?id=". $temp[$i]['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                        } else {
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } catch (Exception $e) {
                        header("location: error.php");
                        exit();
                    }
                    ?>
                </div>

            </div>
        </div>

    </div>

</body>
</html>
