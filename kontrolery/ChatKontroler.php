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
            'stylesheet' => 'styles/chatStyles.css',
            'skripty' => []
        ];

        $chatModel = new ChatModel();

        // Načtení seznamu uživatelů
        if (!isset($parametry['prijemce_id'])) {
            $this->data['uzivatele'] = $chatModel->nactiUzivatele();
        } else {
            // Načtení zpráv pro konkrétního uživatele
            $odesilatelId = $_SESSION['uzivatel_id'] ?? 1; // Nastavte ID aktuálního uživatele (např. 1)
            $prijemceId = (int)$parametry['prijemce_id'];

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['zprava'])) {
                $chatModel->ulozitZpravu($odesilatelId, $prijemceId, $_POST['zprava']);
            }

            $this->data['zpravy'] = $chatModel->nactiZpravy($odesilatelId, $prijemceId);
            $this->data['prijemce'] = $chatModel->nactiUzivatelePodleId($prijemceId);
        }

        // Pohled
        $this->pohled = 'chat';
    }
}
