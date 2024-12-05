<div id="forma">
         <h1>Dodjeli moderatora državi:</h1>
<br><br>
        <form novalidate id="formamoderator" method="post" name="formamoderator">
                    <label for="etapaid">Država ID: </label>
                    <input type="text" id="etapaid" name="etapaid" value={$kolacic} disabled><br><p></p>
                    <label>Korisničko ime: </label>
                    <input list="korisnici_list" id="korisnici" name="korisnici" />
                    <datalist id="korisnici_list">

                    </datalist>
                    <br><br>
                    <input type="submit" name="odustani" value=" Odustani "> 
                    <input type="submit" name="dodjeli" value=" Dodjeli moderatora ">
                    <br><br>{$poruka}
        </form>
</div>
