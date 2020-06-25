<?php
require_once "config.php";
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();

}


// Define variables and initialize with empty values
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";

// Processing form data when form is submitted

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = trim($_POST["id"]);

    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } elseif (
    !filter_var($input_name,
        FILTER_VALIDATE_REGEXP,
        ["options"=> ["regexp"=>"/^[a-zA-Z\s]+$/"]])) {
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }

    // Validate address address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";
    } else{
        $address = $input_address;
    }

    // Validate salary
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $salary = $input_salary;
    }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)) {

        // Prepare an update statement
        $sql = "UPDATE employees SET name = '$name', address = '$address', salary = $salary  WHERE id=$id";
        var_dump($sql);
        $result = $conn->query($sql);
        if ($result) {
            header("location: home.php");
            exit();
        } else {
            echo "Something went wrong. Please try again later.";
        }

    }

} else {

    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id = trim($_GET["id"]);
        // Prepare a select statement
        $sql = "SELECT * FROM employees WHERE id = $id";
        $result = $conn->query($sql);
        $temp = $result->fetch_all(MYSQLI_ASSOC);

        if (count($temp) == 1) {
            $row = $temp[0];
            $name = $row["name"];
            $address = $row["address"];
            $salary = $row["salary"];
        } else {
            echo "Something went wrong. Please try again later.";
        }
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                    <h2>Update Record</h2>
                </div>
                <p>Please edit the input values and submit to update the record.</p>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        <span class="help-block"><?php echo $name_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                        <label>Address</label>
                        <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                        <span class="help-block"><?php echo $address_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($salary_err)) ? 'has-error' : ''; ?>">
                        <label>Salary</label>
                        <input type="text" name="salary" class="form-control" value="<?php echo $salary; ?>">
                        <span class="help-block"><?php echo $salary_err;?></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="home.php" class="btn btn-default">Cancel</a>
                    <a href="home.php" class="btn btn-default">Home</a>

                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>