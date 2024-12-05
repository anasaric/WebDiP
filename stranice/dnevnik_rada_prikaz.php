<?php
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Dnevnik rada";
include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();
$query = "SELECT `dnevnik_rada`.datum_vrijeme AS `datum_vrijeme`, `upit`, `opis_radnje`, `korisnicko_ime` FROM `dnevnik_rada` INNER JOIN `korisnik` ON `korisnik`.korisnik_id=`dnevnik_rada`.korisnik_id ";
$result = $baza->selectDB($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $datum_vrijeme=$row['datum_vrijeme'];
        $upit=$row['upit'];
        $opis_radnje=$row['opis_radnje'];
        $korisnicko_ime=$row['korisnicko_ime'];
        $podatci[]=array("datum_vrijeme"=>$datum_vrijeme,
                        "upit"=>$upit,
                        "opis_radnje"=>$opis_radnje,
                        "korisnicko_ime"=>$korisnicko_ime);
    } 
    echo json_encode($podatci);
} 

$baza->zatvoriDB();
