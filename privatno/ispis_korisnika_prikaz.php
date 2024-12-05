<?php

$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Ispis korisnika";
include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();

$query = "SELECT * FROM `korisnik`";
$result = $baza->selectDB($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $korisnicko_ime=$row['korisnicko_ime'];
        $prezime=$row['prezime'];
        $ime=$row['ime'];
        $email=$row['email'];
        $lozinka=$row['lozinka'];
        $podatci[]=array("korisnicko_ime"=>$korisnicko_ime,
                        "prezime"=>$prezime,
                        "ime"=>$ime,
                        "email"=>$email,
                        "lozinka"=>$lozinka);
    } 
    echo json_encode($podatci);
} 

$baza->zatvoriDB();

