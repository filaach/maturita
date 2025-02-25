<?php


 /* Kontroler pro výpis článku nebo jejich seznamu
 */
class ClanekKontroler extends Kontroler
{
	/**
	 * Zpracuje článek
	 * @param array $parametry Parametry
	 * @return void
	 */
	public function zpracuj(array $parametry): void
	{
		// Vytvoření instance modelu, který nám umožní pracovat s články
		$spravceClanku = new SpravceClanku();
		$spravceUzivatelu = new SpravceUzivatelu();
		$uzivatel = $spravceUzivatelu->vratUzivatele();
		$this->data['admin'] = $uzivatel && $uzivatel['admin'];

		// Je zadáno URL článku ke smazání
		if (!empty($parametry[1]) && $parametry[1] == 'odstranit') {
			$this->overUzivatele(true);
			$spravceClanku->odstranClanek($parametry[0]);
			$this->pridejZpravu('Článek byl úspěšně odstraněn');
			$this->presmeruj('clanek');
		} else if (!empty($parametry[0])) {
			// Je zadáno URL článku k zobrazení
			// Získání článku podle URL
			$clanek = $spravceClanku->vratClanek($parametry[0]);
			// Pokud nebyl článek s danou URL nalezen, přesměrujeme na ChybaKontroler
			if (!$clanek)
				$this->presmeruj('chyba');

			// Hlavička stránky
			$this->hlavicka = array(
				'titulek' => $clanek['titulek'],
				'klicova_slova' => $clanek['klicova_slova'],
				'popis' => $clanek['popisek'],
			);

			// Naplnění proměnných pro šablonu		
			$this->data['titulek'] = $clanek['titulek'];
			$this->data['obsah'] = $clanek['obsah'];

			// Nastavení šablony
			$this->pohled = 'clanek';
		} else {
			// Není zadáno URL článku, vypíšeme všechny
			$clanky = $spravceClanku->vratClanky();
			$this->data['clanky'] = $clanky;
			$this->pohled = 'clanky';
		}
	}
}