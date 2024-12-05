<?php

$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Statistika etapa";
include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();

$korisnicko_ime = $_SESSION['korisnik'];
$query_select = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result_select = $baza->selectDB($query_select);
$row = $result_select->fetch_assoc();
$id = $row['korisnik_id'];

$datum = date("Y-m-d H:i:s");
$upit = "sortiranje statistike etapa po kontinentu";
$tekst = $naddirektorij . "stranice/statistika_etape.php";
$dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
$baza->updateDB($dnevnik_insert);

$query="SELECT `drzava`.kontinent, `drzava`.naziv_drzave, COUNT(`drzava`.naziv_drzave) as `broj_zavrsenih_etapa`, SUM(`bodovno_stanje`.bodovi) AS `ostvareni_bodovi`, `etapa`.pocetak_utrke FROM `bodovno_stanje` INNER JOIN `etapa` ON `etapa`.etapa_id=`bodovno_stanje`.etapa_id INNER JOIN `utrka` ON `utrka`.utrka_id=`etapa`.utrka_id INNER JOIN `drzava` ON `drzava`.drzava_id=`utrka`.drzava_id WHERE `bodovno_stanje`.korisnik_id='".$id."' GROUP BY `drzava`.naziv_drzave ORDER BY `drzava`.kontinent";
$result = $baza->selectDB($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $kontinent=$row['kontinent'];
        $naziv_drzave=$row['naziv_drzave'];
        $broj_zavrsenih_etapa=$row['broj_zavrsenih_etapa'];
        $ostvareni_bodovi=$row['ostvareni_bodovi'];
        $pocetak_utrke=$row['pocetak_utrke'];
        $podatci[]=array("kontinent"=>$kontinent,
                        "naziv_drzave"=>$naziv_drzave,
                        "broj_zavrsenih_etapa"=>$broj_zavrsenih_etapa,
                        "ostvareni_bodovi"=>$ostvareni_bodovi,
                        "pocetak_utrke"=>$pocetak_utrke);
    } 
    echo json_encode($podatci);
} 

$baza->zatvoriDB();
