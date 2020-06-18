<?php require_once dirname(__FILE__) . "/header.php"; ?>
<h2>Sign in</h2>

<form action="<?php echo ROOT_PATH . "/login/login" ?>" method="POST">
    <?php if (!empty($data['loginErr'])) : ?>
        <p><?php echo $data['usernameErr']; ?></p>
    <?php endif; ?>
    <label>Username</label>
    <input type="text" name="username" value="<?php echo $data['username']?>">



    <label>Password</label>
    <input type="password" name="password" value="<?php echo $data['password'] ?>">


    <input type="checkbox" id="remember-me" name="remember-me" value="checked">
    <label>Remember me</label>
    <input type="submit" value="Login">
</form>

<?php require_once dirname(__FILE__) . "/footer.php"?>
