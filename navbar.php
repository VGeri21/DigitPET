<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar" id="navbar">
    <div class="logo">DigitPET</div>
    <span class="menu-toggle" id="menu-toggle">&#9776;</span>

    <ul>
        <li><a href="index.php" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">Főoldal</a></li>
        <li><a href="rolunk.php" class="<?= ($current_page == 'rolunk.php') ? 'active' : '' ?>">Rólunk</a></li>

        <?php if (isset($_SESSION['felhasznalo'])): ?>
            <li><a href="profil.php" class="<?= ($current_page == 'profil.php') ? 'active' : '' ?>">Profil</a></li>
            <li><a href="allat.php" class="<?= ($current_page == 'allat.php') ? 'active' : '' ?>">Saját állatom adatai</a></li>
            <li><a href="tervez.php" class="<?= ($current_page == 'tervez.php') ? 'active' : '' ?>">Egyedi bilétát tervezek</a></li>
            <li><a href="kijelentkez.php" class="auth-btn logout <?= ($current_page == 'kijelentkez.php') ? 'active' : '' ?>">Kijelentkezés</a></li>
        <?php else: ?>
            <li><a href="bejelentkez.php" class="auth-btn login <?= ($current_page == 'bejelentkez.php') ? 'active' : '' ?>">Bejelentkezés</a></li>
            <li><a href="regisztracio.php" class="auth-btn register <?= ($current_page == 'regisztracio.php') ? 'active' : '' ?>">Regisztráció</a></li>
        <?php endif; ?>
    </ul>
</nav>

<script>
const toggle = document.getElementById('menu-toggle');
const navbar = document.getElementById('navbar');
toggle.addEventListener('click', () => navbar.classList.toggle('active'));
</script>
