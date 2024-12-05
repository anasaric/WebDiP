<?php
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Popis svih etapa";

include "../zaglavlje.php";

$korisnicko_ime=$_SESSION['korisnik'];

$baza = new baza();
$baza->spojiDB();

$query_korisnik = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result2 = $baza->selectDB($query_korisnik);
$row = $result2->fetch_assoc();
$id = $row['korisnik_id'];

$query_select="SELECT * FROM `utrka` INNER JOIN `drzava` ON `utrka`.drzava_id=`drzava`.drzava_id INNER JOIN `dodjeli_moderatora` ON `dodjeli_moderatora`.drzava_id=`drzava`.drzava_id WHERE `dodjeli_moderatora`.korisnik_id='".$id."'" ;
$result = $baza->selectDB($query_select);
$roww = $result->fetch_assoc();



if ($result->num_rows > 0) {
    while ($roww = $result->fetch_assoc()) {
        $utrka_id = $roww['utrka_id'];
        $query_check="SELECT `prijava`.korisnik_id, `etapa`.etapa_id,`etapa`.naziv_etape, `bodovno_stanje`.uspjesno_zavrseno, `bodovno_stanje`.vrijeme FROM `prijava` LEFT JOIN `etapa` ON `prijava`.utrka_id=`etapa`.utrka_id INNER JOIN `bodovno_stanje` ON `bodovno_stanje`.etapa_id=`etapa`.etapa_id WHERE `prijava`.utrka_id='" . $utrka_id . "'";
        $result_check = $baza->selectDB($query_check);
        if ($result_check->num_rows > 0) {
            while ($rowww = $result_check->fetch_assoc()) {
                $korisnik_id=$rowww['korisnik_id'];
                $etapa_id=$rowww['etapa_id'];
                $naziv_etape=$rowww['naziv_etape'];
                $zavrseno=$rowww['uspjesno_zavrseno'];
                if($zavrseno==0){
                    $uspjesno_zavrseno='odustao';
                }
                else{
                    $uspjesno_zavrseno='zavrsio';
                }
                $vrijeme=$rowww['vrijeme'];
                $podatci[]=array("korisnik_id"=>$korisnik_id,
                        "etapa_id"=>$etapa_id,
                        "naziv_etape"=>$naziv_etape,
                        "uspjesno_zavrseno"=>$uspjesno_zavrseno,
                        "vrijeme"=>$vrijeme);
    
            }
        }
        
    }
    echo json_encode($podatci);
    
} 



$baza->zatvoriDB();
