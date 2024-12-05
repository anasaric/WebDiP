<div id="forma">
        <h1>Galerija slika</h1>
</div>

<table border=1 id="galerijatablica">
    <thead>
        <tr>
            <th> Utrka ID</th>
            <th> Ime</th>
            <th>Prezime </th>
            <th width="100" height="100" >Slika</th>
        </tr>
    </thead>
    <tbody>
                    
    </tbody>  
</table>
<br><br>
<form novalidate id="formagalerija" method="post" name="formagalerija">
    <label>Sortiraj po:  </label>
    <input type="radio" id="galerija_ime" name="galerija_ime"><label for="galerija_ime">Ime</label>
    <input type="radio" id="galerija_prezime" name="galerija_prezime"><label for="galerija_prezime">Prezime</label>
    <input name="sortiraj" id="sortiraj" type="submit" value="Sortiraj"><br><br>
    <input list="drzave_list" id="drzave" name="drzave" />
    <datalist id="drzave_list">

    </datalist>
     <input name="pretrazi" id="pretrazi" type="submit" value="Pretraži"><br><br>
</form>