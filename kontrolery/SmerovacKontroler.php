<?php

class SmerovacKontroler extends Kontroler
{

    protected Kontroler $kontroler;

    public function zpracuj(array $parametry): void
    {
        $naparsovanaURL = $this->parsujURL($parametry[0]);

        if (empty($naparsovanaURL[0]))
            $this->presmeruj('prispevky');

        $tridaKontroleru = $this->pomlckyDoVelbloudiNotace(array_shift($naparsovanaURL)) . 'Kontroler';

        if (file_exists('kontrolery/' . $tridaKontroleru . '.php'))
            $this->kontroler = new $tridaKontroleru;
        else
            $this->presmeruj('chyba');

        $this->kontroler->zpracuj($naparsovanaURL);

        $skripty = [];

        foreach ($this->kontroler->hlavicka['skripty'] as $skript) {
            array_push($skripty, '<script type="text/javascript" src="skripty/' . $skript . '"></script>');
        }

        $this->data['titulek'] = $this->kontroler->hlavicka['titulek'] ?? 'Výchozí titulek';
$this->data['popis'] = $this->kontroler->hlavicka['popis'] ?? 'Výchozí popis';
$this->data['klicova_slova'] = $this->kontroler->hlavicka['klicova_slova'] ?? 'Výchozí klíčová slova';
$this->data['stylesheet'] = $this->kontroler->hlavicka['stylesheet'] ?? 'styles/defaultStyles.css'; // Výchozí styl
$this->data['skripty'] = isset($this->kontroler->hlavicka['skripty']) ? 
    join("\n", array_map(fn($skript) => '<script type="text/javascript" src="skripty/' . $skript . '"></script>', $this->kontroler->hlavicka['skripty'])) 
    : '';


        $this->pohled = 'rozlozeni';

    }

    private function parsujURL(string $url): array
    {
        $naparsovanaURL = parse_url($url);
        $naparsovanaURL["path"] = ltrim($naparsovanaURL["path"], "/");
        $naparsovanaURL["path"] = trim($naparsovanaURL["path"]);
        $rozdelenaCesta = explode("/", $naparsovanaURL["path"]);
        return $rozdelenaCesta;
    }

    private function pomlckyDoVelbloudiNotace(string $text): string
    {
        $veta = str_replace("-", " ", $text);
        $veta = ucwords($veta);
        $veta = str_replace(" ", "", $veta);
        return $veta;
    }
}