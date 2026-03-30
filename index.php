<?php session_start(); ?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitPet – Okos nyakörv NFC-vel</title>
    <link rel="stylesheet" href="style.css">


</head>
<body>

    <?php include 'navbar.php'; ?>
    <section class="hero">
        <div class="overlay"></div>
        <div class="hero-content">
            <h1>Biztonság a kedvencnek, nyugalom a gazdinak</h1>
            <p>Okos NFC-s nyakörv, ami egyetlen érintéssel megmutatja, kié a kutyus.  
            Modern, stílusos, és akár életet is menthet!</p>
            <a href="tervez.php" class="btn-hero">Egyedi bilétát tervezek!</a>
        </div>
    </section>



    <section class="about">
        <h2>Mi az a DigitPet?</h2>
        <img src="DP.png" alt="">
        <p>
            A DigitPet egy magyar fejlesztésű innováció, ami NFC technológiával segít biztonságban tudni a kedvencedet.  
            Ha a nyakörvön lévő címkét egy okostelefonnal megérintik, azonnal megjelenik a gazdi elérhetősége.
        </p>
        <a href="rolunk.php" class="btn-secondary">Tudj meg többet!</a>
    </section>

    <section class="how-it-works">
        <h2>Hogyan működik?</h2>
        <div class="steps">
            <div class="step">
                <div class="step-icon">1</div>
                <h3>Érintés</h3>
                <p>Érintsd a telefont a bilétához és tartsd ott 5-10 másodpercig</p>
            </div>
            <div class="step">
                <div class="step-icon">2</div>
                <h3>Azonosítás</h3>
                <p>Megjelenik az állat és a gazdi felvitt adatai</p>
            </div>
            <div class="step">
                <div class="step-icon">3</div>
                <h3>Kapcsolatfelvétel</h3>
                <p>Azonnal elérhetővé válnak a gazdi kapcsolatfelvételéhez szükséges adatok</p>

            </div>
        </div>
    </section>


    <section class="products">
        <h2>Legnépszerűbb termékeink</h2>
        <div class="product-grid">
            <div class="product-card">
                <img src="basic2.png" alt="DigitPet Basic Nyakörv">
                <h3>DigitPet Basic</h3>
                <p>Megbízható NFC chip, klasszikus kivitelben.  
                Ideális választás minden gazdinak.</p>
                <a href="termekek.php" class="btn-card">Részletek</a>
            </div>
            <div class="product-card">
                <img src="egyedi.png" alt="DigitPet Custom Nyakörv">
                <h3>DigitPet Custom</h3>
                <p>Egyedi mintákkal és színekkel, hogy a kedvenc is stílusos legyen!</p>
                <a href="tervez.php" class="btn-card">Részletek</a>
            </div>
        </div>
    </section>

    <section class="benefits">
        <h2>Miért DigitPet?</h2>
        <div class="benefits-grid">
            <div class="benefit-item">
                <div class="benefit-icon">✔</div>
                <p>Nincs szükség alkalmazásra</p>
            </div>
            <div class="benefit-item">
                <div class="benefit-icon">✔</div>
                <p>Azonnali elérhetőség</p>
            </div>
            <div class="benefit-item">
                <div class="benefit-icon">✔</div>
                <p>Modern NFC technológia</p>
            </div>
            <div class="benefit-item">
                <div class="benefit-icon">✔</div>
                <p>Vízálló és strapabíró</p>
            </div>
        </div>
    </section>

    <section class="reviews">
        <h2>Vásárlói vélemények</h2>
        <div class="reviews-container">

            <div class="review-card">
                <p class="review-text">"Egy elveszett kutyát megtaláltunk, gyorsan beolvastuk a bilétát és felvettük a gazdival a kapcsolatot. Nagyszerűen működött!"</p>
                <span class="review-author">Takács Anna</span>
            </div>
            <div class="review-card">
                <p class="review-text">"Először szekptikus voltam, de meggyőzött a gyorsaságról és praktikusságáról, hiszen ma már mindenki kezében van telefon."</p>
                <span class="review-author">Bornemissza Péter</span>
            </div>

            <div class="review-card">
                <p class="review-text">"Végre egy praktikus megoldás! Ajánlom mindenkinek, aki szeretné biztonságban tudni a kedvencét!"</p>
                <span class="review-author">Csillag Gábor</span>
            </div>
            <div class="review-card">
                <p class="review-text">"Gyors, egyszerű! Szerintem minden gazdának kellene egy ilyen egyedi biléta!"</p>
                <span class="review-author">Bátor János</span>
            </div>
            <div class="review-card">
                <p class="review-text">"Nagyon hasznos és megnyugtató megoldás. Így mindig tudom, hogy ha bármi történik, könnyen visszakerülhet hozzám a kutyám."</p>
                <span class="review-author">Hajnal Tamás</span>
            </div>
            
            <div class="review-card">
                <p class="review-text">"Egyszerű használat, mégis rendkívül praktikus. Jó érzés, hogy egy ilyen modern megoldással növelhetem a kedvencem biztonságát."</p>
                <span class="review-author">Tátai András</span>
            </div>


        </div>
    </section>



