<?php

$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Popis utrka etapa";
include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();

$korisnicko_ime=$_SESSION["korisnik"];
$query_id = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result_id = $baza->selectDB($query_id);
$row = $result_id->fetch_assoc();
$id = $row['korisnik_id'];

$query = "SELECT * FROM `utrka` INNER JOIN `drzava` ON `utrka`.drzava_id=`drzava`.drzava_id INNER JOIN `dodjeli_moderatora` ON `dodjeli_moderatora`.drzava_id=`drzava`.drzava_id WHERE korisnik_id='".$id."'";
$result = $baza->selectDB($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $utrka_id=$row['utrka_id'];
        $opis_utrke=$row['opis_utrke'];
        $datum_zavrsetka_prijava=$row['datum_zavrsetka_prijava'];
        $naziv_drzave=$row['naziv_drzave'];
        $podatci[]=array("utrka_id"=>$utrka_id,
                        "opis_utrke"=>$opis_utrke,
                        "datum_zavrsetka_prijava"=>$datum_zavrsetka_prijava,
                        "naziv_drzave"=>$naziv_drzave);
    } 
    echo json_encode($podatci);
} 

$baza->zatvoriDB();
