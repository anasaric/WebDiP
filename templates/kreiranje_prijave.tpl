<div id="forma">
         <h1>Prijava utrke:</h1>
         <br>
        <form novalidate id="formprijavautrke" method="post" name="formprijavautrke">
                    {$poruka}
                    <br><br><br><label for="utrkaid">Utrka ID: </label>
                    <input type="text" id="utrkaid" name="utrkaid" value={$kolacic} disabled><br><p></p>
                    <label for="datum">Datum rođenja: </label>
                    <input type="date" id="datum" name="datum" required="required" value={$AssignDatum} ><br><p></p>
                    <label for="slika">Slika: </label>
                    <input type="file" id="slika" name="slika" required="required"><br><p></p>
                    <input type="submit" name="prijava" value=" Spremi "> 
        </form>
        
</div>
