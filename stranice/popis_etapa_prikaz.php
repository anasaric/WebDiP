<?php

$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Popis etapa";

include "../zaglavlje.php";

if(isset($_COOKIE['Utrka_ID'])){
    $kolacic=$_COOKIE['Utrka_ID'];
}
else {
    $kolacic = 0;
}

$baza = new baza();
$baza->spojiDB();

$query ="SELECT * FROM `etapa` WHERE utrka_id='".$kolacic."'";
$result = $baza->selectDB($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $etapa_id=$row['etapa_id'];
        $naziv_etape=$row['naziv_etape'];
        $opis_etape=$row['opis_etape'];
        $pocetak_etape=$row['pocetak_utrke'];
        $zakljucano=$row['zakljucano'];
        $podatci[]=array("etapa_id"=>$etapa_id,
                        "naziv_etape"=>$naziv_etape,
                        "opis_etape"=>$opis_etape,
                        "pocetak_etape"=>$pocetak_etape,
                        "zakljucano"=>$zakljucano);
    } 
    echo json_encode($podatci);
} 

$baza->zatvoriDB();