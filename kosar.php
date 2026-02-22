<?php
session_start();
include 'kapcsolat.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['felhasznalo'])) {
    header("Location: bejelentkez.php");
    exit();
}

$felhasznalonev = $_SESSION['felhasznalo'];

/* FELHASZNÁLÓ LEKÉRÉS */
$stmt = $kapcsolat->prepare("SELECT id FROM felhasznalok WHERE felhasznalonev = ?");
$stmt->bind_param("s", $felhasznalonev);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Felhasználó nem található.");
}

$felhasznalo_id = $user['id'];

/* AKTÍV RENDELÉS */
$stmt = $kapcsolat->prepare("SELECT id FROM rendeles WHERE felhasznalo_id = ? AND teljesitett = 0 LIMIT 1");
$stmt->bind_param("i", $felhasznalo_id);
$stmt->execute();
$result = $stmt->get_result();
$rendeles = $result->fetch_assoc();

$kosar_tetelek = [];
$osszes_db = 0;
$rendeles_id = null;

if ($rendeles) {
    $rendeles_id = $rendeles['id'];

    $stmt = $kapcsolat->prepare("SELECT * FROM kosar WHERE rendeles_id = ?");
    $stmt->bind_param("i", $rendeles_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $kosar_tetelek[] = $row;
    }

    $osszes_db = count($kosar_tetelek);
}

/* TELJES KOSÁR TÖRLÉS */
if (isset($_GET['torles']) && $rendeles_id) {

    $stmt = $kapcsolat->prepare("DELETE FROM kosar WHERE rendeles_id = ?");
    $stmt->bind_param("i", $rendeles_id);
    $stmt->execute();

    $_SESSION['uzenet'] = "🗑️ Kosár törölve.";
    header("Location: kosar.php");
    exit();
}

/* RENDELÉS LEADÁS */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rendeles_leadas']) && $rendeles_id) {

    $stmt = $kapcsolat->prepare("UPDATE rendeles SET teljesitett = 1 WHERE id = ?");
    $stmt->bind_param("i", $rendeles_id);
    $stmt->execute();

    $_SESSION['uzenet'] = "✅ Rendelés leadva!";
    header("Location: kosar.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="UTF-8">
<title>Kosaram - DigitPet</title>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
.kosar-container { max-width: 800px; margin: 20px auto; padding: 20px; }
.kosar-osszes { background: #e8f5e8; padding: 20px; border-radius: 10px; text-align: center; margin-bottom: 30px; }
.kosar-item { background: white; border: 2px solid #28a745; border-radius: 10px; padding: 20px; margin: 15px 0; }
.lead-button { background: #28a745; color: white; padding: 15px 40px; font-size: 18px; border: none; border-radius: 8px; cursor: pointer; width: 100%; }
.torles-btn { background: #dc3545; color: white; padding: 8px 15px; border-radius: 5px; text-decoration:none; display:inline-block; margin-top:10px; }
.ures-kosar { text-align: center; padding: 60px; color: #6c757d; }
</style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="kosar-container">
<h1>🛒 Kosarad</h1>

<?php if(isset($_SESSION['uzenet'])): ?>
<div style="background:#d4edda;padding:10px;margin-bottom:15px;">
<?= $_SESSION['uzenet']; unset($_SESSION['uzenet']); ?>
</div>
<?php endif; ?>

<?php if($osszes_db > 0): ?>

<div class="kosar-osszes">
<h2>📦 Összesen: <strong><?= $osszes_db ?> db</strong> termék</h2>
<a href="?torles=1" class="torles-btn">🗑️ Teljes kosár törlése</a>
</div>

<?php foreach($kosar_tetelek as $tetel): ?>
<div class="kosar-item">
<strong>Tétel ID:</strong> <?= $tetel['id'] ?><br>
<strong>Állat ID:</strong> <?= $tetel['allat_id'] ?><br>
<strong>Típus:</strong> <?= !empty($tetel['termek_tipus']) ? htmlspecialchars($tetel['termek_tipus']) : 'Egyedi tervezés' ?>
</div>
<?php endforeach; ?>

<form method="POST" style="margin-top:20px;">
<button type="submit" name="rendeles_leadas" class="lead-button">
✅ RENDELÉST LEADOM (<?= $osszes_db ?> db)
</button>
</form>

<?php else: ?>

<div class="ures-kosar">
<h2>Üres a kosarad</h2>
<p>Nézd meg a <a href="termekek.php">termékeket</a> vagy <a href="tervez.php">tervezz egyedit</a>.</p>
</div>

<?php endif; ?>

</div>
</body>
</html>