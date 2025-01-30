<?php

class PrispevkyModel
{
    private PDO $db;

    /**
     * Konstruktor pro připojení k databázi.
     */
    public function __construct()
    {
        $host = '127.0.0.1';
        $dbname = 'maturita';
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
     * Uloží nový příspěvek do databáze.
     *
     * @param string $obsah Obsah příspěvku.
     * @param string $typ Typ příspěvku (např. "cviceni" nebo "jidlo").
     * @param string|null $soubor Cesta k nahranému souboru (obrázek nebo video).
     */
    public function ulozitPrispevek(string $obsah, string $typ, ?string $soubor = null): void
    {
        $stmt = $this->db->prepare('INSERT INTO prispevky (obsah, typ, soubor) VALUES (:obsah, :typ, :soubor)');
        $stmt->execute([
            ':obsah' => $obsah,
            ':typ' => $typ,
            ':soubor' => $soubor,
        ]);
    }

    /**
     * Načte všechny příspěvky z databáze.
     *
     * @return array Seznam příspěvků.
     */
    public function nactiPrispevky(): array
{
    $stmt = $this->db->query('SELECT * FROM prispevky ORDER BY datum DESC');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    /**
     * Smaže příspěvek podle ID.
     *
     * @param int $id ID příspěvku.
     */
    public function smazatPrispevek(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM prispevky WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }
}
