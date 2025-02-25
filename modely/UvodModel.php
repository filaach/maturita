<?php
class UvodModel
{
    public function vratUvod()
    {
        $myfile = fopen("uvod.txt", "r") or die("Unable to open file!");
        $data = fread($myfile, filesize("uvod.txt"));
        fclose($myfile);

        return $data;
    }
}