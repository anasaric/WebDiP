<div id="forma">
        <h1>Statistika utrka:</h1>
</div>

<table border=1 id="statistikautrkatablica">
    <thead>
        <tr>
            <th>Korisnik ID</th>
            <th>Etapa ID</th>
            <th>Naziv etape</th>
            <th>Uspješno završeno </th>
            <th>Vrijeme </th>
        </tr>
    </thead>
    <tbody>
                    
    </tbody>  
</table>
<br><br>
{if $smarty.session.uloga==1}
<form novalidate id="formstatistika" method="post" name="formstatistika">
    <label>Sortiraj po:  </label>
    <input type="radio" id="naziv_etape" name="naziv_etape"><label for="naziv_etape">Naziv etape</label>
    <input type="radio" id="uspjesno_zavrseno" name="uspjesno_zavrseno"><label for="uspjesno_zavrseno">Uspješno završeno</label>
    <input name="sortiraj" id="sortiraj" type="submit" value="Sortiraj"><br><br>
    <br><br> <button onclick="window.print();"> Print </button>
    <input type="submit" name="pdfgenerator" value="Generiraj pdf"> 
</form>

 <div id="chart">
        <canvas id="graf"></canvas>
</div>
{/if}