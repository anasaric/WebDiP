<div id="forma">
        <h1>Statistika etapa: </h1>
</div>
<table border=1 id="statistikaetapatablica">
    <thead>
        <tr>
            <th>Kontinent </th>
            <th>Naziv drzave </th>
            <th>Broj završenih etapa</th>
            <th> Ostvareni bodovi</th>            
        </tr>
    </thead>
    <tbody>
                    
    </tbody>  
</table>
<br><br>
{if $smarty.session.uloga==1}
<form novalidate id="formastatistikaetapa" method="post" name="formastatistikaetapa">
    <label>Sortiraj po:  </label>
    <input type="radio" id="kontinent" name="kontinent"><label for="kontinent">Kontinent</label>
    <input type="radio" id="bodovi" name="bodovi"><label for="bodovi">Bodovi</label>
    <input name="sortiraj" id="sortiraj" type="submit" value="Sortiraj"><br><br>
    <button onclick="window.print();"> Print </button>
</form>

 <div id="chart">
        <canvas id="graf"></canvas>
</div>
 {/if}