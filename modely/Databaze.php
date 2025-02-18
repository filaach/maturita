<?php
class Databaze
{
    private static ?PDO $spojeni = null; // Povolit možnost null pro lepší kontrolu
    
    private static array $nastaveni = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false,
    );

    public static function pripoj(string $host, string $uzivatel, string $heslo, string $databaze): PDO
    {
        if (self::$spojeni === null) {
            try {
                self::$spojeni = new PDO(
                    "mysql:host=$host;dbname=$databaze;charset=utf8",
                    $uzivatel,
                    $heslo,
                    self::$nastaveni
                );
            } catch (PDOException $e) {
                die('Chyba připojení k databázi: ' . $e->getMessage());
            }
        }
        return self::$spojeni;
    }

    public static function dotazJeden(string $dotaz, array $parametry = array()): array|bool
    {
        $navrat = self::$spojeni->prepare($dotaz);
        $navrat->execute($parametry);
        return $navrat->fetch(PDO::FETCH_ASSOC);
    }

    public static function dotazVsechny(string $dotaz, array $parametry = array()): array|bool
    {
        $navrat = self::$spojeni->prepare($dotaz);
        $navrat->execute($parametry);
        return $navrat->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function dotazSamotny(string $dotaz, array $parametry = array()): string
    {
        $vysledek = self::dotazJeden($dotaz, $parametry);
        return $vysledek[0] ?? '';
    }

    public static function dotaz(string $dotaz, array $parametry = array()): int
    {
        $navrat = self::$spojeni->prepare($dotaz);
        $navrat->execute($parametry);
        return $navrat->rowCount();
    }

    public static function vloz(string $dotaz, array $parametry = array()): int
    {
        $navrat = self::$spojeni->prepare($dotaz);
        $navrat->execute($parametry);
        return self::$spojeni->lastInsertId();
    }


    
}
