<?php

class EditorKontroler extends Kontroler
{
	public function zpracuj(array $parametry): void
	{
		if (!isset($_SESSION['user_id']))
			$this->presmeruj('login');
		if (isset($_SESSION['user_name']) && $_SESSION['user_name'] != 'admin')
			$this->presmeruj('ucet');

		$this->hlavicka = [
			'titulek' => 'Editor úvodu',
			'popis' => 'Stránka pro editování úvodu',
			'skripty' => [],
			'stylesheet' => 'editorStyles.css',
		];

		$editorModel = new EditorModel();

		if (isset($_POST['uvod'])) {
			$editorModel->ulozit($_POST['uvod']);
			header('Location: /editor');
			exit;
		}


		$this->data['uvod'] = $editorModel->vratUvod();
		$this->pohled = 'editor';
	}
}