<div id="forma">
         <h1>Evidencija vremena:</h1>
<br><br>
        <form id="formetapa" method="post" name="formetapa">
                    <label for="korisnikid">Korisnik ID: </label>
                    <input type="text" id="korisnikid" name="korisnikid" value={$korisnik} disabled><br><p></p>
                    <label for="etapaid">Etapa ID: </label>
                    <input type="text" id="etapaid" name="etapaid" value={$etapa} disabled><br><p></p>
                    <p> <label for="nazivetapa">Naziv etape: </label>
                    <input type="text" id="nazivetapa" name="nazivetapa" maxlength="30" autofocus required="required" value={$naziv} disabled><br><p></p>
                    <label for="opis">Uspjesno zavrseno: </label>
                    <input type="datetime-local" id="datum" name="datum"><br><p></p>
                    {if $smarty.session.uloga<=2}
                    <input type="checkbox" name="zakljucano"><strong> Zaključaj ovu etapu</strong><br>
                    {/if}
                    <br><input type="submit" name="odustani" value=" Odustani "> 
                    <input type="submit" name="azuriraj" value=" Ažuriraj "> 
                    <br>{$poruka}
        </form>
</div>
