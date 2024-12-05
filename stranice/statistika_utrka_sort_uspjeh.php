<?php
$naddirektorij = dirname(getcwd());
$putanja = dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov = "Statistika utrka";

include "../zaglavlje.php";

$korisnicko_ime = $_SESSION['korisnik'];

$baza = new baza();
$baza->spojiDB();

$query_korisnik = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
$result2 = $baza->selectDB($query_korisnik);
$row = $result2->fetch_assoc();
$id = $row['korisnik_id'];

$datum = date("Y-m-d H:i:s");
$upit = "sortiranje statistike utrka po uspjehu";
$tekst = $naddirektorij . "stranice/statistika_etape.php";
$dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
$baza->updateDB($dnevnik_insert);

$query_check = "SELECT `bodovno_stanje`.korisnik_id, `etapa`.etapa_id,`etapa`.naziv_etape, `bodovno_stanje`.uspjesno_zavrseno, `bodovno_stanje`.vrijeme FROM `etapa` LEFT JOIN `bodovno_stanje` ON `bodovno_stanje`.etapa_id=`etapa`.etapa_id ORDER BY `bodovno_stanje`.uspjesno_zavrseno";
$result_check = $baza->selectDB($query_check);
if ($result_check->num_rows > 0) {
    while ($rowww = $result_check->fetch_assoc()) {
        $korisnik_id = $rowww['korisnik_id'];
        $etapa_id = $rowww['etapa_id'];
        $naziv_etape = $rowww['naziv_etape'];
        $zavrseno = $rowww['uspjesno_zavrseno'];
        if ($zavrseno == 0) {
            $uspjesno_zavrseno = 'odustao';
        } else {
            $uspjesno_zavrseno = 'zavrsio';
        }
        $vrijeme = $rowww['vrijeme'];
        $podatci[] = array("korisnik_id" => $korisnik_id,
            "etapa_id" => $etapa_id,
            "naziv_etape" => $naziv_etape,
            "uspjesno_zavrseno" => $uspjesno_zavrseno,
            "vrijeme" => $vrijeme);
    }


    echo json_encode($podatci);
}

$baza->zatvoriDB();
