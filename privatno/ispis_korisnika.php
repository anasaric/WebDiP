<?php 
$naddirektorij = (dirname(getcwd()));
$putanja = dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov = "Ispis korisnika";

include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();

$datum=date("Y-m-d H:i:s");
$upit = "pregled stranice";
$tekst = $naddirektorij."privatno/ispis_korisnika.php";
if(isset($_SESSION["korisnik"])){
    $korisnicko_ime=$_SESSION["korisnik"];
}
else{ 
    $korisnicko_ime = "asaric";
}
$query2 = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result2 = $baza->selectDB($query2);
$row = $result2->fetch_assoc();
$id = $row['korisnik_id'];
$dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
$baza->updateDB($dnevnik_insert);

$baza->zatvoriDB();



$smarty->display("zaglavlje.tpl");
$smarty->display("ispis_korisnika.tpl");
$smarty->display("podnozje.tpl");