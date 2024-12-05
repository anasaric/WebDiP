<?php 
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Brisanje etape";

include "../zaglavlje.php";

if(isset($_COOKIE['Pobjednik'])){
    $kolacic=$_COOKIE['Pobjednik'];
}
else {
    $kolacic = 0;
}
if(isset($_COOKIE['Ime'])){
    $ime=$_COOKIE['Ime'];
}
else {
    $ime = 0;
}
if(isset($_COOKIE['Prezime'])){
    $prezime=$_COOKIE['Prezime'];
}
else {
    $prezime = 0;
}
$poruka="";
$baza = new baza();
$baza->spojiDB();

$query_id = "SELECT * FROM `etapa` WHERE etapa_id='" . $kolacic . "'";
$result_id = $baza->selectDB($query_id);
$row = $result_id->fetch_assoc();

$utrka_id=$row['utrka_id'];

$korisnicko_ime = $_SESSION['korisnik'];
$query = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result = $baza->selectDB($query);
$row = $result->fetch_assoc();
$id = $row['korisnik_id'];


if (isset($_POST['odustani'])) {
    Header("Location: $putanja/stranice/bodovno_stanje.php");
}

if (isset($_POST['objavi'])) {
    $query_check = "SELECT * FROM `bodovno_stanje` INNER JOIN `korisnik` ON `bodovno_stanje`.korisnik_id=`korisnik`.korisnik_id WHERE ime='" . $ime . "' AND prezime='" . $prezime . "' AND etapa_id='" . $kolacic . "' ORDER BY etapa_id";
    $result_check = $baza->selectDB($query_check);
    $roww = $result_check->fetch_assoc();
    $odabrano_mjesto = $roww['mjesto'];
    $id_pobjednik = $roww['korisnik_id'];
    if ($odabrano_mjesto == 1) {
        $objava_insert = "INSERT INTO galerija_slika (`utrka_id`, `korisnik_korisnik_id`) VALUES ('" . $utrka_id . "', '" . $id_pobjednik . "')";
        $baza->updateDB($objava_insert);

        $datum = date("Y-m-d H:i:s");
        $upit = "objava pobjednika";
        $tekst = $naddirektorij . "stranice/objavi_pobjednika.php";
        $dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
        $baza->updateDB($dnevnik_insert);
        Header("Location: $putanja/stranice/bodovno_stanje.php");
    }
    else{
        $poruka="Ne možete objaviti jer ovaj korisnik nije pobjednik!!";
    }

}


$baza->zatvoriDB();

$smarty->assign("poruka", $poruka);
$smarty->assign("ime", $ime);
$smarty->assign("prezime", $prezime);
$smarty->assign("kolacic", $kolacic);
$smarty->display("zaglavlje.tpl");
$smarty->display("objavi_pobjednika.tpl");
$smarty->display("podnozje.tpl");

