<?php
class OdesilacEmailu
{

    /**
     * Odešle email jako HTML, lze tedy používat základní HTML tagy a nové
     * řádky je třeba psát jako <br /> nebo používat odstavce. Kódování je
     * odladěno pro UTF-8.
     * @param string $komu E-mailová adresa příjemce
     * @param string $predmet Předmět e-mailu
     * @param string $zprava Obsah e-mailu jako HTML řetězec
     * @param string $od E-mailová adresa odesílatele
     * @return bool TRUE, pokud se odeslání e-mailu podařilo, FALSE, pokud ne
     */
    public function odesli(string $komu, string $predmet, string $zprava, string $od): bool
    {
        $hlavicka = "From: " . $od;
        $hlavicka .= "\nMIME-Version: 1.0\n";
        $hlavicka .= "Content-Type: text/html; charset=\"utf-8\"\n";
        return mb_send_mail($komu, $predmet, $zprava, $hlavicka);
    }
}