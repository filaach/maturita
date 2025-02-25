<?php

require_once('modely/Databaze.php');
class LoginModel
{
    public function over(): void
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $login = $_POST['username'];

            Databaze::pripoj('localhost', 'root', '', 'maturita');
            $user = Databaze::dotazJeden("SELECT * FROM user WHERE userName = ?", [$login]);
            if (!$user) {
                header('Location: login?zprava=login');
                exit;
            }
            if (password_verify($_POST['password'], $user["password"])) {
                $_SESSION['user_id'] = $user["id"];
                $_SESSION['user_name'] = $user["userName"];
                header('Location: ucet');
                exit;
            } else {
                header('Location: login?zprava=heslo');
                exit;
            }
        }
        return;

    }
}