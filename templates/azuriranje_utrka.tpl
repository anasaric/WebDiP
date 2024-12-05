<div id="forma">
         <h1>Ažuriranje utrke:</h1>
         <br><br><br>
         <form novalidate id="formutrka" method="post" name="formutrka">
             <label for="utrkaid">Utrka ID: </label>
             <input type="text" id="utrkaid" name="utrkaid" value={$kolacic} disabled><br>
             <label for="tiputrke">Tip utrke: </label>
             <input type="text" id="tiputrke" name="tiputrke" value={$tip_utrke} disabled><br>
             <p> <label for="opisutrke">Opis utrke: </label>
             <input type="text" id="opisutrke" name="opisutrke" maxlength="30" required="required"><br>
             <label for="datumutrka">Datum i vrijeme početka: </label>
             <input type="datetime-local" id="datumutrka" name="datumutrka" ><br><br>
             <label for="drzavaid">Država ID: </label>
             <input type="text" id="drzavaid" name="drzavaid" value={$drzava_id} disabled><br>
             <input type="submit" name="odustani" value=" Odustani "> 
             <input type="submit" name="azuriraj" value=" Ažuriraj "> 
         </form>
</div>
