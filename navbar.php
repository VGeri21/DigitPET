<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'kapcsolat.php'; // Ez kell az admin ellenőrzéshez

$current_page = basename($_SERVER['PHP_SELF']);

// Admin ellenőrzés csak bejelentkezett felhasználóknál
$is_admin = false;
if (isset($_SESSION['felhasznalo'])) {
    $felhasznalonev = $_SESSION['felhasznalo'];
    $admin_check = $kapcsolat->prepare("SELECT is_admin FROM felhasznalok WHERE felhasznalonev = ?");
    $admin_check->bind_param("s", $felhasznalonev);
    $admin_check->execute();
    $user = $admin_check->get_result()->fetch_assoc();
    $is_admin = $user && $user['is_admin'] == 1;
}
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
            <li><a href="termekek.php" class="<?= ($current_page == 'termekek.php') ? 'active' : '' ?>">Termékek</a></li>
            <li><a href="tervez.php" class="<?= ($current_page == 'tervez.php') ? 'active' : '' ?>">Egyedi bilétát tervezek</a></li>
            <li><a href="kosar.php">Kosár</a></li>
            
            <?php if ($is_admin): ?>
            <li><a href="admin.php" class="admin-link <?= ($current_page == 'admin.php') ? 'active' : '' ?>" style="color: #ff4444; font-weight: bold; background: #ffeeee; padding: 5px 10px; border-radius: 4px;">🔧 ADMIN</a></li>
            <?php endif; ?>
            
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
