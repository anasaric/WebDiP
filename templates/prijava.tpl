<div class="grid">
            <div class="grid1">
                <img src="{$putanja}/materijali/run.jpg"  alt="run"> 
            </div>
            <div class="grid2">
                <br><br>
                <h2>Prijavite se i trčite!!</h2>
                <br><br><br>
                <form novalidate id="formprijava" method="post" name="formprijava">
                    <p><label for="korisnickoime"><em>Korisničko ime: </em></label>
                        <input type="text" id="korisnickoime" name="korisnickoime" size="30" maxlength="30" placeholder="korisničko ime" autofocus="autofocus" required="required" value="{$zapamtiprijavu}"><br>
                    <p></p> 
                        <label for="lozinka"><em>Lozinka: </em></label>
                        <input type="password" id="lozinka" name="lozinka" size="30" maxlength="30" placeholder="lozinka" required="required"><br>
                    <p>
                    <input type="checkbox" name="check" value="1"><strong> Zapamti moju prijavu</strong><br></p>
                    <input type="submit" name="prijava" value=" Prijavi se ">
                    <input type="reset" value=" Inicijaliziraj "> <br><br><br>
                     <a id="novimail" ><p>Zaboravili ste lozinku?</p></a>
                     <input type="submit" name="novalozinka" value="Nova lozinka"> <br>
                </form>
                 
                {$porukaa}
            </div>         
</div>
