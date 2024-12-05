<?php
$naddirektorij = dirname(getcwd());
$putanja = dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov = "Popis etapa";

include "../zaglavlje.php";

if (isset($_COOKIE['Utrka_ID'])) {
    $kolacic = $_COOKIE['Utrka_ID'];
} else {
    $kolacic = 0;
}

$baza = new baza();
$baza->spojiDB();
$poruka="";

$datum = date("Y-m-d H:i:s");
$upit = "pregled stranice";
$tekst = $naddirektorij . "stranice/popis_etapa.php";
$korisnicko_ime=$_SESSION["korisnik"];
$query = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result = $baza->selectDB($query);
$row = $result->fetch_assoc();
$id = $row['korisnik_id'];
$dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
$baza->updateDB($dnevnik_insert);

if (isset($_POST['zakljucaj'])) {
    $query = "SELECT * FROM `utrka` WHERE utrka_id='" . $kolacic . "'";
    $result = $baza->selectDB($query);
    $row = $result->fetch_assoc();
    $zakljucano=$row['zakljucano'];
    if($zakljucano==1){
        $poruka="Utrka je vec zakljucana!!";
    }
    else{
        $provjera=1;
        $query_check="SELECT * FROM `etapa` WHERE utrka_id='" . $kolacic . "'";
        $result = $baza->selectDB($query_check);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $zakljucano = $row['zakljucano'];
                if ($zakljucano == 0) {
                    $provjera = 0;
                }
            }
            if ($provjera == 0) {
                $poruka = "Ne možete zaključati utrku jer nisu sve etape zaključane!!";
            } else {
                $lock = 1;
                $query_update = "UPDATE `utrka` SET zakljucano='" . $lock . "'" . " WHERE utrka_id='" . $kolacic . "'";
                $result_update = $baza->updateDB($query_update);
                $poruka = "utrka je uspjesno zakljucana!!";
                
                $upit = "zakljucavanje utrke";
                $dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
                $baza->updateDB($dnevnik_insert);
            }
        }
    }
}

if (isset($_POST['dodaj'])) {
    Header("Location: $putanja/stranice/kreiranje_etape.php");
}
$baza->zatvoriDB();

$smarty->assign("poruka",$poruka);
$smarty->display("zaglavlje.tpl");
$smarty->display("popis_etapa.tpl");
$smarty->display("podnozje.tpl");

?>

