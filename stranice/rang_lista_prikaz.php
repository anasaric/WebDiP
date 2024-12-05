<?php

$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Rang lista";
include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();
$query = "SELECT * FROM `bodovno_stanje`";
$result = $baza->selectDB($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $korisnik_id=$row['korisnik_id'];
        $etapa_id=$row['etapa_id'];
        $uspjesno_zavrseno=$row['uspjesno_zavrseno'];
        $vrijeme=$row['vrijeme'];
        $mjesto=$row['mjesto'];
        $bodovi=$row['bodovi'];
        $podatci[]=array("korisnik_id"=>$korisnik_id,
                        "etapa_id"=>$etapa_id,
                        "uspjesno_zavrseno"=>$uspjesno_zavrseno,
                        "vrijeme"=>$vrijeme,
                        "mjesto"=>$mjesto,
                        "bodovi"=>$bodovi);
    } 
    echo json_encode($podatci);
} 

$baza->zatvoriDB();