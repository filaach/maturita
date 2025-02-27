<?php
class UcetKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        if (!isset($_SESSION['user_id'])) {
            $this->presmeruj('login');
        }
        Databaze::pripoj('localhost', 'root', '', 'maturita');
        $ucetModel = new UcetModel();

        $this->hlavicka = [
            'titulek' => 'Účet',
            'popis' => 'Stránka pro správu účtu',
            'klicova_slova' => 'účet, login, registrace, přihlášení, správa',
            'stylesheet' => 'ucetStyles.css',
            'skripty' => []
        ];

        if (empty($parametry[0])) {
            $this->pohled = 'ucet';
            return;
        }

        if ($parametry[0] == 'profil') {
            $profilKontroler = new ProfilKontroler();
            $profilKontroler->zpracuj($parametry);
            exit;
        }
        $this->pohled = 'ucet';
    }
}
