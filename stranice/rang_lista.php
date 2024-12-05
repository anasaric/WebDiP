<?php

$naddirektorij = dirname(getcwd());
$putanja = dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov = "Rang lista";

include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();

$datum = date("Y-m-d H:i:s");
$upit = "pregled stranice";
$tekst = $naddirektorij . "stranice/rang_lista.php";
if(isset($_SESSION["korisnik"])){
    $korisnicko_ime=$_SESSION["korisnik"];
}
else{ 
    $korisnicko_ime = "asaric";
}
$query = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result = $baza->selectDB($query);
$row = $result->fetch_assoc();
$id = $row['korisnik_id'];
$dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
$baza->updateDB($dnevnik_insert);

if (isset($_POST["vremenskorazdoblje"])) {
    $datum = date("Y-m-d H:i:s");
    $upit = "filtiranje tablice";
    $tekst = $naddirektorij . "stranice/rang_lista.php";
    if (isset($_SESSION["korisnik"])) {
        $korisnicko_ime = $_SESSION["korisnik"];
    } else {
        $korisnicko_ime = "asaric";
    }
    $query = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
    $result = $baza->selectDB($query);
    $row = $result->fetch_assoc();
    $id = $row['korisnik_id'];
    $dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
    $baza->updateDB($dnevnik_insert);
}

$baza->zatvoriDB();

$smarty->display("zaglavlje.tpl");
$smarty->display("rang_lista.tpl");
$smarty->display("podnozje.tpl");
?>

