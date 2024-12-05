<?php
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Galerija";
include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();
$query = "SELECT * FROM `galerija_slika` INNER JOIN `prijava` ON `galerija_slika`.korisnik_korisnik_id=`prijava`.korisnik_id AND `galerija_slika`.utrka_id=`prijava`.utrka_id INNER JOIN `korisnik` ON `korisnik`.korisnik_id=`galerija_slika`.korisnik_korisnik_id INNER JOIN `utrka` ON `utrka`.utrka_id=`prijava`.utrka_id INNER JOIN `drzava` ON `drzava`.drzava_id=`utrka`.drzava_id ";

$result = $baza->selectDB($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $utrka_id=$row['utrka_id'];
        $ime=$row['ime'];
        $prezime=$row['prezime'];
        $slika_putanja=$row['slika_putanja'];
        $naziv_drzave=$row['naziv_drzave'];
        $podatci[]=array("utrka_id"=>$utrka_id,
                        "ime"=>$ime,
                        "prezime"=>$prezime,
                        "slika_putanja"=>$slika_putanja,
                        "naziv_drzave"=>$naziv_drzave);
    } 
    echo json_encode($podatci);
} 

$baza->zatvoriDB();
