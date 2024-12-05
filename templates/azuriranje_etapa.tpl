<div id="forma">
         <h1>Ažuriranje etape:</h1>
<br><br>
        <form novalidate id="formetapa" method="post" name="formetapa" onload="disable">
                    <label for="etapaid">Etapa ID: </label>
                    <input type="text" id="etapaid" name="etapaid" value={$kolacic} disabled><br><p></p>
                    <p> <label for="nazivetapa">Naziv etape: </label>
                    <input type="text" id="nazivetapa" name="nazivetapa" maxlength="30" autofocus required="required" value={$naziv_etape}><br>
                    <label for="opis">Opis: </label>
                    <input type="text" id="opis" name="opis" maxlength="30" required="required" value={$opis_etape}><br><p></p>
                    <label for="datum">Datum: </label>
                    <input type="datetime-local" id="datum" name="datum" value={$pocetak_utrke}><br><p></p>
                    <br><input type="submit" name="odustani" value=" Odustani "> 
                    <input type="submit" name="azuriraj" value=" Ažuriraj "> 
                    <br>{$poruka}
        </form>
</div>
