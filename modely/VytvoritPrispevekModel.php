<?php

class VytvoritPrispevekModel{

    public function vytvoritPrispevek(): void {
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);

        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $obsah = $_POST['obsah'] ?? '';
            $typ = $_POST['typ'] ?? '';
    
            $soubor = null;
            if (!empty($_FILES['soubor']['name'])) {
                $souborCesta = 'uploads/' . basename($_FILES['soubor']['name']);
                $souborTyp = strtolower(pathinfo($souborCesta, PATHINFO_EXTENSION));
    
                $povoleneTypy = ['jpg', 'jpeg', 'png', 'gif'];
    
                if (in_array($souborTyp, $povoleneTypy)) {
                    if (move_uploaded_file($_FILES['soubor']['tmp_name'], $souborCesta)) {
                        $soubor = $souborCesta;
                    } else {
                        header('Location: vytvoritPrispevek?zprava=chyba');
                        exit;
                    }
                } else {
                    header('Location: vytvoritPrispevek?zprava=chyba');
                    exit;
                }
            }
    
            if (!empty($obsah) && !empty($typ)) {
                Databaze::pripoj('localhost', 'root', '', 'maturita');
                Databaze::vloz("INSERT INTO post (text, type, picture, room_id, user_id) VALUES (:obsah, :typ, :soubor, :room_id, :user_id)", array(':obsah' => $obsah, ':typ' => $typ, ':soubor' => $soubor, ':room_id' => 1, ':user_id' => $_SESSION['user_id'] ?? 1));
                header('Location: vytvoritPrispevek?zprava=uspech');
                exit;
                
            
            } else {
                header('Location: vytvoritPrispevek?zprava=chyba');
                exit;
            }


        }
    

}

}