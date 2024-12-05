<?php
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Galerija";
include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();
$query = "SELECT * FROM `drzava`"; 
$result = $baza->selectDB($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $naziv_drzave=$row['naziv_drzave'];
        $podatci[]=array("naziv_drzave"=>$naziv_drzave);
    } 
    echo json_encode($podatci);
} 

$baza->zatvoriDB();