<section class="faq">
    <h2>GYIK - Gyakran Ismételt Kérdések</h2>

    <div class="faq-items">
        <div class="faq-item">
            <h3>Minden telefon működik vele?</h3>
            <p>Igen, minden NFC-képes okostelefon kompatibilis a DigitPet bilétákkal. Az iOS 13.1 és újabb, valamint az Android 4.4 és újabb verziók támogatják az NFC technológiát. A legtöbb modern készülék már alapból rendelkezik ezzel a funkcióval, így külön alkalmazás telepítése sem szükséges a használathoz.</p>
        </div>
        <div class="faq-item">
            <h3>Mennyi ideig tartható az NFC chip?</h3>
            <p>Az NFC chipek rendkívül tartósak, akár 10+ évig is megbízhatóan működnek. Nem tartalmaznak akkumulátort, így nincs szükség töltésre vagy karbantartásra. A nyakörv anyaga vízálló és UV-álló, ezért ellenáll az időjárási viszontagságoknak is.</p>
        </div>
        <div class="faq-item">
            <h3>Mi történik, ha elveszem a nyakörvet?</h3>
            <p>Az adminisztrációs felületen bármikor deaktiválhatod az adott nyakörvet, így az többé nem lesz használható. Ezt követően lehetőséged van új chipet regisztrálni, amelyhez ugyanazokat az adatokat vagy új információkat is hozzárendelhetsz. Ehhez csak az azonosítóra lesz szükség.</p>
        </div>
        <div class="faq-item">
            <h3>Van feltöltési vagy havi díj?</h3>
            <p>Nem! Az NFC technológia passzív működésű, így nincsenek rejtett költségek, előfizetések vagy havi díjak. A termék egyszeri vásárlással használható, és ezt követően korlátlan ideig működik további költségek nélkül.</p>
        </div>
        <div class="faq-item">
            <h3>Működik az offline módban is?</h3>
            <p>Igen, maga az NFC kommunikáció internetkapcsolat nélkül is működik. Azonban a profiloldal megnyitásához internetkapcsolat szükséges, mivel az adatok egy online felületen jelennek meg. Így a megtaláló azonnal hozzáférhet a fontos információkhoz.</p>
        </div>
        <div class="faq-item">
            <h3>Milyen adatokat lehet eltárolni a bilétán?</h3>
            <p>A bilétához tartozó profiloldalon számos hasznos információ megadható, például a háziállat neve, fajtája, egészségügyi adatai, valamint a gazdi elérhetőségei. Emellett akár fényképet is feltölthetsz, hogy a megtaláló könnyebben azonosíthassa az állatot.</p>
        </div>
        <div class="faq-item">
            <h3>Biztonságosak az adatok?</h3>
            <p>Igen, az adatok biztonságosan kerülnek tárolásra. Csak azok az információk jelennek meg, amelyeket te megadsz a profilban. Az adminisztrációs felületen bármikor módosíthatod vagy törölheted ezeket, így teljes kontroll alatt tarthatod az adatkezelést.</p>
        </div>
        <div class="faq-item">
            <h3>Mi történik, ha a megtaláló nem tudja használni az NFC-t?</h3>
            <p>Ebben az esetben a bilétán található egyedi azonosító vagy QR-kód is segíthet. A megtaláló ezt beírva vagy beolvasva szintén hozzáférhet a szükséges információkhoz, így többféle módon is biztosított a kapcsolatfelvétel.</p>
        </div>

        <div class="faq-item">
            <h3>Mennyire strapabíró a nyakörv?</h3>
            <p>A nyakörv kiváló minőségű, tartós anyagból készül, amely ellenáll a mindennapi használatból adódó igénybevételnek. Vízálló, UV-álló és nem kopik könnyen, így ideális aktív, sokat mozgó háziállatok számára is.</p>
        </div>

        <div class="faq-item">
            <h3>Szükséges alkalmazást telepíteni a használathoz?</h3>
            <p>Nem szükséges külön alkalmazás telepítése. Az NFC érintés után a telefon automatikusan megnyitja a böngészőben a profiloldalt. Ez gyors és egyszerű használatot biztosít bárki számára.</p>
        </div>
    </div>
</section>


    <?php if(isset($_SESSION['user'])): ?>
    <div class="welcome-section">
        <div class="welcome-box">
            Üdv újra, <span><?= $_SESSION['user'] ?></span>!
        </div>
    </div>
    
    <?php 
    endif; 
    ?>

</body>
</html>