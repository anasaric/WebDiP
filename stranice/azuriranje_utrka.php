<?php 
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Azuriranje utrka";

include "../zaglavlje.php";

if(isset($_COOKIE['Utrka'])){
    $kolacic=$_COOKIE['Utrka'];
}
else {
    $kolacic = 0;
}

$baza = new baza();
$baza->spojiDB();

$datum_dnevnik = date("Y-m-d H:i:s");
$upit = "azuriranje utrke";
$tekst = $naddirektorij . "stranice/kreiranje_utrka.php";
$korisnicko_ime=$_SESSION["korisnik"];
$query = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result = $baza->selectDB($query);
$row = $result->fetch_assoc();
$id = $row['korisnik_id'];

$query_select="SELECT * FROM `utrka` WHERE utrka_id='" . $kolacic . "'";
$result_select = $baza->selectDB($query_select);
$row = $result_select->fetch_assoc();

$tip_utrke=$row['tip_utrke_id'];
$drzava_id=$row['drzava_id'];

if(isset($_POST['odustani'])){
    Header("Location: $putanja/stranice/popis_svih_utrka.php");
}
$novo_opis="";
if(isset($_POST['azuriraj'])){
    $novo_datum=date("Y-m-d H:i:s", strtotime($_POST['datumutrka']));
    $novo_opis=$_POST['opisutrke'];
    if($novo_datum>'1970-01-01 01:00:00 '){
         $query_update = "UPDATE `utrka` SET datum_zavrsetka_prijava='" . $novo_datum . "'" . " WHERE utrka_id='" . $kolacic . "'";
         $baza->updateDB($query_update);
    }
    if($novo_opis!=""){
         $query_update = "UPDATE `utrka` SET opis_utrke='" . $novo_opis . "'" . " WHERE utrka_id='" . $kolacic . "'";
         $baza->updateDB($query_update);
    }
    $dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum_dnevnik . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
    $baza->updateDB($dnevnik_insert);
    Header("Location: $putanja/stranice/popis_svih_utrka.php");
   
}

$baza->zatvoriDB();

$smarty->assign("tip_utrke",$tip_utrke);
$smarty->assign("drzava_id",$drzava_id);
$smarty->assign("kolacic",$kolacic);
$smarty->display("zaglavlje.tpl");
$smarty->display("azuriranje_utrka.tpl");
$smarty->display("podnozje.tpl");

?>