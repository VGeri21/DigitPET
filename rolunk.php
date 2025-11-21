<?php
// rolunk.php
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rólunk | NFC Chip Projekt</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7fff7;
            color: #222;
        }

        .content {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px 30px;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h1, h2 {
            color: #228b22;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        h2 {
            border-left: 6px solid #32cd32;
            padding-left: 10px;
            margin-top: 25px;
        }

        p {
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .highlight {
            color: #32cd32;
            font-weight: bold;
        }

        .team {
            background: #f0fff0;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #00ff00;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #555;
            font-size: 0.9rem;
        }

        a {
            color: #228b22;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="content">
        <h1>Rólunk</h1>

        <h2>A projekt célja</h2>
        <p>
            A <span class="highlight">DigitPET</span> projektünk célja, hogy biztonságosabbá és modernebbé tegyük a házi kedvencek azonosítását.
            Egy <strong>NFC-chippel ellátott, 3D nyomtatott bilétát</strong> fejlesztettünk, amely a kutya nyakörvére rögzíthető.
            A bilétába írt adatok – mint a kutyus neve, gazdája elérhetősége, lakcím, vagy akár orvosi információk – 
            egyetlen telefonérintéssel megjeleníthetők.  
        </p>
        <p>
            Célunk, hogy hosszú távon az NFC-technológia olyan szintre fejlődjön, 
            hogy akár <strong>valós idejű követésre</strong> is alkalmas legyen, így ne legyen szükség
            az állatok bőre alá ültetett chipekre. Emellett szeretnénk segíteni a gazdiknak
            a mindennapokban, hiszen ma már szinte mindenkinek van okostelefonja, 
            így bárki, aki megtalál egy elkóborolt állatot, azonnal kapcsolatba tud lépni a gazdájával.
        </p>

        <h2>Előzményeink</h2>
        <p>
            Hárman vagyunk a csapatban, mindannyian <strong>szoftverfejlesztő szakos diákok</strong>.
            Az ötletünk a tanulmányaink során született: az iskolában megismerkedtünk a 
            <strong>3D nyomtatás</strong> világával, ami annyira magával ragadott minket, 
            hogy mindhárman otthon is elkezdtünk kísérletezni vele. 
        </p>
        <p>
            Később, amikor az <strong>NFC-technológia</strong> egyre elterjedtebbé vált, 
            összekapcsoltuk a két érdeklődési körünket – így jött létre a SmartPetTag ötlete:
            „Ha már kulcstartókba tehetünk NFC-chipet, miért ne tehetnénk a kedvenceink bilétáiba is?”
        </p>

        <h2>Az NFC technológiáról röviden</h2>
        <p>
            Az <strong>NFC (Near Field Communication)</strong> egy vezeték nélküli adatátviteli technológia,
            amely nagyon kis hatótávolságon – néhány centiméteren belül – működik. 
            Alapja a rádiófrekvenciás azonosítás (RFID), de annál fejlettebb és biztonságosabb.
        </p>
        <p>
            Az NFC segítségével két eszköz – például egy okostelefon és egy chip – képes egymással kommunikálni
            érintés vagy közeli érintkezés útján. Nincs szükség internetkapcsolatra, 
            a kommunikáció gyors, biztonságos és energiatakarékos. 
        </p>
        <p>
            A mindennapokban az NFC-t leggyakrabban <strong>bankkártyás érintéses fizetésnél, 
            beléptető rendszereknél vagy digitális névjegykártyáknál</strong> használják. 
            Mi ezt a technológiát hasznosítjuk új módon: a bilétába épített chip lehetővé teszi,
            hogy egyetlen telefonérintéssel elérhetők legyenek a kutyus legfontosabb adatai,
            így a megtaláló azonnal kapcsolatba léphet a gazdival.
        </p>

        <h2>A 3D nyomtatásról röviden</h2>
        <p>
            A <strong>3D nyomtatás</strong> egy additív gyártástechnológia, amely rétegről rétegre épít fel egy tárgyat.
            A folyamat során egy digitális modell alapján egy <em>nyomtatófej</em> olvasztott műanyagszálat (leggyakrabban PLA vagy PETG anyagot)
            extrudál, és így hozza létre a kívánt formát.
        </p>
        <p>
            Ennek a technológiának az egyik legnagyobb előnye, hogy <strong>egyedi, személyre szabott tárgyak</strong> gyárthatók vele,
            akár kis mennyiségben is. Ez teszi lehetővé, hogy minden biléta külön mintát, színt vagy formát kapjon – 
            így nem csak hasznos, hanem esztétikus kiegészítő is a házi kedvencek számára.
        </p>

        <h2>A csapatról</h2>
        <div class="team">
            <p>
                Mi hárman egy lelkes, diákokból álló csapat vagyunk, akik a technológia és az állatvédelem iránti szeretetüket
                szerették volna ötvözni egy innovatív és valóban hasznos megoldásban.
            </p>
            <p>
                Célunk, hogy a projektünkkel <strong>valós segítséget nyújtsunk</strong> a gazdiknak és kedvenceiknek,
                valamint hogy megmutassuk, a modern technológia – mint az NFC és a 3D nyomtatás – 
                milyen hatékonyan szolgálhatja a mindennapi életet.
            </p>
        </div>

    </div>

    <footer>
        <p>© 2025 DigitPet | Okos nyakörvek NFC technológiával</p>
    </footer>
</body>
</html>