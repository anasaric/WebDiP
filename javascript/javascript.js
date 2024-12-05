window.addEventListener("DOMContentLoaded", kreirajDogadaje);

function kreirajDogadaje() {
    if (document.title === "Registracija") {
        console.log("Registracija")
    }
    formular = document.getElementById("formregistracija");
    formular.addEventListener("submit", function (event) {
        var recaptcha_response = grecaptcha.getResponse();
        console.log(recaptcha_response);

        if (recaptcha_response.length === 0) {
            document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">Potvrdite da niste robot!!</span>';
            event.preventDefault();
            return false;
        } else {
            recaptcha_response = grecaptcha.getResponse();
            document.getElementById('g-recaptcha-error').innerHTML = '';
            return true;
        }
        
    });



    var greske = document.getElementById('jsemail');
    var email = document.getElementById('emailadresa');
    greske.innerHTML="";
    email.addEventListener("keyup", function (event) {
        
        var unos=this.value;
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (unos.match(mailformat))
        {
            greske.innerHTML ='';
            return true;
        } else
        {
            greske.innerHTML ='Pogrešna sintaksa mail adrese!'+"\n";
            return false;
        }
        
    });  
    
    var greske2 = document.getElementById('jslozinka');
    var lozinka = document.getElementById('lozinka');
    lozinka.addEventListener("keyup", function (event) {
        var unos=this.value;
        if (unos.length<=20 && unos.length>=5)
        {
            greske2.innerHTML ='';
            return true;
        } else
        {
            greske2.innerHTML ='Lozinka mora imati izmedu 5 i 20 znakova!'+"\n";
            return false;
        }
        
    });
    
    var greske3 = document.getElementById('jsime');
    var ime = document.getElementById('ime');
    ime.addEventListener("keyup", function (event) {
        var unos=this.value;
        var mailformat =".*\\d.*";
        if (unos.match(mailformat))
        {
            greske3.innerHTML ='U ime ste upisali brojeve!'+"\n";
            return false;
        } else
        {
            greske3.innerHTML ='';
            return true;
        }
        
    });
    
    var greske4 = document.getElementById('jsprezime');
    var prezime = document.getElementById('prezime');
    prezime.addEventListener("keyup", function (event) {
        var unos=this.value;
        var mailformat =/^[A-Z][a-z0-9_-]{3,19}$/;
        if (unos.match(mailformat))
        {
            greske4.innerHTML ='';
            return true;

        } else
        {
            greske4.innerHTML ='Prezime mora poceti velikim slovom!'+"\n";
            return false;
        }
        
    });
    
    var greske5 = document.getElementById('jspotvrda');
    var lozinka = document.getElementById('lozinka');
    var lozinkapotvrda = document.getElementById('lozinkapotvrda');
    lozinkapotvrda.addEventListener("keyup", function (event) {
        var unos=this.value;
        if (unos===lozinka.value)
        {
            greske5.innerHTML ='';
            return true;

        } else
        {
            greske5.innerHTML ='Potvrda lozinke se ne podudara s lozinkom'+"\n";
            return false;
        }
        
    });
    
    function disable(){
        document.getElementById("datumetapa").disabled = true;
    }

}





