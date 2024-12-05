<?php
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Kreiranje utrka";
include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();
$query = "SELECT * FROM `tip_utrke`"; 
$result = $baza->selectDB($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $naziv_utrke=$row['naziv_utrke'];
        $podatci[]=array("naziv_utrke"=>$naziv_utrke);
    } 
    echo json_encode($podatci);
} 

$baza->zatvoriDB();

