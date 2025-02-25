<?php

require_once('modely/Databaze.php');
class PrispevkyModel
{
    public function vypisPrispevky(): array
    {
        if(isset($_GET['hledat']))
            $username = $_GET['hledat'];
        else
            $username = null;
        Databaze::pripoj('localhost', 'root', '', 'maturita');
        return Databaze::dotazVsechny("SELECT * FROM post inner join room on post.room_id = room.id INNER JOIN user ON post.user_id = user.id WHERE room.public = 1 " . ($username ? ("AND user.userName LIKE '%" . $username . "%' ") : "") . "ORDER BY post.id DESC") ?? [];
    }
}