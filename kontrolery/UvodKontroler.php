<?php
class UvodKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        Databaze::pripoj('localhost', 'root', '', 'maturita');
        $this->hlavicka = [
            'titulek' => 'Úvod',
            'popis' => 'Stránka pro správu úvodu',
            'klicova_slova' => 'úvod, informace, info',
            'stylesheet' => 'uvodStyles.css',
            'skripty' => []
        ];

        $this->pohled = 'uvod';

        $uvodModel = new UvodModel();
        $uvod = $uvodModel->vratUvod();
        $this->data['uvod'] = $uvod;



    }

    

}