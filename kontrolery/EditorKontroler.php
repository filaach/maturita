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
 * Kontroler pro výpis článků
 */
class EditorKontroler extends Kontroler
{
	/**
	 * Zpracuje článek editoru
	 * @param array $parametry Parametry
	 * @return void
	 */
	public function zpracuj(array $parametry): void
	{
		// Editor smí používat jen administrátoři
		//$this->overUzivatele(true);
		// Hlavička stránky
		$this->hlavicka['titulek'] = 'Editor článků';
		// Vytvoření instance modelu
		$spravceClanku = new SpravceClanku();
		// Příprava prázdného článku
		$clanek = array(
			'clanky_id' => '',
			'titulek' => '',
			'obsah' => '',
			'url' => '',
			'popisek' => '',
			'klicova_slova' => '',
		);
		// Je odeslán formulář
		if ($_POST) {
			// Získání článku z $_POST
			$klice = array('titulek', 'obsah', 'url', 'popisek', 'klicova_slova');
			$clanek = array_intersect_key($_POST, array_flip($klice));
			// Uložení článku do DB
			$spravceClanku->ulozClanek($_POST['clanky_id'], $clanek);
			$this->pridejZpravu('Článek byl úspěšně uložen.');
			$this->presmeruj('clanek/' . $clanek['url']);
		} else if (!empty($parametry[0])) {
			// Je zadané URL článku k editaci
			$nactenyClanek = $spravceClanku->vratClanek($parametry[0]);
			if ($nactenyClanek)
				$clanek = $nactenyClanek;
			else
				$this->pridejZpravu('Článek nebyl nalezen');
		}

		$this->data['clanek'] = $clanek;
		$this->pohled = 'editor';
	}
}