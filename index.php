<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
</body>
</html>

<?php
session_start();
?>

<h1>Üdvözöllek az oldalon 
<?php if(isset($_SESSION['felhasznalo'])): ?>
<?= $_SESSION['felhasznalo'] ?>
<?php endif; ?>
!
</h1>

<?php if(isset($_SESSION['felhasznalo'])): ?>
    <a href="lista.php" class="gomb">Felhasználók listája</a><br>
    <a href="kijelentkez.php" class="gomb">Kijelentkezés</a>
<?php else: ?>
    <a href="regisztracio.php" class="gomb">Regisztráció</a>
    <a href="bejelentkez.php" class="gomb">Bejelentkezés</a>
<?php endif; ?>