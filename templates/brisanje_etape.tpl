<div id="forma">
         <h1>Brisanje etape:</h1>
         <br><br>
        <form id="formetapa" method="post" name="formetapa" onload="disable">
                    <label for="etapaid">Etapa ID: </label>
                    <input type="text" id="etapaid" name="etapaid" value={$kolacic} disabled><br><p></p>
                    <p> <label for="nazivetapa">Naziv etape: </label>
                    <input type="text" id="nazivetapa" name="nazivetapa" maxlength="30" autofocus required="required" value={$naziv_etape} disabled><br>
                    <label for="opis">Opis: </label>
                    <input type="text" id="opis" name="opis" maxlength="30" required="required" value={$opis_etape} disabled><br><p></p>
                    <br><input type="submit" name="odustani" value=" Odustani "> 
                    <input type="submit" name="obrisi" value=" Obriši "> 
        </form>
</div>
