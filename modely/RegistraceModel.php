<?php

require_once('modely/Databaze.php');
class RegistraceModel
{
    public function registruj(): void
    {
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password-repeat']) && isset($_POST['email']) && isset($_POST['dateOfBirth']) && isset($_POST['phone'])) {
            $login = $_POST['username'];
            $heslo = $_POST['password'];
            $heslo2 = $_POST['password-repeat'];
            $email = $_POST['email'];
            $telefon = $_POST['phone'];
            $datumNarozeni = $_POST['dateOfBirth'];
            if ($heslo != $heslo2) {
                header('Location: registrace?zprava=heslo');
                exit;
            }
            Databaze::pripoj('localhost', 'root', '', 'maturita');
            $duplicate = Databaze::dotazJeden("SELECT * FROM user WHERE userName = ? OR email = ? OR phone = ?", [$login, $email, $telefon]);
            if ($duplicate) {
                header('Location: registrace?zprava=existuje');
                exit;
            }
            $user = Databaze::vloz("INSERT INTO user (userName, password, email, phone, dateOfBirth) VALUES (?, ?, ?, ?, ?)", [$login, password_hash($heslo, PASSWORD_DEFAULT), $email, $telefon, $datumNarozeni]);
            if (!$user) {
                header('Location: login?zprava=chyba');
                exit;
            } else {
                $_SESSION['user_id'] = $user;
                $_SESSION['user_name'] = $login;
                header('Location: ucet?');
                exit;
            }
        }
        return;

    }
}