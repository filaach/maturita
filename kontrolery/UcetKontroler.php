<?php
class UcetKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        $this->hlavicka = [
            'titulek' => 'Účet',
            'popis' => 'Stránka pro správu účtu',
            'klicova_slova' => 'úřet, login, registrace, přihlášení, správa, nastavení',
            'stylesheet' => 'ucetStyles.css',
            'skripty' => []
        ];
        $this->pohled = 'ucet';
    }

}