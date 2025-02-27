<?php
class OdhlasitKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        session_destroy();
        $this->presmeruj('login');


    }



}