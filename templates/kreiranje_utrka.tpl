<div id="forma">
         <h1>Kreiranje utrke:</h1>
         <br><br>
         <form novalidate id="formutrka" method="post" name="formutrka">
             <label>Tip utrke: </label>
             <input list="tip_utrke_list" id="utrka" name="utrka" />
            `<datalist id="tip_utrke_list">

             </datalist>
             <p> <label for="opisutrke">Opis utrke: </label>
             <input type="text" id="opisutrke" name="opisutrke" maxlength="30" required="required"><br><br>
             <label for="datumutrka">Datum završetka prijava: </label>
             <input type="datetime-local" id="datumutrka" name="datumutrka" required="required"><br><br>
             <label>Država: </label>
             <input list="drzava_list" id="drzava" name="drzava" />
            `<datalist id="drzava_list">

             </datalist>
             <br><br>
             <input type="submit" name="odustani" value=" Odustani ">
             <input type="submit" name="spremi" value=" Spremi ">
             <br><br>{$poruka}
         </form>
        </div>
