<?php
class UcetModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Databaze::pripoj('localhost', 'root', '', 'maturita');
    }

    /**
     * Načte informace o uživateli podle ID.
     */
    public function nactiUzivatele(int $userId): array
    {
        $dotaz = "SELECT id, userName AS jmeno, email FROM user WHERE id = ?";
        return Databaze::dotazJeden($dotaz, [$userId]) ?? [];
    }

    /**
     * Upraví údaje uživatele (jméno, email).
     */
    public function upravUzivatele(int $userId, string $jmeno, string $email): void
    {
        $dotaz = "UPDATE user SET userName = ?, email = ? WHERE id = ?";
        Databaze::dotaz($dotaz, [$jmeno, $email, $userId]);
    }

    /**
     * Změní heslo uživatele.
     */
    public function zmenHeslo(int $userId, string $noveHeslo): void
    {
        $hashedPassword = password_hash($noveHeslo, PASSWORD_BCRYPT);
        $dotaz = "UPDATE user SET password = ? WHERE id = ?";
        Databaze::dotaz($dotaz, [$hashedPassword, $userId]);
    }
}
