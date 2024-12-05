<?php 
$naddirektorij = dirname(getcwd());
$putanja = dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov="Prijava";

include "../zaglavlje.php";

$zapamtiprijavu="";
if(isset($_COOKIE['korisnik'])){
    $zapamtiprijavu=$_COOKIE['korisnik'];
}

if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}


$baza = new baza();
$baza->spojiDB();
$porukaa="";
$neuspjesno=0;

if(isset($_POST['prijava'])){
   if(isset($_COOKIE['korisnik'])){
        $korime=$_COOKIE['korisnik'];
    }
    else{
        $korime=$_POST['korisnickoime'];
    }
    
    $loz = hash('sha256', $_POST['lozinka']);
    $datum=date("Y-m-d H:i:s");
    
    $query_name="SELECT * FROM `korisnik` WHERE korisnicko_ime='".$korime."'";
    $query_pass="SELECT * FROM `korisnik` WHERE lozinka_sha256='".$loz."'";
    
    $result_name = $baza->selectDB($query_name);
    $result_pass = $baza->selectDB($query_pass);
    $row=$result_name->fetch_assoc();
    $kor_id = $row['korisnik_id'];
    $korisnickoime= $row['korisnicko_ime'];
    $uloga= $row['tip_korisnika_id'];
    $neuspjesne_prijave=$row['broj_neuspjesne_prijave'];

    if ($result_name->num_rows > 0) {
        if ($result_pass->num_rows > 0) {
            sesija::kreirajKorisnika($korime);
            
            $neuspjesno = 0;
            $query_update = "UPDATE `korisnik` SET broj_neuspjesne_prijave='" . $neuspjesno . "'" . " WHERE korisnicko_ime='" . $korime . "'";
            $baza->updateDB($query_update);

            $upit = "prijava";
            $tekst = "Prijava korisnika u aplikaciju";
            $dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $kor_id . "')";
            $baza->updateDB($dnevnik_insert);
            
            if(isset($_POST['check'])){
                setcookie("korisnik", $korisnickoime);
            }
            unset($_SESSION["korisnik"]);
            unset($_SESSION["uloga"]);
            $_SESSION["korisnik"]=$korisnickoime; 
            $_SESSION["uloga"]=$uloga;
            Header("Location: $putanja/index.php");
        } else {
            if($neuspjesne_prijave==2){
                $query_block="UPDATE `korisnik` SET broj_neuspjesne_prijave='".$neuspjesno."'"."AND blokiran='1' WHERE korisnicko_ime='".$korime."'";
                $baza->updateDB($query_block);
                
                $upit="blokiranje";
                $tekst="Korisnik je blokiran jer je 3 puta upisao krivu lozinku";
                $dnevnik_insert="INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $datum . "', '" . $upit . "', '" . $tekst . "', '" . $kor_id . "')";
                $baza->updateDB($dnevnik_insert);
                
                $porukaa="Netocno unesena lozinka. Racun vam je blokiran jer ste vise od dva puta unijeli krivu lozinku!";
            }
            
            else{
                $neuspjesne_prijave=$neuspjesne_prijave+1;
                $query_wrong_password="UPDATE `korisnik` SET broj_neuspjesne_prijave='".$neuspjesne_prijave."'"." WHERE korisnicko_ime='".$korime."'";
                $baza->updateDB($query_wrong_password);
                $porukaa = "Netocna lozinka";
            }
        }
    } else {
        $porukaa = "Netocno korisnicko ime!";
    }
}

if(isset($_POST['novalozinka'])){
    function Lozinka() {
        $znakovi = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $nova_lozinka = array(); 
        $duljina = strlen($znakovi) - 1; 
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $duljina);
            $nova_lozinka[] = $znakovi[$n];
        }
        return implode($nova_lozinka); 
    }

    $ime = $_POST['korisnickoime'];
    $query = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $ime . "'";
    $result = $baza->selectDB($query);
    if ($result->num_rows > 0) {
        $novalozinka= Lozinka();
        $row = $result->fetch_assoc();
        $mail = $row['email'];
        $to = $mail;
        $subject = 'Nova lozinka!!';
        $message = "";
        $message = "Korisnicko ime : " . $ime . "\nNova lozinka: " . $novalozinka;
        $headers = 'From: asaric@foi.hr' . "\r\n" .
                'Reply-To: asaric@foi.hr' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
        $lozinka_sha = hash('sha256', $novalozinka);
        $query_password="UPDATE `korisnik` SET lozinka='". $novalozinka."' WHERE korisnicko_ime='".$ime."'";
        $query_password2="UPDATE `korisnik` SET potvrda_lozinke='". $novalozinka."' WHERE korisnicko_ime='".$ime."'";
        $query_password3="UPDATE `korisnik` SET lozinka_sha256='". $lozinka_sha."' WHERE korisnicko_ime='".$ime."'";
        $baza->updateDB($query_password);
        $baza->updateDB($query_password2);
        $baza->updateDB($query_password3);
        
    } else {
        $porukaa = "Unesite ispravno korisnicko ime!!";
    }
}


$baza->zatvoriDB();

$smarty->assign("zapamtiprijavu", $zapamtiprijavu);
$smarty->assign("porukaa", $porukaa);
$smarty->display("zaglavlje.tpl");
$smarty->display("prijava.tpl");
$smarty->display("podnozje.tpl");
?>

