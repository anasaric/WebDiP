<?php

$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Bodovno stanje korisnika";
include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();
$query = "SELECT * FROM `bodovno_stanje` INNER JOIN `korisnik` ON `bodovno_stanje`.korisnik_id=`korisnik`.korisnik_id ORDER BY etapa_id";
$result = $baza->selectDB($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $etapa_id=$row['etapa_id'];
        $ime=$row['ime'];
        $prezime=$row['prezime'];
        $uspjesno_zavrseno=$row['uspjesno_zavrseno'];
        $vrijeme=$row['vrijeme'];
        $mjesto=$row['mjesto'];
        $bodovi=$row['bodovi'];
        $podatci[]=array("etapa_id"=>$etapa_id,
                        "ime"=>$ime,
                        "prezime"=>$prezime,
                        "uspjesno_zavrseno"=>$uspjesno_zavrseno,
                        "vrijeme"=>$vrijeme,
                        "mjesto"=>$mjesto,
                        "bodovi"=>$bodovi);
    } 
    echo json_encode($podatci);
} 

$baza->zatvoriDB();

