<?php
require "$naddirektorij/baza.php";
require "$naddirektorij/sesija.php";
require "$naddirektorij/dnevnik.php";
require "$naddirektorij/vanjske_biblioteke/smarty-4.0.0/libs/Smarty.class.php";

sesija::kreirajSesiju();

$smarty=new Smarty();
$smarty->setTemplateDir("$naddirektorij/templates")
        ->setCompileDir("$naddirektorij/templates_c");
$smarty->assign("naddirektorij", $naddirektorij);
$smarty->assign("putanja", $putanja);
$smarty->assign("naslov", $naslov);

if(isset($_COOKIE["korisnik"]) && isset($_GET["odjava"])){
    unset($_COOKIE["korisnik"]);
}

if(isset($_GET["odjava"])){
    echo "ODJAVA";
    Sesija::obrisiSesiju();
}





