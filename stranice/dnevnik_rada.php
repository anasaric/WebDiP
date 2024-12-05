<?php 
$naddirektorij = dirname(getcwd());
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Dnevnik rada";

include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();
//$id="";
//if(isset($_POST['pretrazi'])){
//    $korisnik=$_POST['korisnik'];
//    $query_select="SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnik . "'";
//    $result_select= $baza->selectDB($query_select);
//    $row = $result_select->fetch_assoc();
//    $id=$row['korisnik_id'];  
//    if()
//}

$baza->zatvoriDB();

$smarty->display("zaglavlje.tpl");
$smarty->display("dnevnik_rada.tpl");
$smarty->display("podnozje.tpl");

?>
