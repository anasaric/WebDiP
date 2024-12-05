<?php

$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Popis svih utrka";
include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();

$query ="SELECT * FROM `utrka` INNER JOIN `tip_utrke` ON `tip_utrke`.tip_utrke_id=`utrka`.tip_utrke_id";
$result = $baza->selectDB($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $utrka_id=$row['utrka_id'];
        $naziv_utrke=$row['naziv_utrke'];
        $opis_utrke=$row['opis_utrke'];
        $datum_zavrsetka_prijava=$row['datum_zavrsetka_prijava'];
        $podatci[]=array("utrka_id"=>$utrka_id,
                        "naziv_utrke"=>$naziv_utrke,
                        "opis_utrke"=>$opis_utrke,
                        "datum_zavrsetka_prijava"=>$datum_zavrsetka_prijava);
    } 
    echo json_encode($podatci);
} 

$baza->zatvoriDB();
