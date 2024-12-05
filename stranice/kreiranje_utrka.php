<?php 
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Kreiranje utrka";

include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();

if (isset($_POST['odustani'])) {
    Header("Location: $putanja/stranice/popis_svih_utrka.php");
}

$datum_dnevnik = date("Y-m-d H:i:s");
$upit = "kreiranje utrke";
$tekst = $naddirektorij . "stranice/kreiranje_utrka.php";
$korisnicko_ime=$_SESSION["korisnik"];
$query = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result = $baza->selectDB($query);
$row = $result->fetch_assoc();
$id = $row['korisnik_id'];

$drzava="";
$tip_utrke="";
$poruka="";
if (isset($_POST['spremi'])) {
    $tip_utrke=$_POST['utrka'];
    $opis=$_POST['opisutrke'];
    $datum=date("Y-m-d H:i:s", strtotime($_POST['datumutrka']));
    $drzava=$_POST['drzava'];
    if(empty($opis) || ($drzava=="") || ($tip_utrke=="")){
        $poruka="Unesite podatke u sva polja!!";
    }
    else{
        $query_tip="SELECT * FROM `tip_utrke` WHERE naziv_utrke='" . $tip_utrke . "'";
        $result_tip= $baza->selectDB($query_tip);
        $row = $result_tip->fetch_assoc();
        $tip=$row['tip_utrke_id'];
                
        $query_drzava="SELECT * FROM `drzava` WHERE naziv_drzave='" . $drzava . "'";
        $result_drzava= $baza->selectDB($query_drzava);
        $roww = $result_drzava->fetch_assoc();
        $drzavaa=$roww['drzava_id'];    
        $zakljucano=0;
        $query_insert="INSERT INTO utrka (`tip_utrke_id`, `opis_utrke`, `datum_zavrsetka_prijava`, `zakljucano`, `drzava_id`) VALUES ('" . $tip . "', '" . $opis . "', '" . $datum . "', '" . $zakljucano . "', '" . $drzavaa . "')";
        $baza->updateDB($query_insert);
        $dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum_dnevnik . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
        $baza->updateDB($dnevnik_insert);
        Header("Location: $putanja/stranice/popis_svih_utrka.php");
    }
}

$baza->zatvoriDB();

$smarty->assign("poruka",$poruka);
$smarty->display("zaglavlje.tpl");
$smarty->display("kreiranje_utrka.tpl");
$smarty->display("podnozje.tpl");

?>