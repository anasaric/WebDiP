<div class="grid">
            <div class="grid1">
                <img src="{$putanja}/materijali/run.jpg"  alt="run">
                
            </div>
            <div class="grid2">
                <h2>Registrirajte se i sudjelujte u brojnim utrkama!</h2>
                <form novalidate id="formregistracija" method="post" name="formregistracija">
                    <p> <label for="ime">Ime: </label>
                    <input type="text" id="ime" name="ime" size="30" maxlength="30" placeholder="Ime" autofocus required="required"><br>
                    <label for="prezime">Prezime: </label>
                    <input type="text" id="prezime" name="prezime" size="30" maxlength="30" placeholder="Prezime" required="required"><br><p></p>
                    <label for="emailadresa">E-mail adresa: </label>
                    <input type="email" id="emailadresa" name="emailadresa" size="40" maxlength="40" placeholder="Idap@foi.hr" required="required"><br><p></p>
                    <span id="emailerror"></span>
                    <label for="korisnickoime">Korisničko ime: </label>
                    <input type="text" id="korisnickoime" name="korisnickoime" size="25" maxlength="25" pattern=".{6}" placeholder="korisničko ime" required="required"><br><p></p>
                    <span id="usernameerror"></span>
                    <label for="lozinka">Lozinka: </label>
                    <input type="password" id="lozinka" name="lozinka" placeholder="lozinka" required="required"><br><p></p>
                    <label for="lozinkapotvrda">Potvrda lozinke: </label>
                    <input type="password" id="lozinkapotvrda" name="lozinkapotvrda" pattern=".{6}" placeholder="potvrda lozinke" required="required"><br><p></p>
                    <span id="jsime"></span>
                    <span id="jsprezime"></span>
                    <span id="jsemail"></span>
                    <span id="jslozinka"></span>
                    <span id="jspotvrda"></span>
                    <div class="g-recaptcha" data-sitekey="6LevOS0gAAAAABCGmkg48M6neYZyxVPv0nRWGnFG" ></div>
                    <div id="g-recaptcha-error"></div>
                    <input name = "registracija" type="submit" value=" Registriraj se ">
               </form>  
               {$problemi}
               <br><br><br>
               <form novalidate name="formalink" method="post">
                   <label for="link">Unesite aktivacijski link:</label>
                   <input type="text" name="link" id="link" required="required">
                   <input name="aktivacija" type="submit" value=" Aktivacija">
               </form>
               {$poruka}
            </div>
        </div>
