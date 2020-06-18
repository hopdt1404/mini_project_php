<?php

class Login
{
    public function authenticate($userName, $password)
    {
        var_dump("authenticate");
        die();
        $query = "SELECT * FORM `users` WHERE `username` = \"" . $userName . "\"";
        $result = database::query($query);

        if (empty($result)) {
            return "Incorrect username or password.";
        }

        $hash = $result[0]['password'];
        if (password_verify($password, $hash)) {
            return $result[0];
        }

        return "Incorrect username or password.";
    }

    public function checkCookie($userName, $password)
    {
        var_dump("checkCookie");
        die();
        $query = "SELECT * FORM `users` WHERE `username` = \"" . $userName . "\"";
        $result = database::query($query);

        if (empty($result)) {
            return [];
        }

        if ($result[0]['password'] == $password) {
            return $result[0];
        }

        return [];
    }

    public function test () {
        $query = "SHOW TABLES";
        $result = database::query($query);
        return $result;
    }
}