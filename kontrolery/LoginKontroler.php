<?php
require_once("modely/LoginModel.php");
class LoginKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        if(isset($_SESSION['user_id'])) {
            $this->presmeruj('ucet');
        }
        $this->hlavicka = [
            'titulek' => 'Přihlášení',
            'popis' => 'Přihlašovací stránka',
            'klicova_slova' => 'přihlášení, login, formulář, registrace',
            'stylesheet' => 'loginStyles.css',
            'skripty' => ['togglePassword.js']
        ];
        $this->pohled = 'login';

        $loginModel = new LoginModel();
        $loginModel->over();

    }

}