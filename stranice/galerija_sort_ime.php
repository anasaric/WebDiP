<?php
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Galerija";
include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();
$query = "SELECT * FROM `galerija_slika` INNER JOIN `prijava` ON `galerija_slika`.korisnik_korisnik_id=`prijava`.korisnik_id AND `galerija_slika`.utrka_id=`prijava`.utrka_id INNER JOIN `korisnik` ON `korisnik`.korisnik_id=`galerija_slika`.korisnik_korisnik_id ORDER BY ime";
$result = $baza->selectDB($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $utrka_id=$row['utrka_id'];
        $ime=$row['ime'];
        $prezime=$row['prezime'];
        $slika_putanja=$row['slika_putanja'];
        $podatci[]=array("utrka_id"=>$utrka_id,
                        "ime"=>$ime,
                        "prezime"=>$prezime,
                        "slika_putanja"=>$slika_putanja);
    } 
    echo json_encode($podatci);
    
} 

$datum = date("Y-m-d H:i:s");
$upit = "sortiranje podataka po imenu korisnika";
$tekst = $naddirektorij . "stranice/galerija.php";
if(isset($_SESSION["korisnik"])){
    $korisnicko_ime=$_SESSION["korisnik"];
}
else{ 
    $korisnicko_ime = "asaric";
}
$query = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result = $baza->selectDB($query);
$row = $result->fetch_assoc();
$id = $row['korisnik_id'];
$dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
$baza->updateDB($dnevnik_insert);

$baza->zatvoriDB();