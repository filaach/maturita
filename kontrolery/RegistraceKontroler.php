<?php
class LoginKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        $this->hlavicka = [
            'titulek' => 'Registrace',
            'popis' => 'Stránka pro registrace',
            'klicova_slova' => 'login, formulář, registrace',
            'stylesheet' => 'registraceStyles.css'
        ];
        $this->pohled = 'registrace';
    }

}