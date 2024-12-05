<?php 
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Kreiranje etape";

include "../zaglavlje.php";

if (isset($_COOKIE['Utrka_ID'])) {
    $kolacic = $_COOKIE['Utrka_ID'];
} else {
    $kolacic = 0;
}
$poruka="";
$baza = new baza();
$baza->spojiDB();

if(isset($_POST['kreiraj'])){
    $naziv=$_POST['nazivetapa'];
    $opis=$_POST['opis'];
    $datum = date("Y-m-d H:i:s", strtotime($_POST['datumetapa']));
    $zakljucano = 0;
    if (empty($naziv) || empty($opis) || empty($datum)) {
        $poruka = "Morate unijeti sve podatke!!";
    } else {
        $query_insert = "INSERT INTO etapa(`naziv_etape`,`opis_etape`,`pocetak_utrke`,`zakljucano`, `utrka_id`) VALUES('" . $naziv . "', '" . $opis . "', '" . $datum . "', '" . $zakljucano . "', '" . $kolacic . "')";
        $baza->updateDB($query_insert);

        $datum = date("Y-m-d H:i:s");
        $upit = "kreiranje etape";
        $tekst = $naddirektorij . "stranice/kreiranje_etape.php";
        $korisnicko_ime = $_SESSION["korisnik"];
        $query = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
        $result = $baza->selectDB($query);
        $row = $result->fetch_assoc();
        $id = $row['korisnik_id'];
        $dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
        $baza->updateDB($dnevnik_insert);

        Header("Location: $putanja/stranice/popis_etapa.php");
    }
}
$baza->zatvoriDB();

$smarty->assign("poruka", $poruka);
$smarty->display("zaglavlje.tpl");
$smarty->display("kreiranje_etape.tpl");
$smarty->display("podnozje.tpl");
?>
