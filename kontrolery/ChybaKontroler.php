<?php
class ChybaKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        header("HTTP/1.0 404 Not Found");

        $this->hlavicka = [
            'skripty' => ['chyba.js'],
            'titulek' => 'Chyba 404',
            'stylesheet' => 'chybaStyles.css',
        ];

        $this->pohled = 'chyba';

    }
}