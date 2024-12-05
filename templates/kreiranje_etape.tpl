<div id="forma">
         <h1>Kreiranje etape:</h1>
         <br><br><br>
        <form novalidate id="formetapa" method="post" name="formetapa">
                    <p> <label for="nazivetapa">Naziv etape: </label>
                    <input type="text" id="nazivetapa" name="nazivetapa" maxlength="30" autofocus required="required"><br><p></p>
                    <label for="opis">Opis: </label>
                    <input type="text" id="opis" name="opis" maxlength="30" required="required"><br><p></p>
                     <label for="datumetapa">Datum i vrijeme početka: </label>
                    <input type="datetime-local" id="datumetapa" name="datumetapa" required="required"><br><p></p>
                    <input type="submit" name="kreiraj" value=" Kreiraj "> 
                    <br><br>{$poruka}
        </form>
</div>
