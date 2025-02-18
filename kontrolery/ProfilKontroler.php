<?php
class ProfilKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        Databaze::pripoj('localhost', 'root', '', 'maturita');
        $profilModel = new ProfilModel();

        $this->hlavicka = [
            'titulek' => 'Profil',
            'popis' => 'Stránka uživatelského profilu',
            'klicova_slova' => 'profil, účet, příspěvky, editace',
            'stylesheet' => 'profilStyles.css',
            'skripty' => []
        ];

        $userId = $_SESSION['user_id'] ?? 1; // Dočasně 1, dokud není login

        // Pokud uživatel odešle formulář na změnu profilovky
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_FILES['profilovka']['name'])) {
                $profilovaFotka = $this->nahrajProfilovku($_FILES['profilovka'], $userId);
                $profilModel->zmenProfilovku($userId, $profilovaFotka);
            }

            // Pokud uživatel odešle formulář na změnu bio
            if (!empty($_POST['bio'])) {
                $profilModel->zmenBio($userId, $_POST['bio']);
            }
        }

        // Načítání uživatelských dat
        $this->data['uzivatel'] = $profilModel->nactiUzivatele($userId);
        $this->data['prispevky'] = $profilModel->nactiPrispevkyUzivatele($userId);
        $this->pohled = 'profil'; // Nechávám stejný název pohledu, který jsi měl
    }

    // Funkce pro nahrání profilové fotky
    private function nahrajProfilovku(array $soubor, int $userId): string
    {
        $uploadDir = "uploads/profilovky/";
        $souborJmeno = "profil_$userId" . "_" . time() . ".png";
        $cesta = $uploadDir . $souborJmeno;

        move_uploaded_file($soubor['tmp_name'], $cesta);
        return $cesta;
    }
}
