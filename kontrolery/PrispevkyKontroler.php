<?php
require_once("modely/PrispevkyModel.php");
class PrispevkyKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        $this->hlavicka = [
            'titulek' => 'Příspěvky',
            'popis' => 'Stránka pro príspěvky',
            'klicova_slova' => 'login, příspěvky, fotky',
            'stylesheet' => 'prispevkyStyles.css',
            'skripty' => ['scroll.js']

        ];
        $this->pohled = 'prispevky';

        $this->prispevkyModel = new PrispevkyModel();

        $this->data['prispevky'] = $this->prispevkyModel->vypisPrispevky();


        if (isset($parametry[0])) {
            if ($parametry[0] == 'like') {
                $this->prispevkyModel->like($parametry[1]);
                header('Location: /prispevky?setScroll=' . $_GET['scroll']);
                exit;
            }
        }

    }

} 