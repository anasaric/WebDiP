<?php

$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Popis država";
include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();
$query = "SELECT * FROM `drzava`";
$result = $baza->selectDB($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $drzava_id=$row['drzava_id'];
        $kontinent=$row['kontinent'];
        $drzava=$row['naziv_drzave'];
        $stanovnici=$row['broj_stanovnika'];
        $podatci[]=array("id"=>$drzava_id,
                        "kontinent"=>$kontinent,
                        "drzava"=>$drzava,
                        "stanovnici"=>$stanovnici);
    } 
    echo json_encode($podatci);
} 

$baza->zatvoriDB();

