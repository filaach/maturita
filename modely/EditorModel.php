<?php
class EditorModel
{
	public function vratUvod()
	{
		$myfile = fopen("uvod.txt", "r") or die("Unable to open file!");
		$data = fread($myfile, filesize("uvod.txt"));
		fclose($myfile);

		return $data;
	}

	public function ulozit($uvod)
	{
		$myfile = fopen("uvod.txt", "w") or die("Unable to open file!");
		fwrite($myfile, $uvod);
		fclose($myfile);
	}
}