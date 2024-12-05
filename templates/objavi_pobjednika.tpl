<div id="forma">
         <h1>Objava pobjednika:</h1>
         <br><br>
        <form id="formetapa" method="post" name="formetapa">
                    <label for="etapaid">Etapa ID: </label>
                    <input type="text" id="etapaid" name="etapaid" value={$kolacic} disabled><br><p></p>
                    <label for="ime">Ime: </label>
                    <input type="text" id="ime" name="ime" value={$ime} disabled><br><p></p>
                    <p> <label for="prezime">Prezime: </label>
                    <input type="text" id="prezime" name="prezime" value={$prezime} disabled><br><br>
                    <input type="submit" name="odustani" value=" Odustani "> 
                    <input type="submit" name="objavi" value=" Objavi "> 
                    <br><br>{$poruka}
        </form>
</div>
