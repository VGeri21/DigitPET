<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Felhasználók listája</title>
</head>
<body>
<?php
session_start();
include 'kapcsolat.php';

// Ha nincs bejelentkezve, visszadob a login oldalra
if(!isset($_SESSION['felhasznalo'])){
    header("Location: bejelentkez.php");
    exit;
}

// Felhasználók lekérdezése
$lekerdezes = $kapcsolat->query("SELECT id, felhasznalonev FROM felhasznalok");
?>

<h2>Regisztrált felhasználók</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Felhasználónév</th>
    </tr>
    <?php while($sor = $lekerdezes->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($sor['id']) ?></td>
        <td><?= htmlspecialchars($sor['felhasznalonev']) ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<br>
<a href="index.php" class="gomb">Vissza a főoldalra</a>
</body>
</html>
