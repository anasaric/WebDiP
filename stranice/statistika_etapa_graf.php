<?php

$naddirektorij = dirname(getcwd());
$putanja = dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov = "Statistika etapa";

include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();


$korisnicko_ime = $_SESSION['korisnik'];
$query_select = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result_select = $baza->selectDB($query_select);
$row = $result_select->fetch_assoc();
$id = $row['korisnik_id'];

$query_check="SELECT `drzava`.naziv_drzave, COUNT(`drzava`.naziv_drzave) as `broj_zavrsenih_etapa` FROM `bodovno_stanje` INNER JOIN `etapa` ON `etapa`.etapa_id=`bodovno_stanje`.etapa_id INNER JOIN `utrka` ON `utrka`.utrka_id=`etapa`.utrka_id INNER JOIN `drzava` ON `drzava`.drzava_id=`utrka`.drzava_id WHERE `bodovno_stanje`.korisnik_id='".$id."' GROUP BY `drzava`.naziv_drzave ";
$result_check = $baza->selectDB($query_check);
if ($result_check->num_rows > 0) {
    while ($row = $result_check->fetch_assoc()) {
            $naziv_drzave = $row['naziv_drzave'];
            $broj_zavrsenih_etapa = $row['broj_zavrsenih_etapa'];
            $podatci[] = array("naziv_drzave" => $naziv_drzave,
                        "broj_zavrsenih_etapa" => $broj_zavrsenih_etapa);
    }
    echo json_encode($podatci);
}

$baza->zatvoriDB();
