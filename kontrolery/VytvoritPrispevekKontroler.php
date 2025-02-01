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

        $this->pohled = 'vytvoritPrispevek';

        $this->vytvoritPrispevekModel = new VytvoritPrispevekModel();

        $this->vytvoritPrispevekModel->vytvoritPrispevek();

        
    }
}
