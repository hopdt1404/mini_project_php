<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['id'])) {

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
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</head>
<body>
    <h6> <?php $_SESSION['username']; ?> </h6>
    <a href="index.php">Logout</a><br>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Employees Details</h2>
                        <a href="create.php" class="btn btn-success pull-right">Add New Employee</a>
                    </div>
                    <?php
                    require_once "config.php";

                    $sql = "SELECT * FROM employees";
                    $result = $conn->query($sql);
                    $temp = $result->fetch_all(MYSQLI_ASSOC);
                    if (count($temp) > 0) {
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>#</th>";
                        echo "<th>Name</th>";
                        echo "<th>Address</th>";
                        echo "<th>Salary</th>";
                        echo "<th>Action</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        $numberRecord = count($temp);
                        for ($i = 0; $i < $numberRecord; $i++) {
                            echo "<tr>";
                            echo "<td>" . $temp[$i]['id'] . "</td>";
                            echo "<td>" . $temp[$i]['name'] . "</td>";
                            echo "<td>" . $temp[$i]['address'] . "</td>";
                            echo "<td>" . $temp[$i]['salary'] . "</td>";
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
                    ?>
                </div>

            </div>
        </div>

    </div>

</body>
</html>


<?php

} else {
    header("Location: index.php");
    exit();
}

?>

