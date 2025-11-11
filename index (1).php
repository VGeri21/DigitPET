<!DOCTYPE html>
<html lang="hu">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitPet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


    <div class="hero">
        <div class="overlay"></div>
        <div class="content">


            <h1>Biztonság a kedvencnek, nyugalom a gazdinak 🐾</h1>
            <p>Okos NFC biléta, ami egyetlen érintéssel megmutatja, kié a kutyus.<br>
            Modern, stílusos, és életmentő lehet!</p>

            <div class="buttons">

                <a href="shop.php" class="btn">Vásárolj most</a>
                <a href="termekek.php" class="btn secondary">Nézd meg a termékeinket</a>
                <a href="info.php" class="btn outline">Tudj meg többet</a>

            </div>
        </div>
    </div>


    <?php
    session_start();
    ?>

    <div class="user-section">
        <h2>
            Üdvözöllek az oldalon 
            <?php if(isset($_SESSION['felhasznalo'])): ?>
                <?= $_SESSION['felhasznalo'] ?>!
            <?php endif; ?>
        </h2>

        <?php if(isset($_SESSION['felhasznalo'])): ?>
            <a href="lista.php" class="gomb">Felhasználók listája</a><br>
            <a href="kijelentkez.php" class="gomb">Kijelentkezés</a>
        <?php else: ?>
            <a href="regisztracio.php" class="gomb">Regisztráció</a>
            <a href="bejelentkez.php" class="gomb">Bejelentkezés</a>
        <?php endif; ?>
    </div>

    
</body>
</html>