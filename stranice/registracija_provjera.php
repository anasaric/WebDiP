<?php

$naddirektorij = (dirname(getcwd()));
$putanja=dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Registracija";

include "../zaglavlje.php";

$baza = new baza();
$baza->spojiDB();

if(!empty($_POST["korisnickoime"])) {

  $query = "SELECT * FROM korisnik WHERE korisnicko_ime='" . $_POST["korisnickoime"] . "'";
  $result = $baza->selectDB($query);
  
  if($result->num_rows>0) {
      echo "true";

  }else{
      echo "false";
  }
  
}

if(!empty($_POST["emailadresa"])) {

  $query = "SELECT * FROM korisnik WHERE email='" . $_POST["emailadresa"] . "'";
  $result = $baza->selectDB($query);
  
  if($result->num_rows>0) {
      echo "true";

  }else{
      echo "false";
  }
  
}


  $baza->zatvoriDB();

