<?php
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Ažuriranje država";

include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();

if(isset($_COOKIE['Drzava'])){
    $kolacic=$_COOKIE['Drzava'];
}
else {
    $kolacic = 0;
}

$datum=date("Y-m-d H:i:s");
$upit = "azuriranje drzave";
$tekst = $naddirektorij."stranice/azuriranje_drzava.php";
$korisnicko_ime=$_SESSION['korisnik'];
$query = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result = $baza->selectDB($query);
$row = $result->fetch_assoc();
$id = $row['korisnik_id'];

$query_select="SELECT * FROM `drzava` WHERE drzava_id='" . $kolacic . "'";
$result_select = $baza->selectDB($query_select);
$row = $result_select->fetch_assoc();

$kontinent=$row['kontinent'];
$drzava=$row['naziv_drzave'];
$stanovnici=$row['broj_stanovnika'];

if (isset($_POST['odustani'])) {
    Header("Location: $putanja/stranice/popis_drzava.php");
}
$poruka="";
if (isset($_POST['azuriraj'])) {
    $novo_kontinent=$_POST['kontinent'];
    $novo_drzava=$_POST['drzava'];
    $novo_stanovnici=$_POST['stanovnici'];
    if(empty($novo_drzava) || empty($novo_kontinent) || empty($novo_stanovnici)){
        $poruka="Sva polja moraju biti ispunjena!!";
    }
    else{
        $query_update = "UPDATE `drzava` SET kontinent='" . $novo_kontinent . "'" . " WHERE drzava_id='" . $kolacic . "'";
        $baza->updateDB($query_update);
        $query_update2 = "UPDATE `drzava` SET naziv_drzave='" . $novo_drzava . "'" . " WHERE drzava_id='" . $kolacic . "'";
        $baza->updateDB($query_update2);
        $query_update3 = "UPDATE `drzava` SET broj_stanovnika='" . $novo_stanovnici . "'" . " WHERE drzava_id='" . $kolacic . "'";
        $baza->updateDB($query_update3);
        $dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
        $baza->updateDB($dnevnik_insert);
        Header("Location: $putanja/stranice/popis_drzava.php");
    }
}
if(isset($_POST['dodjeli'])){
    Header("Location: $putanja/stranice/dodjeli_moderatora.php");
}

$baza->zatvoriDB();

$smarty->assign("kontinent", $kontinent);
$smarty->assign("poruka", $poruka);
$smarty->assign("drzava", $drzava);
$smarty->assign("stanovnici", $stanovnici);
$smarty->assign("kolacic", $kolacic);

$smarty->display("zaglavlje.tpl");
$smarty->display("azuriranje_drzava.tpl");
$smarty->display("podnozje.tpl");

?>


