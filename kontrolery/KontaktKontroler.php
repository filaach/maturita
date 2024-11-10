<?php

class KontaktKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        $this->hlavicka = array(
            'titulek' => 'Kontaktní formulář',
            'klicova_slova' => 'kontakt, email, formulář',
            'popis' => 'Kontaktní formulář našeho webu.'
        );

        if (isset($_POST["email"])) {
            if ($_POST['rok'] == date("Y")) {
                $odesilacEmailu = new OdesilacEmailu();
                $odesilacEmailu->odesli("test@netlogy.cz", "Email z webu", $_POST['zprava'], $_POST['email']);
            }
        }

        $this->pohled = 'kontakt';
    }
}