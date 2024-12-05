<?php 
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Brisanje etape";

include "../zaglavlje.php";

if(isset($_COOKIE['Etapa_ID'])){
    $kolacic=$_COOKIE['Etapa_ID'];
}
else {
    $kolacic = 0;
}

$baza = new baza();
$baza->spojiDB();

$query_id = "SELECT * FROM `etapa` WHERE etapa_id='" . $kolacic . "'";
$result_id = $baza->selectDB($query_id);
$row = $result_id->fetch_assoc();

$naziv_etape = $row['naziv_etape'];
$opis_etape = $row['opis_etape'];
$pocetak_utrke = $row['pocetak_utrke'];
$utrka_id=$row['utrka_id'];
$korisnicko_ime = $_SESSION['korisnik'];
$query = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result = $baza->selectDB($query);
$row = $result->fetch_assoc();
$id = $row['korisnik_id'];
if (isset($_POST['odustani'])) {
    Header("Location: $putanja/stranice/trenutne_utrke.php");
}

if (isset($_POST['obrisi'])) {
    $datum = date("Y-m-d H:i:s");
    $upit = "pregled etape i brisanje utrke kojoj ta etapa pripada";
    $tekst = $naddirektorij . "stranice/brisanje_etape.php";
    $dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
    $baza->updateDB($dnevnik_insert);
    $status = "1";
    $query_update = "UPDATE `prijava` SET status='" . $status . "'" . " WHERE korisnik_id='" . $id . "' AND utrka_id='" . $utrka_id . "'";
    $result_update = $baza->updateDB($query_update);
    Header("Location: $putanja/stranice/trenutne_utrke.php");
    
}

$baza->zatvoriDB();

$smarty->assign("naziv_etape", $naziv_etape);
$smarty->assign("opis_etape", $opis_etape);
$smarty->assign("pocetak_utrke", $pocetak_utrke);
$smarty->assign("kolacic", $kolacic);
$smarty->display("zaglavlje.tpl");
$smarty->display("brisanje_etape.tpl");
$smarty->display("podnozje.tpl");

?>
