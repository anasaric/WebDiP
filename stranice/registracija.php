<?php 
$naddirektorij = (dirname(getcwd()));
$putanja = dirname(dirname($_SERVER["REQUEST_URI"]));
$naslov = "Registracija";

include "../zaglavlje.php";

$tekst = $_SERVER["PHP_SELF"];
$dnevnik = new dnevnik();
$dnevnik->setNazivDatoteke("$naddirektorij/izvorne_datoteke/dnevnik.log");
$dnevnik->spremiDnevnik("Otvorena je " . $tekst);

$problemi = "";
$brojac=0;
if (isset($_POST["registracija"])) {
    $noviKorisnik = array();
    foreach ($_POST as $key => $value) {
        if(empty($value)&&$brojac===0){
            $problemi.="Unesite sva polja!!!<br>";
            $brojac++;
        }
    
        if ($key === "registracija") continue;
        switch ($key) {
            case 'email': {
                    if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $value)) {
                        $problemi .= "Mail nije ispravan!<br>";
                    }
                    break;
                }
            case 'lozinka': {
                    if (!preg_match("/^.{5,20}$/", $value)) {
                        $problemi .= "Lozinka nije ispravna!<br>";
                    }
                    break;
                }
            case 'ime': {
                    if (!preg_match("/\d+/", $value)) {
                        $problemi .= "";
                    }
                    else{
                        $problemi .= "Ime nije ispravno!<br>";
                    }
                    break;
                }
            case 'prezime': {
                    if (!preg_match("/^[A-Z][a-z0-9_-]{3,19}$/", $value)) {
                        $problemi .= "Prezime nije ispravno!<br>";
                    }
                    break;
                }


            case 'lozinkapotvrda': {
                    if ($value !== $_POST["lozinka"]) {
                        $problemi .= "Ponovljena lozinka nije ispravna!<br>";
                    }
                    break;
                }
        }
}
}
$smarty->assign("problemi",$problemi);

$baza = new baza();
$baza->spojiDB();
$poruka="";

if (isset($_POST['registracija'])) {
    if (empty($problemi)) {
        $email=$_POST['emailadresa'];
        $ime=$_POST['ime'];
        $prezime=$_POST['prezime'];
        $korisnicko_ime=$_POST['korisnickoime'];
        $lozinka=$_POST['lozinka'];
        $potvrda = $_POST['lozinkapotvrda'];
        $lozinka_sha = hash('sha256', $_POST['lozinka']);
        $status_racuna = 0;
        $kod = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $broj_prijava = 0;
        $uvjeti = date("Y-m-d H:i:s");
        $tip_korisnika = 3;

        $query_insert = "INSERT INTO korisnik(`email`,`ime`,`prezime`,`korisnicko_ime`,`lozinka`,`potvrda_lozinke`,`lozinka_sha256`,`status_racuna`,`Aktivacija_racuna`,`broj_neuspjesne_prijave`,`datum_vrijeme`,`tip_korisnika_id`) VALUES('" . $email . "', '" . $ime . "', '" . $prezime . "', '" . $korisnicko_ime . "', '" . $lozinka . "', '" . $potvrda . "', '" . $lozinka_sha . "', '" . $status_racuna . "', '" . $kod . "', '" . $broj_prijava . "', '" . $uvjeti . "', '" . $tip_korisnika . "')";
        $baza->updateDB($query_insert);

        $upit = "registracija";
        $tekst = "Registracija novog korisnika u aplikaciju";
        $query = "SELECT * FROM `korisnik` WHERE korisnicko_ime='" . $korisnicko_ime . "'";
        $result = $baza->selectDB($query);
        $row = $result->fetch_assoc();
        $id = $row['korisnik_id'];
        $dnevnik_insert = "INSERT INTO dnevnik_rada (`datum_vrijeme`, `upit`, `opis_radnje`, `korisnik_id`) VALUES ('" . $uvjeti . "', '" . $upit . "', '" . $tekst . "', '" . $id . "')";
        $baza->updateDB($dnevnik_insert);

        $to = $email;
        $subject = 'Aktivirajte kod i potvrdite svoju registraciju!!';
        $message = "";
        $message = "Korisnicko ime : ".$korisnicko_ime."\nAktivacijski kod : ".$kod;
        $headers = 'From: asaric@foi.hr' . "\r\n" .
                    'Reply-To: asaric@foi.hr' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
    }
}


elseif(isset($_POST['aktivacija'])) {
    $kod2=$_POST['link'];
    $query_select="SELECT * FROM korisnik WHERE Aktivacija_racuna=".$kod2;
    $result = $baza->selectDB($query_select);
    $aktiviran=false;
    $datum="";
    if($result->num_rows>0) {
        $row=$result->fetch_assoc();
        if($row['status_racuna']==0){
            $aktiviran=true;
            $datum=$row['datum_vrijeme'];
            $korisnicko_ime=$row['korisnicko_ime'];
        }
        else{
            $poruka="Racun nije potrebno aktivirati";
        }  
    }
    else{
        $poruka="Neispravan kod";
    }
    
    if($aktiviran==true && $datum!==""){
        if((strtotime(date("Y-m-d H:i:s"))-strtotime($datum))>25200){
            $poruka = "Aktivacija je istekla, ponovno aktivirajte racun";
        } else {
            $query_update = "UPDATE korisnik SET status_racuna='1' WHERE Aktivacija_racuna= " . $kod2;
            $baza->updateDB($query_update);
            $poruka = "Uspjesna aktivacija racuna!";

            Header("Location: $putanja/stranice/prijava.php");
        }
    }
}

$baza->zatvoriDB();

$smarty->assign("poruka", $poruka);
$smarty->display("zaglavlje.tpl");
$smarty->display("registracija.tpl");
$smarty->display("podnozje.tpl");
?>

