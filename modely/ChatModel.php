<?php

class ChatModel
{
    private PDO $db;

    public function __construct()
    {
        $host = '127.0.0.1';
        $dbname = 'maturita'; // Změňte na vaši databázi
        $username = 'root';
        $password = '';

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Chyba připojení k databázi: ' . $e->getMessage());
        }
    }

    /**
     * Načte všechny uživatele.
     *
     * @return array Seznam uživatelů.
     */
    public function nactiUzivatele(): array
    {
        $stmt = $this->db->query('SELECT id, jmeno FROM uzivatele');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Načte uživatele podle ID.
     *
     * @param int $id ID uživatele.
     * @return array Data uživatele.
     */
    public function nactiUzivatelePodleId(int $id): array
    {
        $stmt = $this->db->prepare('SELECT id, jmeno FROM uzivatele WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Načte zprávy mezi dvěma uživateli.
     *
     * @param int $odesilatelId ID odesílatele.
     * @param int $prijemceId ID příjemce.
     * @return array Seznam zpráv.
     */
    public function nactiZpravy(int $odesilatelId, int $prijemceId): array
    {
        $stmt = $this->db->prepare(
            'SELECT * FROM zpravy 
             WHERE (odesilatel_id = :odesilatel AND prijemce_id = :prijemce)
                OR (odesilatel_id = :prijemce AND prijemce_id = :odesilatel)
             ORDER BY cas ASC'
        );
        $stmt->execute([
            ':odesilatel' => $odesilatelId,
            ':prijemce' => $prijemceId,
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Uloží zprávu do databáze.
     *
     * @param int $odesilatelId ID odesílatele.
     * @param int $prijemceId ID příjemce.
     * @param string $zprava Text zprávy.
     */
    public function ulozitZpravu(int $odesilatelId, int $prijemceId, string $zprava): void
    {
        $stmt = $this->db->prepare(
            'INSERT INTO zpravy (odesilatel_id, prijemce_id, zprava) 
             VALUES (:odesilatel, :prijemce, :zprava)'
        );
        $stmt->execute([
            ':odesilatel' => $odesilatelId,
            ':prijemce' => $prijemceId,
            ':zprava' => $zprava,
        ]);
    }
}
