<?php
class UcetKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        Databaze::pripoj('localhost', 'root', '', 'maturita');
        $nastaveniModel = new NastaveniModel();

        $this->hlavicka = [
            'titulek' => 'Účet',
            'popis' => 'Stránka pro správu účtu',
            'klicova_slova' => 'účet, login, registrace, přihlášení, správa, nastavení',
            'stylesheet' => 'ucetStyles.css',
            'skripty' => []
        ];

        if (empty($parametry[0]))
            $parametry[0] = 'nastaveni';

        if ($parametry[0] == 'nastaveni') {
            $userId = $_SESSION['user_id'] ?? 1; // Dočasně 1, dokud není login
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['jmeno']) && isset($_POST['email'])) {
                    $nastaveniModel->upravUzivatele($userId, $_POST['jmeno'], $_POST['email']);
                }
                if (!empty($_POST['nove-heslo']) && $_POST['nove-heslo'] === $_POST['potvrzeni-hesla']) {
                    $nastaveniModel->zmenHeslo($userId, $_POST['nove-heslo']);
                }
            }
            $this->data['uzivatel'] = $nastaveniModel->nactiUzivatele($userId);
        }

        $this->pohled = 'ucet/' . $parametry[0];
    }
}
