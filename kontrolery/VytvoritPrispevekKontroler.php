<?php

class VytvoritPrispevekKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        $this->hlavicka = [
            'titulek' => 'Vytvořit nový příspěvek',
            'popis' => 'Přidání příspěvku s možností nahrání obrázků nebo videí.',
            'klicova_slova' => 'příspěvek, upload, obrázek, video',
            'stylesheet' => 'styles/vytvoritPrispevekStyles.css',
            'skripty' => []
        ];

        $prispevkyModel = new PrispevkyModel();

        // Kontrola a vytvoření složky "uploads", pokud neexistuje
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }

        // Zpracování formuláře při odeslání POST požadavku
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $obsah = $_POST['obsah'] ?? '';
            $typ = $_POST['typ'] ?? '';

            // Zpracování nahrání souboru
            $soubor = null;
            if (!empty($_FILES['soubor']['name'])) {
                $souborCesta = 'uploads/' . basename($_FILES['soubor']['name']);
                $souborTyp = strtolower(pathinfo($souborCesta, PATHINFO_EXTENSION));

                // Povolené typy souborů
                $povoleneTypy = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov'];

                if (in_array($souborTyp, $povoleneTypy)) {
                    if (move_uploaded_file($_FILES['soubor']['tmp_name'], $souborCesta)) {
                        $soubor = $souborCesta;
                    } else {
                        $this->pridatZpravu('Chyba při nahrávání souboru.', true);
                    }
                } else {
                    $this->pridatZpravu('Nepodporovaný typ souboru.', true);
                }
            }

            // Ověření, že formulář má všechny potřebné údaje
            if (!empty($obsah) && !empty($typ)) {
                $prispevkyModel->ulozitPrispevek($obsah, $typ, $soubor);
                $this->pridatZpravu('Příspěvek byl úspěšně přidán.');
                $this->presmeruj('prispevky');
            } else {
                $this->pridatZpravu('Vyplňte všechny položky formuláře.', true);
            }
        }

        // Nastavení pohledu
        $this->pohled = 'vytvoritPrispevek';
    }

    /**
     * Přidá zprávu pro uživatele.
     *
     * @param string $zprava Text zprávy.
     * @param bool $chyba Je zpráva chybová?
     */
    private function pridatZpravu(string $zprava, bool $chyba = false): void
    {
        if (!isset($_SESSION['zpravy'])) {
            $_SESSION['zpravy'] = [];
        }

        $_SESSION['zpravy'][] = [
            'text' => $zprava,
            'typ' => $chyba ? 'chyba' : 'uspech'
        ];
    }
}
