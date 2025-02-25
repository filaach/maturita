<?php

class ChatKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        // Nastavení hlavičky stránky
        $this->hlavicka = [
            'titulek' => 'Chatovací místnost',
            'popis' => 'Seznam uživatelů a chat mezi nimi.',
            'klicova_slova' => 'chat, zprávy, uživatelé',
            'stylesheet' => 'chatStyles.css',
            'skripty' => []
        ];

        if (!isset($_SESSION['user_id'])) {
            $this->presmeruj('login');
            exit;
        }

        $chatModel = new ChatModel();

        if (isset($parametry[0]) && is_numeric($parametry[0]))
            $this->data['uzivatel'] = $parametry[0];

        $this->data['uzivatele'] = $chatModel->vypisUzivatele();

        if (isset($_POST['zprava'])) {
            $chatModel->ulozZpravu($_SESSION['user_id'], $parametry[0], $_POST['zprava']);
        }

        if (isset($parametry[0]) && is_numeric($parametry[0])) {
            $this->data['zpravy'] = $chatModel->vypisZpravy($_SESSION['user_id'], $parametry[0]);
        }


        $this->pohled = 'chat';
    }
}
