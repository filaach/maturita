<?php

/*  _____ _______         _                      _
 * |_   _|__   __|       | |                    | |
 *   | |    | |_ __   ___| |___      _____  _ __| | __  ___ ____
 *   | |    | | '_ \ / _ \ __\ \ /\ / / _ \| '__| |/ / / __|_  /
 *  _| |_   | | | | |  __/ |_ \ V  V / (_) | |  |   < | (__ / /
 * |_____|  |_|_| |_|\___|\__| \_/\_/ \___/|_|  |_|\_(_)___/___|
 *
 *                      ___ ___ ___
 *                     | . |  _| . |  LICENCE
 *                     |  _|_| |___|
 *                     |_|
 *
 *    REKVALIFIKAČNÍ KURZY  <>  PROGRAMOVÁNÍ  <>  IT KARIÉRA
 *
 * Tento zdrojový kód je součástí profesionálních IT kurzů na
 * WWW.ITNETWORK.CZ
 *
 * Kód spadá pod licenci PRO obsahu a vznikl díky podpoře
 * našich členů. Je určen pouze pro osobní užití a nesmí být šířen.
 * Více informací na http://www.itnetwork.cz/licence
 */

/**
 * Třída poskytuje metody pro správu článků v redakčním systému
 */
class SpravceClanku
{

	/**
	 * Vrátí článek z databáze podle jeho URL
	 * @param string $url URL článku k zobrazení
	 * @return array Data článku z databáze jako asociativní pole
	 */
	public function vratClanek(string $url): array
	{
		return Databaze::dotazJeden('
			SELECT `clanky_id`, `titulek`, `obsah`, `url`, `popisek`, `klicova_slova`
			FROM `clanky` 
			WHERE `url` = ?
		', array($url));
	}

	/**
	 * Uloží článek do systému. Pokud je ID false, vloží nový, jinak provede editaci.
	 * @param int|bool $id ID článku k editaci, FALSE pro vložení nového článku
	 * @param array $clanek Asociativní pole s informacemi o článku
	 * @return void
	 */
	public function ulozClanek(int|bool $id, array $clanek): void
	{
		if (!$id)
        Databaze::vloz('clanky', $clanek);
		else
        Databaze::zmen('clanky', $clanek, 'WHERE clanky_id = ?', array($id));
	}

	/**
	 * Vrátí seznam článků v databázi
	 * @return array Základní informace o všech článcích jako numerické pole asociativních polí
	 */
	public function vratClanky(): array
	{
		return Databaze::dotazVsechny('
			SELECT `clanky_id`, `titulek`, `url`, `popisek`
			FROM `clanky` 
			ORDER BY `clanky_id` DESC
		');
	}

	/**
	 * Odstraní článek
	 * @param string $url URL článku k odstranění
	 * @return void
	 */
	public function odstranClanek(string $url): void
	{
		Databaze::dotaz('
			DELETE FROM clanky
			WHERE url = ?
		', array($url));
	}

}