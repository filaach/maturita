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
            'skripty' => []

        ];
        $this->pohled = 'prispevky';

        $this->prispevkyModel = new PrispevkyModel();

        $this->data['prispevky'] = $this->prispevkyModel->vypisPrispevky();
        
    }

} 