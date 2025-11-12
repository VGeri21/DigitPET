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
            <h1>Biztonság a kedvencnek, nyugalom a gazdinak 🐾</h1>
            <p>Okos NFC-s nyakörv, ami egyetlen érintéssel megmutatja, kié a kutyus.  
            Modern, stílusos, és akár életet is menthet!</p>
            <a href="tervez.php" class="btn-hero">Egyedi nyakörvet tervezek!</a>
        </div>
    </section>
    <section class="about">
        <h2>Mi az a DigitPet?</h2>
        <p>
            A DigitPet egy magyar fejlesztésű innováció, ami NFC technológiával segít biztonságban tudni a kedvencedet.  
            Ha a nyakörvön lévő címkét egy okostelefonnal megérintik, azonnal megjelenik a gazdi elérhetősége.
        </p>
        <a href="rolunk.php" class="btn-secondary">Tudj meg többet!</a>
    </section>
    <section class="products">
        <h2>Legnépszerűbb termékeink</h2>
        <div class="product-grid">
            <div class="product-card">
                <img src="https://place-puppy.com/300x200" alt="DigitPet Basic Nyakörv">
                <h3>DigitPet Basic</h3>
                <p>Megbízható NFC chip, klasszikus kivitelben.  
                Ideális választás minden gazdinak.</p>
                <a href="#" class="btn-card">Részletek</a>
            </div>
            <div class="product-card">
                <img src="https://place-puppy.com/301x200" alt="DigitPet Premium Nyakörv">
                <h3>DigitPet Premium</h3>
                <p>Vízálló, strapabíró és modern – prémium megoldás a biztonságért.</p>
                <a href="#" class="btn-card">Részletek</a>
            </div>
            <div class="product-card">
                <img src="https://place-puppy.com/302x200" alt="DigitPet Custom Nyakörv">
                <h3>DigitPet Custom</h3>
                <p>Egyedi mintákkal és színekkel, hogy a kedvenc is stílusos legyen!</p>
                <a href="#" class="btn-card">Részletek</a>
            </div>
        </div>
    </section>
    <footer>
        <p>© 2025 DigitPet | Okos nyakörvek NFC technológiával</p>
    </footer>

</body>
</html>
