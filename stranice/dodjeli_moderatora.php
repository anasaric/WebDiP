<?php

$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Dodjeli moderatora";

include "../zaglavlje.php";

if(isset($_COOKIE['Drzava'])){
    $kolacic=$_COOKIE['Drzava'];
}
else {
    $kolacic = 0;
}

$baza = new baza();
$baza->spojiDB();

$datum=date("Y-m-d H:i:s");
$upit = "dodjela moderatora drzavi";
$tekst = $naddirektorij."stranice/dodjeli_moderatora.php";
$korisnicko_ime=$_SESSION['korisnik'];
$query = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result = $baza->selectDB($query);
$row = $result->fetch_assoc();
$id = $row['korisnik_id'];

if (isset($_POST['odustani'])) {
    Header("Location: $putanja/stranice/popis_drzava.php");
}
$poruka="";
$id="";
if (isset($_POST['dodjeli'])) {
    $korisnik=$_POST['korisnici'];
    $query_select="SELECT * FROM `korisnik`WHERE korisnicko_ime='" . $korisnik . "'";
    $result_select=$baza->selectDB($query_select);
    $row=$result_select->fetch_assoc();
    $id=$row['korisnik_id'];
    
    if($id==""){
        $poruka="Korisnik nije pronaden!!";
    }
    else{
        $query_insert="INSERT INTO dodjeli_moderatora (`drzava_id`, `korisnik_id`) VALUES ('" . $kolacic . "', '" . $id . "')";
        $baza->updateDB($query_insert);
        $dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
        $baza->updateDB($dnevnik_insert);
        $poruka="Uspješno dodjeljen moderator državi!";
    }
}

$smarty->assign("kolacic", $kolacic);
$smarty->assign("poruka", $poruka);
$smarty->display("zaglavlje.tpl");
$smarty->display("dodjeli_moderatora.tpl");
$smarty->display("podnozje.tpl");

