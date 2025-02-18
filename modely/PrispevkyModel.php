<?php

require_once('modely/Databaze.php');
class PrispevkyModel {
    public function vypisPrispevky(): array {
        Databaze::pripoj('localhost', 'root', '', 'maturita');
    return Databaze::dotazVsechny("SELECT * FROM post inner join room on post.room_id = room.id WHERE room.public = 1 ORDER BY post.id DESC") ?? [];
    }
}