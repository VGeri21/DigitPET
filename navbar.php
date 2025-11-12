<?php
session_start();
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar" id="navbar">
        <div class="logo">DigitPET</div>
        <span class="menu-toggle" id="menu-toggle">&#9776;</span>
        <!-- <div class="welcome-box">
        <?php
            echo "Üdvözöllek, <span>" . htmlspecialchars($_SESSION['username']) . "</span>!";
        ?>
        </div> -->
        <ul>
            <li><a href="index.php">Főoldal</a></li>
            <li><a href="rolunk.php">Rólunk</a></li>

            <?php if (isset($_SESSION['felhasznalo'])): ?>
                <li><a href="profil.php">Profil</a></li>
                <!-- <li><a href="lista.php">Felhasználók listája</a></li> -->
                 <li><a href="allat.php">Saját állatom adatai</a></li>
                 <li><a href="allat.php">Egyedi bilétát tervezek</a></li>
                <li><a href="kijelentkez.php" class="auth-btn logout">Kijelentkezés</a></li>
            <?php else: ?>
                <li><a href="bejelentkez.php" class="auth-btn login">Bejelentkezés</a></li>
                <li><a href="regisztracio.php" class="auth-btn register">Regisztráció</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <script>
        const toggle = document.getElementById('menu-toggle');
        const navbar = document.getElementById('navbar');
        toggle.addEventListener('click', () => navbar.classList.toggle('active'));
    </script>
</body>
</html>
