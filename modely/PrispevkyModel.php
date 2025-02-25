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
        if(isset($_SESSION['user_id']) && isset($_GET['liked']))
            $liked = true;
        else
            $liked = false;
        Databaze::pripoj('localhost', 'root', '', 'maturita');
        return Databaze::dotazVsechny("SELECT post.id, user.userName, post.text, post.type, post.dateOfCreation, post.picture, user_post_like.user_id FROM post inner join room on post.room_id = room.id INNER JOIN user ON post.user_id = user.id left join user_post_like on post.id = user_post_like.post_id WHERE room.public = 1 " . ($liked ? ("AND user_post_like.user_id = " . $_SESSION['user_id'] . " ") : "") . ($username ? ("AND user.userName LIKE ? ") : "") . "ORDER BY post.id DESC", $username == null ? [] : ["%" . $username . "%"]) ?? [];
        
    }
    public function like(string $postId): void
    {
        if(!isset($_SESSION['user_id'])){
            header('Location: /login');
            exit;
        }
        Databaze::pripoj('localhost', 'root', '', 'maturita');
        $result = Databaze::dotazJeden("SELECT * FROM user_post_like WHERE post_id = ? AND user_id = ?", [$postId, $_SESSION['user_id']]);
        if($result == false) 
            Databaze::vloz("INSERT INTO user_post_like (post_id, user_id) VALUES (?, ?)", [$postId, $_SESSION['user_id']]);
        else
            Databaze::dotaz("DELETE FROM user_post_like WHERE post_id = ? AND user_id = ?", [$postId, $_SESSION['user_id']]);
        return;
    }
}