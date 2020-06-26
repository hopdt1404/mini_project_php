<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();

}

try {
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Include config file
        require_once "config.php";

        // Prepare a select statement
        $id = trim($_GET["id"]);
        $sql = "SELECT * FROM employees WHERE id = $id";
        $result = $conn->query($sql);
        $temp = $result->fetch_all(MYSQLI_ASSOC);
        if (count($temp) == 1) {
            $row = $temp[0];
            $name = $row["name"];
            $address = $row["address"];
            $salary = $row["salary"];
        } else {
            // URL doesn't contain valid id parameter. Redirect to error page
            header("location: error.php");
            exit();
        }
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
} catch (Exception $e) {
    header("location: error.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
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
                    <h1>View Record  <?php echo $id; ?></h1>
                </div>
                <div class="form-group">
                    <h3><label>Name</label></h3>
                    <h4><p class="form-control-static"><?php echo $row["name"]; ?></p></h4>
                </div>
                <div class="form-group">
                    <h3><label>Address</label></h3>
                    <h4><p class="form-control-static"><?php echo $row["address"]; ?></p></h4>
                </div>
                <div class="form-group">
                    <h3><label>Salary</label></h3>
                    <h4><p class="form-control-static"><?php echo number_format($row["salary"], 2, ',', ' '); ?></p></h4>
                </div>
                <p><a href="home.php" class="btn btn-primary">Back</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
