<?php 
$naddirektorij = getcwd();
if(strpos(($_SERVER["REQUEST_URI"]), "index.php")){
$putanja = dirname($_SERVER["REQUEST_URI"]);
}
else{
    $putanja = ($_SERVER["REQUEST_URI"]);
}
$naslov="Pocetna";
include "zaglavlje.php";

$smarty->display("zaglavlje.tpl");
$smarty->display("index.tpl");
$smarty->display("podnozje.tpl");
?>


       

