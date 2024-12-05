<?php

$naddirektorij = dirname(getcwd());
$putanja = dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov = "Statistika utrka";

include "../zaglavlje.php";

$korisnicko_ime = $_SESSION['korisnik'];

$baza = new baza();
$baza->spojiDB();

$query_check = "SELECT `etapa`.etapa_id, COUNT(`bodovno_stanje`.uspjesno_zavrseno) AS `uspjesno_zavrseno` FROM `etapa` LEFT JOIN `bodovno_stanje` ON `bodovno_stanje`.etapa_id=`etapa`.etapa_id GROUP BY `etapa`.`etapa_id`";
$result_check = $baza->selectDB($query_check);
if ($result_check->num_rows > 0) {
    while ($row = $result_check->fetch_assoc()) {
            $etapa_id = $row['etapa_id'];
            $uspjesno_zavrseno = $row['uspjesno_zavrseno'];
            $podatci[] = array("etapa_id" => $etapa_id,
                        "uspjesno_zavrseno" => $uspjesno_zavrseno);
    }
    echo json_encode($podatci);
}



$baza->zatvoriDB();

