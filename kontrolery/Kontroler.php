<?php
abstract class Kontroler
{
    protected array $data = array();
    protected string $pohled = "";
    protected array $hlavicka = array('titulek' => '', 'klicova_slova' => '', 'popis' => '');
    abstract function zpracuj(array $parametry): void;
    public function vypisPohled(): void
    {
        if ($this->pohled) {
            extract($this->data);
            extract($this->data, EXTR_PREFIX_ALL, "");
            require("pohledy/" . $this->pohled . ".phtml");
        }
    }

    public function presmeruj(string $url): never
    {
        header("Location: /$url");
        header("Connection: close");
        exit;
    }

    private function osetri(mixed $x = null): mixed
    {
        if (!isset($x))
            return null;
        elseif (is_string($x))
            return htmlspecialchars($x, ENT_QUOTES);
        elseif (is_array($x)) {
            foreach ($x as $k => $v) {
                $x[$k] = $this->osetri($v);
            }
            return $x;
        } else
            return $x;
    }
}
