<?php
require_once("modely/TestModel.php");
class TestKontroler extends Kontroler
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
        $this->pohled = 'test';

        $this->testModel = new TestModel();

        $this->data['str'] = $this->testModel->vypisPrispevky();

    }

} 