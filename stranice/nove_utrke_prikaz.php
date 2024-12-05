<?php
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Nove utrke";
include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();
$query = "SELECT * FROM `utrka` INNER JOIN `tip_utrke` ON `utrka`.tip_utrke_id=`tip_utrke`.tip_utrke_id";

$result = $baza->selectDB($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $utrka_id=$row['utrka_id'];
        $opis_utrke=$row['opis_utrke'];
        $naziv_utrke=$row['naziv_utrke'];
        $datum_zavrsetka_prijava=$row['datum_zavrsetka_prijava'];
        $zakljucano=$row['zakljucano'];
        $drzava_id=$row['drzava_id'];
        $podatci[]=array("utrka_id"=>$utrka_id,
                        "opis_utrke"=>$opis_utrke,
                        "naziv_utrke"=>$naziv_utrke,
                        "datum_zavrsetka_prijava"=>$datum_zavrsetka_prijava,
                        "zakljucano"=>$zakljucano,
                         "drzava_id"=>$drzava_id);
    } 
    echo json_encode($podatci);
} 

$baza->zatvoriDB();
