$(document).ready(function () {
    naslov = $(document).find("title").text();
    switch (naslov) {
        case "Registracija":
            $('#korisnickoime').keyup(function (event) {
                $.ajax({
                    url: "registracija_provjera.php",
                    data: $("#korisnickoime").serialize(),
                    
                    type: "POST",
                    success: function (data) {
                        if (data === "false") {
                            $('#usernameerror').html('');
                            event.preventDefault();
                        } else {
                            $('#usernameerror').html('<span style="color:red;">Korisnicko ime je zauzeto!!!<br></span>');
                            event.preventDefault();
                        }
                        console.log($("#korisnickoime").serialize());
                    },
                    error: function (xhr, status, error) {
                        alert("Krivo ste upisali: " + error.responseText);
                    }
                });
            });
            
            $('#emailadresa').keyup(function (event) {
                $.ajax({
                    url: "registracija_provjera.php",
                    data: $("#emailadresa").serialize(),
                    
                    type: "POST",
                    success: function (data) {
                        if (data === "false") {
                            $('#emailerror').html('');
                            event.preventDefault();
                        } else {
                            $('#emailerror').html('<span style="color:red;">Email je zauzet!!!<br></span>');
                            event.preventDefault();
                        }
                    },
                    error: function (xhr, status, error) {
                        alert("Krivo ste upisali: " + error.responseText);
                    }
                });
            });
        break;
        
        case "Ispis korisnika": 
            $.ajax({
                url: "ispis_korisnika_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                        console.log(data);
                        var number = data.length;
                        for (var i = 0; i < number; i++){
                        var korisnicko_ime = data[i].korisnicko_ime;
                        var prezime = data[i].prezime;
                        var ime = data[i].ime;
                        var email = data[i].email;
                        var lozinka = data[i].lozinka;
                        
                        var tablica = "<tr>" +
                        "<td align='center'>" + korisnicko_ime + "</td>" +
                        "<td align='center'>" + prezime + "</td>" +
                        "<td align='center'>" + ime + "</td>" +
                        "<td align='center'>" + email + "</td>" +
                        "<td align='center'>" + lozinka + "</td>" +                     
                        "</tr>";
                        $("#ispiskorisnika tbody").append(tablica);
                    }
            }
        });
            
        break;
        case "Popis država":
        $.ajax({
                url: "popis_drzava_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                        console.log(data);
                        var number = data.length;
                        for (var i = 0; i < number; i++){
                        var id = data[i].id;
                        var kontinent = data[i].kontinent;
                        var drzava = data[i].drzava;
                        var stanovnici = data[i].stanovnici;
                        
                        var tablica = "<tr>" +
                        "<td align='center'>" + id + "</td>" +
                        "<td align='center'>" + kontinent + "</td>" +
                        "<td align='center'>" + drzava + "</td>" +
                        "<td align='center'>" + stanovnici + "</td>" +
                        "</tr>";
                        $("#drzavetablica tbody").append(tablica);
                    }
            }
        });
        $('#drzavetablica tbody').on('click', 'tr', function () {
                var id=$(this).find('td:first').text();
                document.cookie = "Drzava=" + id + " ;path=/";
                window.location.href = '../stranice/azuriranje_drzava.php';
        });
        break;
        case "Rang lista":
        $.ajax({
                url: "rang_lista_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                        console.log(data);
                        var number = data.length;
                        for (var i = 0; i < number; i++){
                        var korisnik_id = data[i].korisnik_id;
                        var etapa_id = data[i].etapa_id;
                        var uspjesno_zavrseno = data[i].uspjesno_zavrseno;
                        var vrijeme = data[i].vrijeme;
                        var mjesto = data[i].mjesto;
                        var bodovi = data[i].bodovi;
                        
                        var tablica = "<tr>" +
                        "<td align='center'>" + korisnik_id + "</td>" +
                        "<td align='center'>" + etapa_id + "</td>" +
                        "<td align='center'>" + uspjesno_zavrseno + "</td>" +
                        "<td align='center'>" + vrijeme + "</td>" +
                        "<td align='center'>" + mjesto + "</td>" +
                        "<td align='center'>" + bodovi + "</td>" +
                        "</tr>";
                        $("#ranglistatablica tbody").append(tablica);
                    }
            }
        });
        
         $('#vremenskorazdoblje').click(function (event) {
            var datumdo=$("#datumdo").val();
            var datumod=$("#datumod").val();
             
            if(datumdo!==null && datumod!==null){
            event.preventDefault();
             $("#ranglistatablica tbody").empty();
             $.ajax({
                url: "rang_lista_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                        var number = data.length;
                        for (var i = 0; i < number; i++){
                        if(data[i].vrijeme<datumdo && data[i].vrijeme>datumod){
                        var korisnik_id = data[i].korisnik_id;
                        var etapa_id = data[i].etapa_id;
                        var uspjesno_zavrseno = data[i].uspjesno_zavrseno;
                        var vrijeme = data[i].vrijeme;
                        var mjesto = data[i].mjesto;
                        var bodovi = data[i].bodovi;
                        
                        var tablica = "<tr>" +
                        "<td align='center'>" + korisnik_id + "</td>" +
                        "<td align='center'>" + etapa_id + "</td>" +
                        "<td align='center'>" + uspjesno_zavrseno + "</td>" +
                        "<td align='center'>" + vrijeme + "</td>" +
                        "<td align='center'>" + mjesto + "</td>" +
                        "<td align='center'>" + bodovi + "</td>" +
                        "</tr>";
                        $("#ranglistatablica tbody").append(tablica);
                        }
                        }
                    }
                });
            }
            else{
                alert('unesite podatke kako bi mogli filtrirati tablicu!!');
            }
         });
            break;
        case "Galerija":
            $.ajax({
                url: "galerija_popis_drzava.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                    var number = data.length;
                        for (var i = 0; i < number; i++){
                        var naziv_drzave = data[i].naziv_drzave;
                        
                        $("#drzave_list").append('<option value="' + naziv_drzave + '">' + naziv_drzave + '</option>');
                    }
                }
            });
            $.ajax({
                url: "galerija_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                    console.log(data);
                    var number = data.length;
                        for (var i = 0; i < number; i++){
                        var utrka_id = data[i].utrka_id;
                        var ime = data[i].ime;
                        var prezime = data[i].prezime;
                        var slika_putanja = data[i].slika_putanja;
                        
                        var tablica = "<tr>" +
                        "<td align='center'>" + utrka_id + "</td>" +
                        "<td align='center'>" + ime + "</td>" +
                        "<td align='center'>" + prezime + "</td>" +
                        "<td align='center'>" + '<img src="../materijali/' + slika_putanja + '" wildth="200" height="200">' + "</td>" +
                        "</tr>";
                        $("#galerijatablica tbody").append(tablica);
                    }
                }
            });


            $('#sortiraj').click(function (event) {
                event.preventDefault();
                $("#galerijatablica tbody").empty();
                if ($('#galerija_ime').is(':checked')) {

                    $.ajax({
                        url: "galerija_sort_ime.php",
                        dataType: 'JSON',
                        type: 'GET',
                        success: function (data) {
                            var number = data.length;
                            for (var i = 0; i < number; i++){
                            var utrka_id = data[i].utrka_id;
                            var ime = data[i].ime;
                            var prezime = data[i].prezime;
                            var slika_putanja = data[i].slika_putanja;
                        
                            var tablica = "<tr>" +
                            "<td align='center'>" + utrka_id + "</td>" +
                            "<td align='center'>" + ime + "</td>" +
                            "<td align='center'>" + prezime + "</td>" +
                            "<td align='center'>" + '<img src="../materijali/' + slika_putanja + '" wildth="200" height="200">' + "</td>" +
                            "</tr>";
                            $("#galerijatablica tbody").append(tablica);
                        }
                    }
                });
                }
                else if ($('#galerija_prezime').is(':checked')) {

                    $.ajax({
                        url: "galerija_sort_prezime.php",
                        dataType: 'JSON',
                        type: 'GET',
                        success: function (data) {
                            var number = data.length;
                            for (var i = 0; i < number; i++){
                            var utrka_id = data[i].utrka_id;
                            var ime = data[i].ime;
                            var prezime = data[i].prezime;
                            var slika_putanja = data[i].slika_putanja;
                        
                            var tablica = "<tr>" +
                            "<td align='center'>" + utrka_id + "</td>" +
                            "<td align='center'>" + ime + "</td>" +
                            "<td align='center'>" + prezime + "</td>" +
                            "<td align='center'>" + '<img src="../materijali/' + slika_putanja + '" wildth="200" height="200">' + "</td>" +
                            "</tr>";
                            $("#galerijatablica tbody").append(tablica);
                        }
                    }
                });
                }
                else{
                    alert('Nije validan input!');
                }
                
                $('input[type=radio]').each(function ()
                {
                    this.checked = false;
                });
            });
            
            
            $('#pretrazi').click(function (event) {
                var drzava=$("#drzave").val();
                event.preventDefault();
                $("#galerijatablica tbody").empty();
                $.ajax({
                url: "galerija_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                        var number = data.length;
                        for (var i = 0; i < number; i++){
                        if(drzava===data[i].naziv_drzave){
                        var utrka_id = data[i].utrka_id;
                        var ime = data[i].ime;
                        var prezime = data[i].prezime;
                        var slika_putanja = data[i].slika_putanja;
                        
                        var tablica = "<tr>" +
                        "<td align='center'>" + utrka_id + "</td>" +
                        "<td align='center'>" + ime + "</td>" +
                        "<td align='center'>" + prezime + "</td>" +
                                "<td align='center'>" + '<img src="../materijali/' + slika_putanja + '" wildth="200" height="200">' + "</td>" +
                                "</tr>";
                        $("#galerijatablica tbody").append(tablica);
                    }
                    
                    }
                }
            });
        });
        break;
        case "Nove utrke":
            var datum = new Date();
            var dd = String(datum.getDate()).padStart(2, '0');
            var mm = String(datum.getMonth() + 1).padStart(2, '0'); 
            var yyyy = datum.getFullYear();
            datum = yyyy + '-' + mm + '-' + dd;
            
            $.ajax({
                url: "nove_utrke_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                    console.log(data);
                    var number = data.length;
                        for (var i = 0; i < number; i++){
                        if(data[i].zakljucano==0 && data[i].datum_zavrsetka_prijava>datum){
                        var utrka_id = data[i].utrka_id;
                        var opis_utrke = data[i].opis_utrke;
                        var naziv_utrke = data[i].naziv_utrke;
                        var datum_zavrsetka_prijava = data[i].datum_zavrsetka_prijava;
                        
                        var tablica = "<tr>" +
                        "<td align='center'>" + utrka_id + "</td>" +
                        "<td align='center'>" + opis_utrke + "</td>" +
                        "<td align='center'>" + naziv_utrke + "</td>" +
                        "<td align='center'>" + datum_zavrsetka_prijava + "</td>" +
                        "</tr>";
                        $("#noveutrketablica tbody").append(tablica);
                    }
                    }
                }
            });
            $('#noveutrketablica tbody').on('click', 'tr', function () {
                var id=$(this).find('td:first').text();
                document.cookie = "Utrka ID=" + id + " ;path=/";
                window.location.href = '../stranice/kreiranje_prijave.php';
            });
        break;
        case "Trenutne utrke":
            var datum = new Date();
            var dd = String(datum.getDate()).padStart(2, '0');
            var mm = String(datum.getMonth() + 1).padStart(2, '0'); 
            var yyyy = datum.getFullYear();
            datum = yyyy + '-' + mm + '-' + dd;
            
            $.ajax({
                url: "trenutne_utrke_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                    console.log(data);
                    var number = data.length;
                        for (var i = 0; i < number; i++){
                        if(data[i].zakljucano==0 && data[i].datum_zavrsetka_prijava>datum && data[i].status==0){
                        var utrka_id = data[i].utrka_id;
                        var etapa_id = data[i].etapa_id;
                        var naziv_utrke = data[i].naziv_utrke;
                        var opis_utrke = data[i].opis_utrke;
                        var datum_zavrsetka_prijava = data[i].datum_zavrsetka_prijava;
                        var naziv_etape = data[i].naziv_etape;
                        var opis_etape = data[i].opis_etape;
                        var pocetak_utrke = data[i].pocetak_utrke;
                        
                        var tablica = "<tr>" +
                        "<td align='center'>" + utrka_id + "</td>" +
                        "<td align='center'>" + etapa_id + "</td>" +
                        "<td align='center'>" + naziv_utrke + "</td>" +
                        "<td align='center'>" + opis_utrke + "</td>" +
                        "<td align='center'>" + datum_zavrsetka_prijava + "</td>" +
                        "<td align='center'>" + naziv_etape + "</td>" +
                        "<td align='center'>" + opis_etape + "</td>" +
                        "<td align='center'>" + pocetak_utrke + "</td>" +
                        "</tr>";
                        $("#trenutneutrketablica tbody").append(tablica);
                    }
                    }
                }
            });
            $('#trenutneutrketablica tbody').on('click', 'tr', function () {
                var id=$(this).find('td').eq(1).text();
                document.cookie = "Etapa_ID=" + id + " ;path=/";
                window.location.href = '../stranice/brisanje_etape.php';
            });
        break;
        case "Zavrsene utrke":
            var datum = new Date();
            var dd = String(datum.getDate()).padStart(2, '0');
            var mm = String(datum.getMonth() + 1).padStart(2, '0'); 
            var yyyy = datum.getFullYear();
            datum = yyyy + '-' + mm + '-' + dd;
            
            $.ajax({
                url: "zavrsene_utrke_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                        console.log(data);
                        var number = data.length;
                        for (var i = 0; i < number; i++){
                        if(data[i].pocetak_utrke<datum){
                        var etapa_id = data[i].etapa_id;
                        var naziv_etape = data[i].naziv_etape;
                        var opis_etape = data[i].opis_etape;
                        var vrijeme = data[i].vrijeme;
                        var mjesto = data[i].mjesto;
                        var bodovi = data[i].bodovi;
                        var naziv_drzave = data[i].naziv_drzave;
                        
                        var tablica = "<tr>" +
                        "<td align='center'>" + etapa_id + "</td>" +
                        "<td align='center'>" + naziv_etape + "</td>" +
                        "<td align='center'>" + opis_etape + "</td>" +
                        "<td align='center'>" + vrijeme + "</td>" +
                        "<td align='center'>" + mjesto + "</td>" +
                        "<td align='center'>" + bodovi + "</td>" +
                        "<td align='center'>" + naziv_drzave + "</td>" +
                        "</tr>";
                        $("#zavrseneutrketablica tbody").append(tablica);
                        $("#drzave_korisnika_list").append('<option value="' + naziv_drzave + '">' + naziv_drzave + '</option>');
                    }
                    }
                }
            });
            $('#trazi').click(function (event) {
                event.preventDefault();
                var drzava=$("#drzave").val();
                $("#zavrseneutrketablica tbody").empty();
                $.ajax({
                url: "zavrsene_utrke_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                        var number = data.length;
                        for (var i = 0; i < number; i++){
                        if(drzava===data[i].naziv_drzave){
                        if(data[i].pocetak_utrke<datum){
                        var etapa_id = data[i].etapa_id;
                        var naziv_etape = data[i].naziv_etape;
                        var opis_etape = data[i].opis_etape;
                        var vrijeme = data[i].vrijeme;
                        var mjesto = data[i].mjesto;
                        var bodovi = data[i].bodovi;
                        var naziv_drzave = data[i].naziv_drzave;
                        
                        var tablica = "<tr>" +
                        "<td align='center'>" + etapa_id + "</td>" +
                        "<td align='center'>" + naziv_etape + "</td>" +
                        "<td align='center'>" + opis_etape + "</td>" +
                        "<td align='center'>" + vrijeme + "</td>" +
                        "<td align='center'>" + mjesto + "</td>" +
                        "<td align='center'>" + bodovi + "</td>" +
                        "<td align='center'>" + naziv_drzave + "</td>" +
                        "</tr>";
                        $("#zavrseneutrketablica tbody").append(tablica);
                    }
                    
                    }
                }
            }
            });
        });

        break;
        case "Statistika etapa":
            var datum = new Date();
            var dd = String(datum.getDate()).padStart(2, '0');
            var mm = String(datum.getMonth() + 1).padStart(2, '0'); 
            var yyyy = datum.getFullYear();
            datum = yyyy + '-' + mm + '-' + dd;
            
            $.ajax({
                url: "statistika_etapa_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                        console.log(data);
                        var number = data.length;
                        for (var i = 0; i < number; i++){
                            var kontinent = data[i].kontinent;
                            var naziv_drzave = data[i].naziv_drzave;
                            var broj_zavrsenih_etapa = data[i].broj_zavrsenih_etapa;
                            var ostvareni_bodovi = data[i].ostvareni_bodovi;
                           
                            var tablica = "<tr>" +
                            "<td align='center'>" + kontinent + "</td>" +
                            "<td align='center'>" + naziv_drzave + "</td>" +
                            "<td align='center'>" + broj_zavrsenih_etapa + "</td>" +
                            "<td align='center'>" + ostvareni_bodovi + "</td>" +
                            "</tr>";
                            $("#statistikaetapatablica tbody").append(tablica);
                            $("#drzave_korisnika_list").append('<option value="' + naziv_drzave + '">' + naziv_drzave + '</option>');
                    }
                }
            });
            $.ajax({
                url: "statistika_etapa_graf.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                        console.log(data);
                        var drzava=[];
                        var broj=[];
                        
                        for(var i in data){ 
                            drzava.push(data[i].naziv_drzave);
                            broj.push(data[i].broj_zavrsenih_etapa);
                    }
                        var chart={
                            labels: drzava,
                            datasets:[{
                                label: 'Broj završenih etapa',
                                backgroundColor: '#84C550',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: broj
                            }
                            ]
                        };
                        var graf=$("#graf");
                        var prikaz=new Chart(graf,{
                            type: 'bar',
                            data: chart
                        });
            }
        });
            $('#sortiraj').click(function (event) {
                event.preventDefault();
                $("#statistikaetapatablica tbody").empty();
                if ($('#kontinent').is(':checked')) {
                    $.ajax({
                        url: "statistika_etapa_sort_kontinent.php",
                        dataType: 'JSON',
                        type: 'GET',
                        success: function (data) {
                            console.log(data);
                            var number = data.length;
                            for (var i = 0; i < number; i++) {
                                if (data[i].pocetak_utrke < datum) {
                                    var kontinent = data[i].kontinent;
                                    var naziv_drzave = data[i].naziv_drzave;
                                    var broj_zavrsenih_etapa = data[i].broj_zavrsenih_etapa;
                                    var ostvareni_bodovi = data[i].ostvareni_bodovi;

                                    var tablica = "<tr>" +
                                            "<td align='center'>" + kontinent + "</td>" +
                                            "<td align='center'>" + naziv_drzave + "</td>" +
                                            "<td align='center'>" + broj_zavrsenih_etapa + "</td>" +
                                            "<td align='center'>" + ostvareni_bodovi + "</td>" +
                                            "</tr>";
                                    $("#statistikaetapatablica tbody").append(tablica);
                                    $("#drzave_korisnika_list").append('<option value="' + naziv_drzave + '">' + naziv_drzave + '</option>');
                                }
                            }
                        }
                    });
                } else if ($('#bodovi').is(':checked')) {
                        $.ajax({
                        url: "statistika_etapa_sort_bodovi.php",
                        dataType: 'JSON',
                        type: 'GET',
                        success: function (data) {
                            console.log(data);
                            var number = data.length;
                            for (var i = 0; i < number; i++) {
                                if (data[i].pocetak_utrke < datum) {
                                    var kontinent = data[i].kontinent;
                                    var naziv_drzave = data[i].naziv_drzave;
                                    var broj_zavrsenih_etapa = data[i].broj_zavrsenih_etapa;
                                    var ostvareni_bodovi = data[i].ostvareni_bodovi;

                                    var tablica = "<tr>" +
                                            "<td align='center'>" + kontinent + "</td>" +
                                            "<td align='center'>" + naziv_drzave + "</td>" +
                                            "<td align='center'>" + broj_zavrsenih_etapa + "</td>" +
                                            "<td align='center'>" + ostvareni_bodovi + "</td>" +
                                            "</tr>";
                                    $("#statistikaetapatablica tbody").append(tablica);
                                    $("#drzave_korisnika_list").append('<option value="' + naziv_drzave + '">' + naziv_drzave + '</option>');
                                }
                            }
                        }
                    });
                } else {
                    alert('Nije validan input!');
                }

                $('input[type=radio]').each(function ()
                {
                    this.checked = false;
                });
            });

            break;
        case "Popis utrka etapa":
            $.ajax({
                url: "popis_utrka_moderator_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                    console.log(data);
                    var number = data.length;
                    for (var i = 0; i < number; i++) {
                        var utrka_id = data[i].utrka_id;
                        var opis_utrke = data[i].opis_utrke;
                        var datum_zavrsetka_prijava = data[i].datum_zavrsetka_prijava;
                        var naziv_drzave = data[i].naziv_drzave;

                        var tablica = "<tr>" +
                                "<td align='center'>" + utrka_id + "</td>" +
                                "<td align='center'>" + opis_utrke + "</td>" +
                                "<td align='center'>" + datum_zavrsetka_prijava + "</td>" +
                                "<td align='center'>" + naziv_drzave + "</td>" +
                                "</tr>";
                        $("#utrkeetapetablica tbody").append(tablica);
                    }
                }
            });
            $('#utrkeetapetablica tbody').on('click', 'tr', function () {
                var id = $(this).find('td').eq(0).text();
                document.cookie = "Utrka ID=" + id + " ;path=/";
                window.location.href = '../stranice/popis_etapa.php';
            });
            break;
        case "Popis etapa":
            $.ajax({
                url: "popis_etapa_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                    console.log(data);
                    var number = data.length;
                    for (var i = 0; i < number; i++) {
                        var etapa_id = data[i].etapa_id;
                        var naziv_etape = data[i].naziv_etape;
                        var opis_etape = data[i].opis_etape;
                        var pocetak_etape = data[i].pocetak_etape;
                        var zakljucano = data[i].zakljucano;

                        var tablica = "<tr>" +
                                "<td align='center'>" + etapa_id + "</td>" +
                                "<td align='center'>" + naziv_etape + "</td>" +
                                "<td align='center'>" + opis_etape + "</td>" +
                                "<td align='center'>" + pocetak_etape + "</td>" +
                                "<td align='center'>" + zakljucano + "</td>" +
                                "</tr>";
                        $("#etapetablica tbody").append(tablica);
                    }
                }
            });
            $('#etapetablica tbody').on('click', 'tr', function () {
                var id=$(this).find('td').eq(0).text();
                document.cookie = "Etapa=" + id + " ;path=/";
                window.location.href = '../stranice/azuriranje_etapa.php';
            });
        break;
        case "Bodovno stanje korisnika":
        $.ajax({
                url: "bodovno_stanje_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                        console.log(data);
                        var number = data.length;
                        for (var i = 0; i < number; i++){
                        var etapa_id = data[i].etapa_id;
                        var ime = data[i].ime;
                        var prezime = data[i].prezime;
                        var uspjesno_zavrseno = data[i].uspjesno_zavrseno;
                        var vrijeme = data[i].vrijeme;
                        var mjesto = data[i].mjesto;
                        var bodovi = data[i].bodovi;
                        
                        var tablica = "<tr>" +
                        "<td align='center'>" + etapa_id + "</td>" +
                        "<td align='center'>" + ime + "</td>" +
                        "<td align='center'>" + prezime + "</td>" +
                        "<td align='center'>" + uspjesno_zavrseno + "</td>" +
                        "<td align='center'>" + vrijeme + "</td>" +
                        "<td align='center'>" + mjesto + "</td>" +
                        "<td align='center'>" + bodovi + "</td>" +
                        "</tr>";
                        $("#bodovnostanjetablica tbody").append(tablica);
                    }
            }
        });
        $('#bodovnostanjetablica tbody').on('click', 'tr', function () {
                var id=$(this).find('td').eq(0).text();
                document.cookie = "Pobjednik=" + id + " ;path=/";
                var ime=$(this).find('td').eq(1).text();
                document.cookie = "Ime=" + ime + " ;path=/";
                var prezime=$(this).find('td').eq(2).text();
                document.cookie = "Prezime=" + prezime + " ;path=/";
                window.location.href = '../stranice/objavi_pobjednika.php';
        });
        break;
        case "Popis svih etapa":
        $.ajax({
                url: "popis_svih_etapa_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                        console.log(data);
                        var number = data.length;
                        for (var i = 0; i < number; i++){
                        var korisnik_id = data[i].korisnik_id;
                        var etapa_id = data[i].etapa_id;
                        var naziv_etape = data[i].naziv_etape;
                        var uspjesno_zavrseno = data[i].uspjesno_zavrseno;
                        var vrijeme = data[i].vrijeme;
                        
                        var tablica = "<tr>" +
                        "<td align='center'>" + korisnik_id + "</td>" +
                        "<td align='center'>" + etapa_id + "</td>" + 
                        "<td align='center'>" + naziv_etape + "</td>" +
                        "<td align='center'>" + uspjesno_zavrseno + "</td>" +
                        "<td align='center'>" + vrijeme + "</td>" +
                        "</tr>";
                        $("#sveetapetablica tbody").append(tablica);
                    }
            }
        });
        $('#sveetapetablica tbody').on('click', 'tr', function () {
                var id=$(this).find('td').eq(0).text();
                document.cookie = "Korisnik=" + id + " ;path=/";
                var etapa=$(this).find('td').eq(1).text();
                document.cookie = "Etapa=" + etapa + " ;path=/";
                var naziv=$(this).find('td').eq(2).text();
                document.cookie = "Naziv=" + naziv + " ;path=/";
                var uspjeh=$(this).find('td').eq(3).text();
                document.cookie = "Uspjeh=" + uspjeh + " ;path=/";
                window.location.href = '../stranice/evidencija_vremena.php';
        });
        break;
        case "Statistika utrka":
        $.ajax({
                url: "statistika_utrka_graf.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                        console.log(data);
                        var etapa=[];
                        var uspjeh=[];
                        
                        for(var i in data){ 
                            etapa.push(data[i].etapa_id);
                            uspjeh.push(data[i].uspjesno_zavrseno);
                    }
                        var chart={
                            labels: etapa,
                            datasets:[{
                                label: 'Broj uspješnih korisnika',
                                backgroundColor: '#84C550',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: uspjeh
                            }
                            ]
                        };
                        var graf=$("#graf");
                        var prikaz=new Chart(graf,{
                            type: 'bar',
                            data: chart
                        });
            }
        });
        $.ajax({
                url: "statistika_utrka_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                        console.log(data);
                        var number = data.length;
                        for (var i = 0; i < number; i++){
                        if(data[i].korisnik_id!=null){
                        var korisnik_id = data[i].korisnik_id;
                        var etapa_id = data[i].etapa_id;
                        var naziv_etape = data[i].naziv_etape;
                        var uspjesno_zavrseno = data[i].uspjesno_zavrseno;
                        var vrijeme = data[i].vrijeme;
                        
                        var tablica = "<tr>" +
                        "<td align='center'>" + korisnik_id + "</td>" +
                        "<td align='center'>" + etapa_id + "</td>" + 
                        "<td align='center'>" + naziv_etape + "</td>" +
                        "<td align='center'>" + uspjesno_zavrseno + "</td>" +
                        "<td align='center'>" + vrijeme + "</td>" +
                        "</tr>";
                        $("#statistikautrkatablica tbody").append(tablica);
                    }
                    }
            }
        });
        $('#sortiraj').click(function (event) {
                event.preventDefault();
                $("#statistikautrkatablica tbody").empty();
                if ($('#naziv_etape').is(':checked')) {
                    $.ajax({
                        url: "statistika_utrka_sort_naziv.php",
                        dataType: 'JSON',
                        type: 'GET',
                        success: function (data) {
                        console.log(data);
                        var number = data.length;
                        for (var i = 0; i < number; i++){
                            if(data[i].korisnik_id!=null){
                                var korisnik_id = data[i].korisnik_id;
                                var etapa_id = data[i].etapa_id;
                                var naziv_etape = data[i].naziv_etape;
                                var uspjesno_zavrseno = data[i].uspjesno_zavrseno;
                                var vrijeme = data[i].vrijeme;
                        
                                var tablica = "<tr>" +
                                "<td align='center'>" + korisnik_id + "</td>" +
                                "<td align='center'>" + etapa_id + "</td>" + 
                                "<td align='center'>" + naziv_etape + "</td>" +
                                "<td align='center'>" + uspjesno_zavrseno + "</td>" +
                                "<td align='center'>" + vrijeme + "</td>" +
                                "</tr>";
                                $("#statistikautrkatablica tbody").append(tablica);
                            }
                        }
                    }
                    });
                }
                else if ($('#uspjesno_zavrseno').is(':checked')) {
                    $.ajax({
                        url: "statistika_utrka_sort_uspjeh.php",
                        dataType: 'JSON',
                        type: 'GET',
                        success: function (data) {
                            var number = data.length;
                            for (var i = 0; i < number; i++) {
                                if (data[i].korisnik_id != null) {
                                    var korisnik_id = data[i].korisnik_id;
                                    var etapa_id = data[i].etapa_id;
                                    var naziv_etape = data[i].naziv_etape;
                                    var uspjesno_zavrseno = data[i].uspjesno_zavrseno;
                                    var vrijeme = data[i].vrijeme;

                                    var tablica = "<tr>" +
                                            "<td align='center'>" + korisnik_id + "</td>" +
                                            "<td align='center'>" + etapa_id + "</td>" +
                                            "<td align='center'>" + naziv_etape + "</td>" +
                                            "<td align='center'>" + uspjesno_zavrseno + "</td>" +
                                            "<td align='center'>" + vrijeme + "</td>" +
                                            "</tr>";
                                    $("#statistikautrkatablica tbody").append(tablica);
                                }
                            }
                        }
                    });
                } else {
                    alert('Nije validan input!');
                }

                $('input[type=radio]').each(function ()
                {
                    this.checked = false;
                });
            });
            break;
            case "Dodjeli moderatora":
                $.ajax({
                url: "dodjeli_moderatora_prikaz_korisnika.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                    var number = data.length;
                        for (var i = 0; i < number; i++){
                        var korisnicko_ime = data[i].korisnicko_ime;
                        
                        $("#korisnici_list").append('<option value="' + korisnicko_ime + '">' + korisnicko_ime + '</option>');
                    }
                }
            })
            break;
            case "Popis svih utrka":
                 $.ajax({
                url: "popis_svih_utrka_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                    console.log(data);
                    var number = data.length;
                    for (var i = 0; i < number; i++) {
                        var utrka_id = data[i].utrka_id;
                        var naziv_utrke = data[i].naziv_utrke;
                        var opis_utrke = data[i].opis_utrke;
                        var datum_zavrsetka_prijava = data[i].datum_zavrsetka_prijava;
   
                        var tablica = "<tr>" +
                                "<td align='center'>" + utrka_id + "</td>" +
                                "<td align='center'>" + naziv_utrke + "</td>" +
                                "<td align='center'>" + opis_utrke + "</td>" +
                                "<td align='center'>" + datum_zavrsetka_prijava + "</td>" +
                                "</tr>";
                        $("#utrketablica tbody").append(tablica);
                    }
                }
            });
            $('#utrketablica tbody').on('click', 'tr', function () {
                var id=$(this).find('td:first').text();
                document.cookie = "Utrka=" + id + " ;path=/";
                window.location.href = '../stranice/azuriranje_utrka.php';
        });
            break;
            case "Kreiranje utrka":
            $.ajax({
                url: "galerija_popis_drzava.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                    var number = data.length;
                    for (var i = 0; i < number; i++){
                    var naziv_drzave = data[i].naziv_drzave;
                    $("#drzava_list").append('<option value="' + naziv_drzave + '">' + naziv_drzave + '</option>');
                    }
                }
            });
            $.ajax({
                url: "tip_utrka_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                    var number = data.length;
                    for (var i = 0; i < number; i++){
                    var naziv_utrke = data[i].naziv_utrke;
                    $("#tip_utrke_list").append('<option value="' + naziv_utrke + '">' + naziv_utrke + '</option>');
                    }
                }
            });
            break;
            case "Dnevnik rada":
            $.ajax({
                url: "dnevnik_rada_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                    console.log(data);
                    var number = data.length;
                    for (var i = 0; i < number; i++) {
                        var datum_vrijeme = data[i].datum_vrijeme;
                        var upit = data[i].upit;
                        var opis_radnje = data[i].opis_radnje;
                        var korisnicko_ime = data[i].korisnicko_ime;
   
                        var tablica = "<tr>" +
                                "<td align='center'>" + datum_vrijeme + "</td>" +
                                "<td align='center'>" + upit + "</td>" +
                                "<td align='center'>" + opis_radnje + "</td>" +
                                "<td align='center'>" + korisnicko_ime + "</td>" +
                                "</tr>";
                        $("#dnevniktablica tbody").append(tablica);
                        
                    }
                }
            });
            $.ajax({
                url: "dnevnik_rada_korisnici.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                    var number = data.length;
                    for (var i = 0; i < number; i++){
                    var korisnicko_ime = data[i].korisnicko_ime;
                    $("#korime_list").append('<option value="' + korisnicko_ime + '">' + korisnicko_ime + '</option>');;
                    }
                }
            });
            $('#pretrazi').click(function (event) {
                var korisnik=$("#korisnik").val();
                event.preventDefault();
                $("#dnevniktablica tbody").empty();
                $.ajax({
                url: "dnevnik_rada_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                        var number = data.length;
                        for (var i = 0; i < number; i++){
                        if(korisnik===data[i].korisnicko_ime){
                        var datum_vrijeme = data[i].datum_vrijeme;
                        var upit = data[i].upit;
                        var opis_radnje = data[i].opis_radnje;
                        var korisnicko_ime = data[i].korisnicko_ime;
   
                        var tablica = "<tr>" +
                                "<td align='center'>" + datum_vrijeme + "</td>" +
                                "<td align='center'>" + upit + "</td>" +
                                "<td align='center'>" + opis_radnje + "</td>" +
                                "<td align='center'>" + korisnicko_ime + "</td>" +
                                "</tr>";
                        $("#dnevniktablica tbody").append(tablica);
                    }
                    
                    }
                }
            });
        });
        break;
        case "Popis prijava":
                $.ajax({
                url: "popis_prijava_prikaz.php",
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {
                        var number = data.length;
                        for (var i = 0; i < number; i++){
                        var prijava_id = data[i].prijava_id;
                        var godina_rodenja = data[i].godina_rodenja;
                        var slika_putanja = data[i].slika_putanja;
                        var utrka_id = data[i].utrka_id;
   
                        var tablica = "<tr>" +
                                "<td align='center'>" + prijava_id + "</td>" +
                                "<td align='center'>" + godina_rodenja + "</td>" +
                                "<td align='center'>" + slika_putanja + "</td>" +
                                "<td align='center'>" + utrka_id + "</td>" +
                                "</tr>";
                        $("#prijavetablica tbody").append(tablica);
                    }
                }
            });
        break;
    }

});


