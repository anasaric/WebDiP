<?php

$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Azuriranje etape";

include "../zaglavlje.php";

if(isset($_COOKIE['Korisnik'])){
    $korisnik=$_COOKIE['Korisnik'];
}
else {
    $korisnik = 0;
}
if(isset($_COOKIE['Etapa'])){
    $etapa=$_COOKIE['Etapa'];
}
else {
    $etapa = 0;
}
if (isset($_COOKIE['Naziv'])) {
    $naziv = $_COOKIE['Naziv'];
} else {
    $naziv = 0;
}
if (isset($_COOKIE['Uspjeh'])) {
    $uspjeh = $_COOKIE['Uspjeh'];
} else {
    $uspjeh = 0;
}
$poruka = "";
$baza = new baza();
$baza->spojiDB();

$korisnicko_ime = $_SESSION["korisnik"];
$query = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result = $baza->selectDB($query);
$row = $result->fetch_assoc();
$id = $row['korisnik_id'];
$datum = date("Y-m-d H:i:s");

if (isset($_POST['odustani'])) {
    Header("Location: $putanja/stranice/popis_svih_etapa.php");
}
$provjera=0;
if (isset($_POST['azuriraj'])) {
    $query_select= "SELECT * FROM `bodovno_stanje` WHERE etapa_id='" . $etapa . "' AND korisnik_id='" . $korisnik . "'";
    $result_select= $baza->selectDB($query_select);
    $row = $result_select->fetch_assoc();
    $uspjeh=$row['uspjesno_zavrseno'];
     $azuriraj_datum=date("Y-m-d H:i:s", strtotime($_POST['datum']));
     if($uspjeh==0){
            $poruka="Ne mozete unijeti datum za korisnika koji nije uspješno završio etapu!";
        }
        else{
            $upit = "azuriranje  vremena korisnika pri zavrsetku etape";
            $tekst = $naddirektorij . "stranice/evidencija_vremena.php";
            $dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
            $baza->updateDB($dnevnik_insert);
          
//            $query_update="UPDATE `bodovno_stanje` SET vrijeme='" . $_POST['datum'] . "'" . " WHERE etapa_id='" . $etapa . "' AND korisnik_id='" . $korisnik . "'";
            $baza->updateDB($query_update);
        }
}   
if(isset($_POST['zakljucano'])){
         $query_lock="SELECT `prijava`.korisnik_id, `etapa`.etapa_id,`etapa`.naziv_etape, `bodovno_stanje`.uspjesno_zavrseno, `bodovno_stanje`.vrijeme FROM `prijava` LEFT JOIN `etapa` ON `prijava`.utrka_id=`etapa`.utrka_id INNER JOIN `bodovno_stanje` ON `bodovno_stanje`.etapa_id=`etapa`.etapa_id WHERE `etapa`.etapa_id='" . $etapa . "'";
         $result_lock = $baza->selectDB($query_lock);
         if ($result_lock->num_rows > 0) {
            while ($row = $result_lock->fetch_assoc()) {
                $query_check="SELECT * FROM `etapa` WHERE `etapa`.etapa_id='" . $etapa . "'";
                $result_check = $baza->selectDB($query_check);
                $roww = $result_check->fetch_assoc();
                $zakljucano=$roww['zakljucano'];
                if($zakljucano==1){
                    $poruka="Etapa je vec zakljucana!!";
                }
                else{ 
                    $uspjesno_zavrseno=$row['uspjesno_zavrseno'];
                    $vrijeme=$row['vrijeme'];
                    if($vrijeme=='0000-00-00 00:00:00' && $uspjesno_zavrseno==1){
                        $provjera=1;
                    }
                    if($vrijeme!='0000-00-00 00:00:00' && $uspjesno_zavrseno==0){
                        $provjera=1;
                    }
                }
        }
        if ($provjera == 0) {
//            $query_update2 = "UPDATE `etapa` SET zakljucano='1' WHERE etapa_id='" . $etapa . "'";
            $baza->updateDB($query_update2);
            
            $upit = "zakljucavanje etape";
            $tekst = $naddirektorij . "stranice/evidencija_vremena.php";
            $dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
            $baza->updateDB($dnevnik_insert);
        } else {
            $poruka = "Etapa se ne moze zakljucati jer nisu svi rezultati uneseni!!";
        }
    }
}

$baza->zatvoriDB();

$smarty->assign("korisnik", $korisnik);
$smarty->assign("etapa", $etapa);
$smarty->assign("naziv", $naziv);

$smarty->assign("poruka", $poruka);
$smarty->display("zaglavlje.tpl");
$smarty->display("evidencija_vremena.tpl");
$smarty->display("podnozje.tpl");

