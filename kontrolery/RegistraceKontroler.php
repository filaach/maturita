<?php
require_once 'modely/RegistraceModel.php';
class RegistraceKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        $this->hlavicka = [
            'titulek' => 'Registrace',
            'popis' => 'Stránka pro registraci',
            'klicova_slova' => 'login, formulář, registrace',
            'stylesheet' => 'registraceStyles.css',
            'skripty' => ['togglePassword.js']

        ];
        $this->pohled = 'registrace';

        $registraceModel = new RegistraceModel();
        $registraceModel->registruj();
    }

}