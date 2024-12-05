<?php

$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Azuriranje etape";

include "../zaglavlje.php";

if(isset($_COOKIE['Etapa'])){
    $kolacic=$_COOKIE['Etapa'];
}
else {
    $kolacic = 0;
}
$poruka="";
$baza = new baza();
$baza->spojiDB();

$query_id = "SELECT * FROM `etapa` WHERE etapa_id='" . $kolacic . "'";
$result_id = $baza->selectDB($query_id);
$row = $result_id->fetch_assoc();

$naziv_etape = $row['naziv_etape'];
$opis_etape = $row['opis_etape'];
$pocetak_utrke = $row['pocetak_utrke'];
//$zakljucano=$row['zakljucano'];

if (isset($_POST['odustani'])) {
    Header("Location: $putanja/stranice/popis_etapa.php");
}

if (isset($_POST['azuriraj'])) {
    $azuriraj_naziv=$_POST['nazivetapa'];
    $azuriraj_opis=$_POST['opis'];
    $azuriraj_datum=date("Y-m-d H:i:s", strtotime($_POST['datum']));
//    if(isset($_POST['zakljucano']) && $zakljucano==1){
//        $poruka="Ova etapa je vec zakljucana!!";
//    }
//    else{
//        if(isset($_POST['zakljucano']) && $zakljucano==0){
//        $zakljucano=1;
//        }
        $query_update = "UPDATE `etapa` SET naziv_etape='" . $azuriraj_naziv . "'" . " WHERE etapa_id='" . $kolacic . "'";
        $baza->updateDB($query_update);
        $query_update2 = "UPDATE `etapa` SET opis_etape='" . $azuriraj_opis . "'" . " WHERE etapa_id='" . $kolacic . "'";
        $baza->updateDB($query_update2);
        $query_update3 = "UPDATE `etapa` SET pocetak_utrke='" . $azuriraj_datum . "'" . " WHERE etapa_id='" . $kolacic . "'";
        $baza->updateDB($query_update3);
//        $query_update4 = "UPDATE `etapa` SET zakljucano='" . $zakljucano . "'" . " WHERE etapa_id='" . $kolacic . "'";
//        $baza->updateDB($query_update4);

        $datum = date("Y-m-d H:i:s");
        $upit = "azuriranje etape";
        $tekst = $naddirektorij . "stranice/azuriranje_etapa.php";
        $korisnicko_ime = $_SESSION["korisnik"];
        $query = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
        $result = $baza->selectDB($query);
        $row = $result->fetch_assoc();
        $id = $row['korisnik_id'];
        $dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
        $baza->updateDB($dnevnik_insert);

        Header("Location: $putanja/stranice/popis_etapa.php");
//    }
}

$baza->zatvoriDB();


$smarty->assign("naziv_etape", $naziv_etape);
$smarty->assign("opis_etape", $opis_etape);
$smarty->assign("pocetak_utrke", $pocetak_utrke);
$smarty->assign("kolacic", $kolacic);
$smarty->assign("poruka", $poruka);
$smarty->display("zaglavlje.tpl");
$smarty->display("azuriranje_etapa.tpl");
$smarty->display("podnozje.tpl");