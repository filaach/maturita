<?php
class LoginKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        $this->hlavicka = [
            'titulek' => 'Přihlášení',
            'popis' => 'Přihlašovací stránka',
            'klicova_slova' => 'přihlášení, login, formulář, registrace',
            'stylesheet' => 'loginStyles.css'
        ];
        $this->pohled = 'login';
    }

}