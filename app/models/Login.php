<?php

class Login
{
    public function authenticate($userName, $password)
    {
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
}