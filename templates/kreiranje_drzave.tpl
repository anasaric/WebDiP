<div id="forma">
         <h1>Kreiranje države:</h1>
         <br><br><br>
        <form novalidate id="formdrzava" method="post" name="formdrzava">
            <p> <label for="nazivkontinent">Naziv kontinenta: </label>
                <input type="text" id="nazivkontinent" name="nazivkontinent" maxlength="30" autofocus required="required"><br>
            <p> <label for="nazivdrzava">Naziv države: </label>
                <input type="text" id="nazivdrzava" name="nazivdrzava" maxlength="30" required="required"><br>
             <p> <label for="brojstanovnika">Broj stanovnika: </label>
             <input type="number" id="brojstanovnika" name="brojstanovnika" required="required"><br><br><br>
             <input type="submit" name="odustani" value=" Odustani ">
            <input type="submit" name="spremi_drzavu" value=" Spremi ">
            <br>{$poruka}
        </form>
</div>
