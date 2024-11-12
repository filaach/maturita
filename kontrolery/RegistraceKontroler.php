<?php
class RegistraceKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        $this->hlavicka = [
            'titulek' => 'Registrace',
            'popis' => 'Stránka pro registrace',
            'klicova_slova' => 'login, formulář, registrace',
            'stylesheet' => 'registraceStyles.css',
            'skripty' => ['togglePassword.js']

        ];
        $this->pohled = 'registrace';
    }

}