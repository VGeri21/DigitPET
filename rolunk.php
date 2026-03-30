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
    <link rel="stylesheet" href="rolunk.css">
    <style>
        .gallery{
            padding: 30px;
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

<!-- GALÉRIA -->
<h2 align="center">Referenciák</h2>
<div class="gallery">
    <div class="gallery-grid">

        <div class="gallery-item">
            <img src="mancs.png" class="gallery-image">
            <div class="gallery-overlay">
                <span class="gallery-title">Egyedi biléta</span>
            </div>
        </div>

        <div class="gallery-item">
            <img src="Naomi.png" class="gallery-image">
            <div class="gallery-overlay">
                <span class="gallery-title">Egyedi biléta</span>
            </div>
        </div>

        <div class="gallery-item">
            <img src="egyedi.png" class="gallery-image">
            <div class="gallery-overlay">
                <span class="gallery-title">Egyedi biléta</span>
            </div>
        </div>

        <div class="gallery-item">
            <img src="merkur.png" class="gallery-image">
            <div class="gallery-overlay">
                <span class="gallery-title">Egyedi biléta</span>
            </div>
        </div>

        <div class="gallery-item">
            <img src="basic2.png" class="gallery-image">
            <div class="gallery-overlay">
                <span class="gallery-title">Basic biléta</span>
            </div>
        </div>

        <div class="gallery-item">
            <img src="basic1.png" class="gallery-image">
            <div class="gallery-overlay">
                <span class="gallery-title">Basic biléta</span>
            </div>
        </div>

    </div>
</div>

<!-- MODAL -->
<div id="imageModal" class="modal">
    <span class="modal-close">&times;</span>

    <!-- NYILAK -->
    <button class="modal-prev">&#10094;</button>
    <button class="modal-next">&#10095;</button>

    <div style="text-align:center;">
        <img class="modal-image" id="modalImage" src="">
        <div class="modal-caption" id="modalCaption"></div>
    </div>
</div>

<!-- SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const galleryItems = document.querySelectorAll('.gallery-item');
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalCaption = document.getElementById('modalCaption');
    const closeBtn = document.querySelector('.modal-close');
    const prevBtn = document.querySelector('.modal-prev');
    const nextBtn = document.querySelector('.modal-next');

    let currentIndex = 0;

    function showImage(index) {
        const item = galleryItems[index];
        const img = item.querySelector('.gallery-image');
        const title = item.querySelector('.gallery-title').textContent;

        modalImage.src = img.src;
        modalCaption.textContent = title;
    }

    galleryItems.forEach((item, index) => {
        item.addEventListener('click', function() {
            currentIndex = index;
            showImage(currentIndex);
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });

    function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    function nextImage() {
        currentIndex = (currentIndex + 1) % galleryItems.length;
        showImage(currentIndex);
    }

    function prevImage() {
        currentIndex = (currentIndex - 1 + galleryItems.length) % galleryItems.length;
        showImage(currentIndex);
    }

    nextBtn.addEventListener('click', nextImage);
    prevBtn.addEventListener('click', prevImage);
    closeBtn.addEventListener('click', closeModal);

    modal.addEventListener('click', function(e) {
        if (e.target === modal) closeModal();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
        if (e.key === 'ArrowRight') nextImage();
        if (e.key === 'ArrowLeft') prevImage();
    });
});
</script>
</body>
</html>
