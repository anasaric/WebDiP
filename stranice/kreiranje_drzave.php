<?php 
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Kreiranje drzave";


include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();
$poruka="";

$datum=date("Y-m-d H:i:s");
$upit = "kreiranje nove drzave";
$tekst = $naddirektorij."stranice/kreiranje_drzave.php";
$korisnicko_ime=$_SESSION['korisnik'];
$query = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result = $baza->selectDB($query);
$row = $result->fetch_assoc();
$id = $row['korisnik_id'];


if (isset($_POST['odustani'])) {
    Header("Location: $putanja/stranice/popis_drzava.php");
}

if(isset($_POST['spremi_drzavu'])){
    $kontinent=$_POST['nazivkontinent'];
    $drzava=$_POST['nazivdrzava'];
    $stanovnici=$_POST['brojstanovnika'];
    if(empty($kontinent) || empty($drzava) || empty($stanovnici)){
        $poruka="Ispunite sve!!";
    }
    else{
        $query_insert = "INSERT INTO drzava (`kontinent`, `naziv_drzave`, `broj_stanovnika`) VALUES ('" . $kontinent . "', '" . $drzava . "', '" . $stanovnici . "')";
        $baza->updateDB($query_insert);
        $dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
        $baza->updateDB($dnevnik_insert);
        Header("Location: $putanja/stranice/popis_drzava.php");
    }
}

$baza->zatvoriDB();

$smarty->assign("poruka",$poruka);
$smarty->display("zaglavlje.tpl");
$smarty->display("kreiranje_drzave.tpl");
$smarty->display("podnozje.tpl");

?>
