<?php
session_start();
include 'kapcsolat.php';

if (!isset($_SESSION['felhasznalo'])) {
    header("Location: bejelentkez.php");
    exit();
}

$felhasznalonev = $_SESSION['felhasznalo'];

$stmt = $kapcsolat->prepare("SELECT id, is_admin FROM felhasznalok WHERE felhasznalonev = ?");
$stmt->bind_param("s", $felhasznalonev);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user || !$user['is_admin']) {
    die("Nincs jogosultságod!");
}

/* LEADOTT RENDELÉSEK */
$rendelesek = $kapcsolat->query("
SELECT 
    r.id,
    r.datum,
    f.id as user_id,
    f.felhasznalonev
FROM rendeles r
JOIN felhasznalok f ON r.felhasznalo_id = f.id
WHERE r.teljesitett = 1
ORDER BY r.datum DESC
")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="admin.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/x-icon" href="DP.png">
<title>Admin - Leadott rendelések</title>
</head>
<body>

<nav>
    <a href="https://mysqladmin.nethely.hu/index.php?route=/database/structure&db=vg_login" target="_blank">Adatbázis megnyitása</a>
    <a href="index.php">Vissza a főoldalra</a>
</nav>

<h1>Leadott rendelések</h1>

<?php foreach($rendelesek as $r): ?>

<?php
$stmt = $kapcsolat->prepare("
SELECT 
    k.*,
    a.kutya_nev,
    a.fajta,
    a.szul_datum,
    a.gazdi_telefonszam,
    a.lakcim,
    a.extra_megjegyzes,
    r.nev,
    r.email,
    r.cim,
    r.telefonszam
FROM kosar k
LEFT JOIN allatok a ON k.allat_id = a.id
LEFT JOIN rendeles r ON k.rendeles_id = r.id
WHERE k.rendeles_id = ?
");
$stmt->bind_param("i", $r['id']);
$stmt->execute();
$tetelek = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<div class="rendeles">
    <h2>📦 Rendelés #<?= $r['id'] ?> - <?= htmlspecialchars($r['felhasznalonev']) ?> (<?= $r['datum'] ?>)</h2>

    <div class="card-container">

    <?php foreach($tetelek as $t): ?>

        <div class="termek-blokk">

            <!-- 1. FIZIKAI -->
            <div class="card">
                <h3>📦 Fizikai</h3>
                <p><b>Típus:</b> <?= $t['termek_tipus'] ?: "Egyedi" ?></p>
                <p><b>Forma:</b> <?= $t['egyedi_forma'] ?: '-' ?></p>
                <p><b>Alapszín:</b> <?= $t['egyedi_alapszin'] ?: '-' ?></p>
                <p><b>Keret:</b> <?= $t['egyedi_keretszin'] ?: '-' ?></p>
                <p><b>Felirat:</b> <?= $t['egyedi_felirat'] ?: '-' ?></p>
            </div>

            <!-- 2. CHIP -->
            <div class="card">
                <h3>💾 Chip adatok</h3>
                <p><b>Név:</b> <?= htmlspecialchars($t['kutya_nev']) ?></p>
                <p><b>Fajta:</b> <?= $t['fajta'] ?: '-' ?></p>
                <p><b>Születés:</b> <?= $t['szul_datum'] ?: '-' ?></p>
                <p><b>Gazdi tel:</b> <?= $t['gazdi_telefonszam'] ?: '-' ?></p>
                <p><b>Cím:</b> <?= $t['lakcim'] ?: '-' ?></p>
                <p><b>Megjegyzés:</b> <?= $t['extra_megjegyzes'] ?: '-' ?></p>
            </div>

            <!-- 3. SZÁLLÍTÁS -->
            <div class="card">
                <h3>🚚 Szállítás</h3>
                <p><b>Név:</b> <?= $t['nev'] ?></p>
                <p><b>Email:</b> <?= $t['email'] ?></p>
                <p><b>Telefon:</b> <?= $t['telefonszam'] ?></p>
                <p><b>Cím:</b> <?= $t['cim'] ?></p>
            </div>

        </div>

    <?php endforeach; ?>

    </div>
</div>

<?php endforeach; ?>

</body>
</html>
