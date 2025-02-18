<?php
session_start();
mb_internal_encoding("utf-8");

function autoloadFunkce(string $trida): void
{
    if (preg_match('/Kontroler$/', $trida))
        require("kontrolery/" . $trida . ".php");
    else
        require("modely/" . $trida . ".php");
}

spl_autoload_register("autoloadFunkce");

Databaze::pripoj('localhost','root','','maturita');

$smerovac = new SmerovacKontroler();
$smerovac->zpracuj(array($_SERVER['REQUEST_URI']));
$smerovac->vypisPohled();

