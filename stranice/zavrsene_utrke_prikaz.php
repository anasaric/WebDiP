<?php
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Zavrsene utrke";
include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();

$korisnicko_ime = $_SESSION['korisnik'];
$query_select = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result_select = $baza->selectDB($query_select);
$row = $result_select->fetch_assoc();
$id = $row['korisnik_id'];
$query = "SELECT * FROM `bodovno_stanje` INNER JOIN `etapa` ON `etapa`.etapa_id=`bodovno_stanje`.etapa_id  INNER JOIN `utrka` ON `utrka`.utrka_id=`etapa`.utrka_id INNER JOIN `drzava` ON `drzava`.drzava_id=`utrka`.drzava_id WHERE `bodovno_stanje`.korisnik_id='".$id."'";

$result = $baza->selectDB($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $etapa_id=$row['etapa_id'];
        $naziv_etape=$row['naziv_etape'];
        $opis_etape=$row['opis_etape'];
        $vrijeme=$row['vrijeme'];
        $mjesto=$row['mjesto'];
        $bodovi=$row['bodovi'];
        $naziv_drzave=$row['naziv_drzave'];
        $pocetak_utrke=$row['pocetak_utrke'];
        $zakljucano=$row['zakljucano'];
        $podatci[]=array("etapa_id"=>$etapa_id,
                        "naziv_etape"=>$naziv_etape,
                        "opis_etape"=>$opis_etape,
                        "vrijeme"=>$vrijeme,
                        "mjesto"=>$mjesto,
                        "bodovi"=>$bodovi,
                        "naziv_drzave"=>$naziv_drzave,
                        "pocetak_utrke"=>$pocetak_utrke,
                        "zakljucano"=>$zakljucano);
    } 
    echo json_encode($podatci);
} 

$baza->zatvoriDB();
