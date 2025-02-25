<?php

class ChatModel
{
    private PDO $db;

    public function __construct()
    {
        // Ověříme, že se připojení skutečně vrátilo
        $this->db = Databaze::pripoj('localhost', 'root', '', 'maturita');
        if (!$this->db) {
            throw new Exception("Nepodařilo se připojit k databázi.");
        }
    }

    public function nactiUzivatele(int $userId): array
    {
        $stmt = $this->db->prepare('SELECT userName, email FROM user WHERE id = ?');
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function upravUzivatele(int $userId, string $jmeno, string $email): void
    {
        $stmt = $this->db->prepare('UPDATE user SET userName = ?, email = ? WHERE id = ?');
        $stmt->execute([$jmeno, $email, $userId]);
    }

    public function zmenHeslo(int $userId, string $noveHeslo): void
    {
        $hashedHeslo = password_hash($noveHeslo, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare('UPDATE user SET password = ? WHERE id = ?');
        $stmt->execute([$hashedHeslo, $userId]);
    }
}
