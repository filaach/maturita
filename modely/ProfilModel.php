<?php
class ProfilModel
{
    // TODO profil

    public function nactiPrispevkyUzivatele(int $userId): array
    {
        Databaze::pripoj('localhost', 'root', 'ABCabc123', 'maturita');
        return Databaze::dotazVsechny("SELECT * FROM post WHERE user_id = ? AND room_id = 1", [$userId]);
    }

    public function smazPrispevek(int $postId): void
    {
        Databaze::pripoj('localhost', 'root', 'ABCabc123', 'maturita');
        Databaze::dotaz("DELETE FROM post WHERE id = ?", [$postId]);
        return;
    }
}
