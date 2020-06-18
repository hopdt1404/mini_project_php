<?php require_once dirname(__FILE__) . "/header.php"; ?>
<h2>Sign in</h2>

<form action="<?php echo ROOT_PATH . "/login/access" ?>" method="POST">
    <?php if (!empty($data['loginErr'])) : ?>
        <p><?php echo $data['loginErr']; ?></p>
    <?php endif; ?>
    <p>
        <label>Username</label>
        <input class="login" type="text" name="username" value="<?php echo $data['username']?>">
    </p>

    <p>
        <label>Password</label>
        <input class="login"> type="password" name="password" value="<?php echo $data['password'] ?>">
    </p>
    <input class="remember-me" type="checkbox" id="remember-me" name="remember-me" value="checked">
    <label>Remember me</label>
    <input type="submit" value="Login">
</form>

<?php require_once dirname(__FILE__) . "/footer.php"?>
