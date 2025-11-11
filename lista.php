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
include 'kapcsolat.php';

if(!isset($_SESSION['felhasznalo'])){
    header("Location: bejelentkezes.php");
    exit;
}

$lekerdezes = $kapcsolat->query("SELECT id, username FROM users");
?>

<h2>Regisztrált felhasználók</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Felhasználónév</th>
    </tr>
    <?php while($sor = $lekerdezes->fetch_assoc()): ?>
    <tr>
        <td><?= $sor['id'] ?></td>
        <td><?= $sor['username'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<a href="index.php" class="gomb">Vissza a főoldalra</a>