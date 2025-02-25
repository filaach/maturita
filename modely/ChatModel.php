<?php

class ChatModel
{
    public function vypisUzivatele(): array
    {

        Databaze::pripoj('localhost', 'root', '', 'maturita');
        if (isset($_GET['hledat']))
            return Databaze::dotazVsechny("SELECT * FROM user WHERE userName LIKE ? AND id != ?", ["%" . $_GET['hledat'] . "%", $_SESSION['user_id']]) ?? [];
        else
            return Databaze::dotazVsechny("SELECT * FROM user WHERE id != ?", [$_SESSION['user_id']]) ?? [];
    }
    public function vypisZpravy(int $userId, int $receiverId): array
    {

        Databaze::pripoj('localhost', 'root', '', 'maturita');
        return Databaze::dotazVsechny("SELECT p.* FROM post AS p WHERE p.room_id IN (SELECT r.id FROM room AS r JOIN user_has_room AS uhr ON r.id = uhr.room_id WHERE uhr.user_id IN (?, ?) AND r.public = 0 GROUP BY r.id HAVING COUNT(DISTINCT uhr.user_id) = 2)", [$userId, $receiverId]) ?? [];
    }
    public function ulozZpravu(int $userId, int $receiverId, string $zprava): void
    {
        $room = $this->vypisMistnost($userId, $receiverId);
        if(!$room)
        {
            $room['id'] = Databaze::vloz("INSERT INTO room (public) VALUES (0)");
            Databaze::vloz("INSERT INTO user_has_room (user_id, room_id) VALUES (?, ?), (?, ?)", [$userId, $room['id'], $receiverId, $room['id']]);
        }
        Databaze::vloz("INSERT INTO post (user_id, room_id, text) VALUES (?, ?, ?)", [$userId, $room['id'], $zprava]);
        return;
    }

    private function vypisMistnost(int $userId, int $receiverId): array|bool
    {

        Databaze::pripoj('localhost', 'root', '', 'maturita');
        return Databaze::dotazJeden("SELECT r.id FROM room AS r JOIN user_has_room AS uhr ON r.id = uhr.room_id WHERE uhr.user_id IN (?, ?) AND r.public = 0 GROUP BY r.id HAVING COUNT(DISTINCT uhr.user_id) = 2", [$userId, $receiverId]);
    }
}
