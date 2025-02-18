<?php
class UcetKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        Databaze::pripoj('localhost', 'root', '', 'maturita');
        $ucetModel = new UcetModel();

        $this->hlavicka = [
            'titulek' => 'Účet',
            'popis' => 'Stránka pro správu účtu',
            'klicova_slova' => 'účet, login, registrace, přihlášení, správa',
            'stylesheet' => 'ucetStyles.css',
            'skripty' => []
        ];

        // Pokud není zvolená žádná stránka, zobrazí se hlavní stránka účtu
        if (empty($parametry[0])) {
            $this->pohled = 'ucet';
            return;
        }

        // Pokud uživatel klikne na "profil", přesměruj na ProfilKontroler
        if ($parametry[0] == 'profil') {
            $profilKontroler = new ProfilKontroler();
            $profilKontroler->zpracuj($parametry);
            exit;
        }

        // Pokud se zvolí neznámá stránka, vrátíme uživatele zpět na účet
        $this->pohled = 'ucet';
    }
}
