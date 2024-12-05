<?php

class dnevnik {

    private $nazivDatoteke = "izvorne_datoteke/dnevnik.log";

    public function setNazivDatoteke($nazivDatoteke) {
        $this->nazivDatoteke = $nazivDatoteke;
    }

    public function spremiDnevnik($tekst) {
        $f = fopen($this->nazivDatoteke, "a+");
        fwrite($f, date("d.m.Y H:i:s") . " " . $tekst . "\n");
        fclose($f);
    }

    public function citajDnevnik() {
        return file($this->nazivDatoteke);
    }

}
