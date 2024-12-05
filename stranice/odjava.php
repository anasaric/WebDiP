<?php 
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Odjava";

include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();

$datum=date("Y-m-d H:i:s");
$upit = "odjava";
$tekst = "Odjava korisnika iz aplikacije";

$korisime=$_SESSION['korisnik'];
$query="SELECT * FROM `korisnik` WHERE korisnicko_ime='".$korisime."'";
$result=$baza->selectDB($query);
$row=$result->fetch_assoc();
$id=$row['korisnik_id'];

$dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";

$baza->updateDB($dnevnik_insert);
$baza->zatvoriDB();

sesija::obrisiSesiju();
Header("Location: $putanja/index.php");

?>


