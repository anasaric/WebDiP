<?php 
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Nove utrke";

include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();

$datum = date("Y-m-d H:i:s");
$upit = "pregled stranice";
$tekst = $naddirektorij . "stranice/nove_utrke.php";
$korisnicko_ime=$_SESSION["korisnik"];
$query = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result = $baza->selectDB($query);
$row = $result->fetch_assoc();
$id = $row['korisnik_id'];
$dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
$baza->updateDB($dnevnik_insert);

$baza->zatvoriDB();

$smarty->display("zaglavlje.tpl");
$smarty->display("nove_utrke.tpl");
$smarty->display("podnozje.tpl");

?>
