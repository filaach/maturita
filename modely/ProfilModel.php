<?php
class ProfilModel
{
    // Načte informace o uživateli
    public function nactiUzivatele(int $userId): ?array
    {
        return ['id' => 1, 'userName' => "test", 'email' => "test@test.cz", 'bio' => "test", 'profilovka' => "pfp/muz3.png"];//Databaze::dotazJeden("SELECT id, userName, email, bio, profilovka FROM user WHERE id = ?", [$userId]);
    }

    // Změní profilovou fotku uživatele
    public function zmenProfilovku(int $userId, string $profilovaFotka): void
    {
        Databaze::dotaz("UPDATE user SET profilovka = ? WHERE id = ?", [$profilovaFotka, $userId]);
    }

    // Změní bio uživatele
    public function zmenBio(int $userId, string $bio): void
    {
        Databaze::dotaz("UPDATE user SET bio = ? WHERE id = ?", [$bio, $userId]);
    }

    // Načte všechny příspěvky uživatele
    public function nactiPrispevkyUzivatele(int $userId): array
    {
        return Databaze::dotazVsechny("SELECT * FROM post WHERE user_id = ?", [$userId]);
    }
}
