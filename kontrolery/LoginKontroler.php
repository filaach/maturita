<?php
class LoginKontroler extends Kontroler{
    public function zpracuj(array $parametry): void{
        $this->hlavicka['titulek'] = 'Login'; 
        $this->hlavicka['popis'] = 'Login'; 
        $this->hlavicka['klicova_slova'] = 'login'; 
        $this->pohled = 'login'; 
    }
    
} 