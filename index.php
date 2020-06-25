<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
          integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css"
          integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"
            integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd"
            crossorigin="anonymous"></script>
    <style type="text/css">
        aside {
            margin-left: 450px;
            margin-top: 80px;
        }
        h2 {
            text-align: center;
            color: #0099ff;
        }

        .checkbox label {
            color: #66c2ff;
        }
    </style>

</head>
<body>
<div class="row">
    <aside class="col-sm-6">
        <div class="card">
            <article class="card-body">
                <h2 class="card-title mb-4 mt-1">Login</h2>
                <?php if (isset($_SESSION['class'])) { ?>
                    <div class="<?php echo $_SESSION['class']; ?>">
                        <strong><?php echo $_SESSION['message']; ?></strong>
                    </div>
                <?php } ?>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <!--                            <a class="float-right" href="">Forgot?</a><br>-->
                        <label for="loginLabel">Username</label>
                        <input type="text" class="form-control" name="username" id="loginLabel" placeholder="User name">
                    </div>

                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" name="password" id="Password" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <label><input type="checkbox" name="remember-me" value="checked"> Remember-me</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>

                </form>

            </article>

        </div>
    </aside>
</div>

</body>
</html>
