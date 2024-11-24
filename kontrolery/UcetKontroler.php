<?php
class UcetKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        Databaze::pripoj('localhost', 'root', '', 'maturita');
        $this->hlavicka = [
            'titulek' => 'Účet',
            'popis' => 'Stránka pro správu účtu',
            'klicova_slova' => 'úřet, login, registrace, přihlášení, správa, nastavení',
            'stylesheet' => 'ucetStyles.css',
            'skripty' => []
        ];

        if (empty($parametry[0]))
            $parametry[0] = 'nastaveni';

        if ($parametry[0] == 'statistiky') {
            $this->data['comentCount'] = Databaze::dotaz("SELECT COUNT(*) AS referenced_posts_count FROM maturita.post p1 WHERE p1.post_id IN ( SELECT p2.id FROM maturita.post p2 WHERE p2.user_id = ? );", [1]);

        }

        $this->pohled = 'ucet/' . $parametry[0];



    }


}