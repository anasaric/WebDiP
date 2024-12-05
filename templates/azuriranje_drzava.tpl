<div id="forma">
         <h1>Ažuriranje država:</h1>
<br><br>
        <form novalidate id="formetapa" method="post" name="formetapa">
                    <label for="drzavaid">Država ID: </label>
                    <input type="text" id="drzavaid" name="drzavaid" value={$kolacic} disabled><br><p></p>
                    <p> <label for="kontinent">Kontinent: </label>
                    <input type="text" id="kontinent" name="kontinent" maxlength="30" autofocus required="required" value={$kontinent}><br><p></p>
                    <label for="drzava">Država: </label>
                    <input type="text" id="drzava" name="drzava" maxlength="30" required="required" value={$drzava}><br><p></p>
                    <label for="stanovnici">Stanovnici: </label>
                    <input type="text" id="stanovnici" name="stanovnici" maxlength="30" required="required" value={$stanovnici}><br><p></p>
                    <br><input type="submit" name="odustani" value=" Odustani "> 
                    <input type="submit" name="azuriraj" value=" Ažuriraj "> 
                    <input type="submit" name="dodjeli" value=" Dodjeli moderatora ">
                   
        </form>
</div>
