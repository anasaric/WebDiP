<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->

<html>
    <head>
        <title>{$naslov}</title>
        <meta charset="UTF-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{$putanja}/css/asaric.css" type="text/css"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="{$putanja}/javascript/javascript.js"></script>
        <script src="{$putanja}/javascript/jquery.js"></script>
    </head>
    
    <body id="bodybody">
        <header id="head"> 
             <div class="head">
                 <a href="#bodybody">
                     <img src="{$putanja}/materijali/menu.png" alt="navigacija" id="navigacija"></a>
                     <a href="#head">
                         <img src="{$putanja}/materijali/logo.png"  alt="logo" id="logo">  </a>
            {if !isset($smarty.session.uloga)}
            <a id="Registracija" href="{$putanja}/stranice/registracija.php"><p>Registracija</p></a>
            <a id="Prijava" href="{$putanja}/stranice/prijava.php"><p>Prijava</p></a>
            {/if}
            {if isset($smarty.session.uloga)}
            <a id="Odjava" href="{$putanja}/stranice/odjava.php"><p>Odjava</p></a>
            {/if}
              
             </div>
        </header>
         <nav>
             <ul>
                <li><a id="pocetna" href="{$putanja}/index.php">Početna stranica</a></li>
                <li><a id="ranglista" href="{$putanja}/stranice/rang_lista.php">Rang lista korisnika</a></li>
                <li><a id="galerija" href="{$putanja}/stranice/galerija.php">Galerija slika</a></li>
                <li><a id="ispiskorisnikaa" href="{$putanja}/privatno/ispis_korisnika.php">Popis svih korisnika</a></li>
                <li><a href="{$putanja}/obrasci/dokumentacija.html">Dokumentacija</a></li>
                <li><a id="oautoru" href="{$putanja}/obrasci/oautoru.html">O autoru</a></li>
                {if isset($smarty.session.uloga)}
                    {if $smarty.session.uloga<=3}
                        <li><a id="trenutneutrke" href="{$putanja}/stranice/popis_prijava.php">Popis prijava</a></li>
                        <li><a id="trenutneutrke" href="{$putanja}/stranice/trenutne_utrke.php">Trenutne utrke</a></li>
                        <li><a id="noveutrke" href="{$putanja}/stranice/nove_utrke.php">Popis novih utrka</a></li>
                        <li><a id="zavrseneutrke" href="{$putanja}/stranice/zavrsene_utrke.php">Završene utrke</a></li>
                        <li><a id="zavrseneutrke" href="{$putanja}/stranice/statistika_etapa.php">Statistika etapa</a></li>
                    {/if}
                    {if $smarty.session.uloga<=2}
                        <li><a id="popisutrka" href="{$putanja}/stranice/popis_utrka_etapa.php">Popis utrka</a></li>
                        <li><a id="popisprijavljenihkorisnika" href="{$putanja}/stranice/bodovno_stanje.php">Bodovno stanje</a></li>
                        <li><a id="popisprijavljenihkorisnika" href="{$putanja}/stranice/popis_svih_etapa.php">Popis etapa</a></li>
                        <li><a id="statistikamod" href="{$putanja}/stranice/statistika_utrka.php">Statistika utrka</a>
                    {/if}
                    {if $smarty.session.uloga==1}
                        <li><a id="popisdrzava" href="{$putanja}/stranice/popis_svih_utrka.php">Popis svih utrka</a></li>
                        <li><a id="popisdrzava" href="{$putanja}/stranice/popis_drzava.php">Popis država</a></li>
                        <li><a id="dnevnikrada" href="{$putanja}/stranice/dnevnik_rada.php">Dnevnik rada</a></li>
                    {/if}
                {/if}
                
                
                </ul>
            </nav>
