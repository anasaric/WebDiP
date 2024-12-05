<div id="forma">
        <h1>Rang lista korisnika</h1>
</div>
<br><br>
<table border=1 id="ranglistatablica">
    <thead>
        <tr>
            <th>Korisnik ID</th>
            <th>Etapa ID</th>
            <th>Uspjesno zavrseno</th>
            <th>Vrijeme</th>
            <th>Mjesto</th>
            <th>Bodovi</th>
        </tr>
    </thead>
    <tbody>
                    
    </tbody>  
</table>
<br><br>
<form novalidate id="formarangliste" method="post" name="formarangliste">
    <label for="datumod">Datum Od: </label><input type="date" id="datumod" name="od">
    <label for="datumdo">Datum Do: </label><input type="date" id="datumdo" name="do">
    <input name = "vremenskorazdoblje" id= "vremenskorazdoblje" type="submit" value=" Filtriraj po datumu ">
</form>

             