<?php
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Popis prijava";
include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();
$korisnicko_ime=$_SESSION["korisnik"];
$query = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result = $baza->selectDB($query);
$row = $result->fetch_assoc();
$id = $row['korisnik_id'];
$query = "SELECT * FROM `prijava`WHERE korisnik_id='" . $id . "'";

$result = $baza->selectDB($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $prijava_id=$row['prijava_id'];
        $godina_rodenja=$row['godina_rodenja'];
        $slika_putanja=$row['slika_putanja'];
        $utrka_id=$row['utrka_id'];
        $podatci[]=array("prijava_id"=>$prijava_id,
                        "godina_rodenja"=>$godina_rodenja,
                        "slika_putanja"=>$slika_putanja,
                        "utrka_id"=>$utrka_id);
    } 
    echo json_encode($podatci);
} 

$baza->zatvoriDB();
