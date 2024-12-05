<?php 
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Kreiranje prijave";

include "../zaglavlje.php";

if(isset($_COOKIE['Utrka_ID'])){
    $kolacic=$_COOKIE['Utrka_ID'];
}
else {
    $kolacic = 0;
}
$poruka = "";
$AssignDatum="";

$baza = new baza();
$baza->spojiDB();

$korisnicko_ime = $_SESSION['korisnik'];
$query_update = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result3 = $baza->selectDB($query_update);
$row = $result3->fetch_assoc();
$id = $row['korisnik_id'];
$query_update_2 = "SELECT * FROM `prijava` WHERE korisnik_id='" . $id . "' AND utrka_id='" . $kolacic . "'";

$result4 = $baza->selectDB($query_update_2);
if ($result4->num_rows > 0) {
    $row = $result4->fetch_assoc();
    $AssignDatum = $row['godina_rodenja'];
    $poruka="Utrka je vec prijavljena, možete ju ažurirati!!";
}

if (isset($_POST['prijava'])) {
    $datum = $_POST['datum'];
    $slika = $_POST['slika'];
    if(empty($datum) || empty($slika)){
        $poruka="Unesite sve podatke kako bi kreirali prijavu!!";
    }
    else{
    $korisnicko_ime=$_SESSION['korisnik'];
    $query = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
    $result = $baza->selectDB($query);
    $row = $result->fetch_assoc();
    $id = $row['korisnik_id'];
    $query_check= "SELECT * FROM `prijava` WHERE korisnik_id='" . $id . "' AND utrka_id='" . $kolacic . "'";
    $result2 = $baza->selectDB($query_check);
    if ($result2->num_rows > 0) {
        $query_update="UPDATE `prijava` SET godina_rodenja='" . $datum . "'" . " WHERE korisnik_id='" . $id . "' AND utrka_id='" . $kolacic . "'";
        $baza->updateDB($query_update);
        $query_update2="UPDATE `prijava` SET slika_putanja='" . $slika . "'" . " WHERE korisnik_id='" . $id . "' AND utrka_id='" . $kolacic . "'";
        $baza->updateDB($query_update2);
        
        $datum = date("Y-m-d H:i:s");
        $upit = "azuriranje prijave korisnika";
        $tekst = $naddirektorij . "stranice/kreiranje_prijave.php";
        $dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
        $baza->updateDB($dnevnik_insert);
    }
    else{
        echo "bezveze";
        $query_insert = "INSERT INTO prijava(`godina_rodenja`,`slika_putanja`,`korisnik_id`,`utrka_id`) VALUES('" . $datum . "', '" . $slika . "', '" . $id . "', '" . $kolacic . "')";
        $baza->updateDB($query_insert);
        
        $datum = date("Y-m-d H:i:s");
        $upit = "kreiranje prijave korisnika";
        $tekst = $naddirektorij . "stranice/kreiranje_prijave.php";
        $dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
        $baza->updateDB($dnevnik_insert);
    }
    Header("Location: $putanja/stranice/nove_utrke.php");
    }
}
$baza->zatvoriDB();

$smarty->assign("kolacic",$kolacic);
$smarty->assign("AssignDatum", $AssignDatum);
$smarty->assign("poruka",$poruka);
$smarty->display("zaglavlje.tpl");
$smarty->display("kreiranje_prijave.tpl");
$smarty->display("podnozje.tpl");

?>
