<?php
class ProfilKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        if (!isset($_SESSION['user_id'])) {
            $this->presmeruj('login');
        }
        Databaze::pripoj('localhost', 'root', '', 'maturita');
        $this->profilModel = new ProfilModel();

        $this->hlavicka = [
            'titulek' => 'Profil',
            'popis' => 'Stránka uživatelského profilu',
            'klicova_slova' => 'profil, účet, příspěvky, editace',
            'stylesheet' => 'profilStyles.css',
            'skripty' => ['odstranitAlert.js']
        ];

        $userId = $_SESSION['user_id'];

        $this->data['uzivatel'] = $_SESSION;
        $this->data['prispevky'] = $this->profilModel->nactiPrispevkyUzivatele($userId);
        $this->pohled = 'profil';

        if (isset($parametry[0])) {
            if ($parametry[0] == 'smazat') {
                $this->profilModel->smazPrispevek($parametry[1]);
                header('Location: /profil');
                exit;
            }
        }
    }

}
