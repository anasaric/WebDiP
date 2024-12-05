<?php
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Trenutne utrke";
include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();

$korisnicko_ime=$_SESSION['korisnik'];
$query_id = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result_id = $baza->selectDB($query_id);
$row = $result_id->fetch_assoc();
$id = $row['korisnik_id'];

$query = "SELECT * FROM `utrka` INNER JOIN `tip_utrke` ON `utrka`.tip_utrke_id=`tip_utrke`.tip_utrke_id INNER JOIN `prijava` ON `prijava`.utrka_id=`utrka`.utrka_id INNER JOIN `etapa` ON `etapa`.utrka_id=`utrka`.utrka_id WHERE korisnik_id='" . $id . "' ORDER BY `utrka`.utrka_id";
$result = $baza->selectDB($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $utrka_id=$row['utrka_id'];
        $etapa_id=$row['etapa_id'];
        $opis_utrke=$row['opis_utrke'];
        $naziv_utrke=$row['naziv_utrke'];
        $naziv_etape=$row['naziv_etape'];
        $opis_etape=$row['opis_etape'];
        $pocetak_utrke=$row['pocetak_utrke'];
        $datum_zavrsetka_prijava=$row['datum_zavrsetka_prijava'];
        $zakljucano=$row['zakljucano'];
        $status=$row['status'];
        $podatci[]=array("utrka_id"=>$utrka_id,
                         "etapa_id"=>$etapa_id,
                        "opis_utrke"=>$opis_utrke,
                        "naziv_utrke"=>$naziv_utrke,
                        "naziv_etape"=>$naziv_etape,
                        "opis_etape"=>$opis_etape,
                        "pocetak_utrke"=>$pocetak_utrke,
                        "datum_zavrsetka_prijava"=>$datum_zavrsetka_prijava,
                        "status"=>$status,
                        "zakljucano"=>$zakljucano);
    } 
    echo json_encode($podatci);
} 

$baza->zatvoriDB();
