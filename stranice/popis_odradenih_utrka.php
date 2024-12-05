<?php 
$naddirektorij = dirname(getcwd());
$putanja=dirname($_SERVER["REQUEST_URI"]);
$naslov="Popis odradenih utrka";

if($putanja==="/asaric/asaric/stranice"){
    $putanja="/asaric/asaric";
}

include "../zaglavlje.php";

$smarty->display("zaglavlje.tpl");
$smarty->display("popis_odradenih_utrka.tpl");
$smarty->display("podnozje.tpl");

?>
