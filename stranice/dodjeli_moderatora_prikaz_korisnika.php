<?php
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Dodjeli moderatora";
include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();
$query = "SELECT * FROM `korisnik` WHERE tip_korisnika_id<'3'"; 
$result = $baza->selectDB($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $korisnicko_ime=$row['korisnicko_ime'];
        $podatci[]=array("korisnicko_ime"=>$korisnicko_ime);
    } 
    echo json_encode($podatci);
} 

$baza->zatvoriDB();
