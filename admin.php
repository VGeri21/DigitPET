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
<title>Admin</title>
</head>
<body>

<h1>Leadott rendelések</h1>

<?php foreach($rendelesek as $r): ?>

<div style="border:2px solid black;padding:15px;margin:20px 0;">

<strong>Rendelés ID:</strong> <?= $r['id'] ?><br>
<strong>User ID:</strong> <?= $r['user_id'] ?><br>
<strong>Felhasználó:</strong> <?= htmlspecialchars($r['felhasznalonev']) ?><br>
<strong>Dátum:</strong> <?= $r['datum'] ?>

<hr>

<?php
$stmt = $kapcsolat->prepare("
    SELECT k.*, a.kutya_nev
    FROM kosar k
    LEFT JOIN allatok a ON k.allat_id = a.id
    WHERE k.rendeles_id = ?
");
$stmt->bind_param("i", $r['id']);
$stmt->execute();
$tetelek = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<?php foreach($tetelek as $t): ?>
<div style="background:#f5f5f5;padding:10px;margin:10px 0;">

🐕 <strong>Állat ID (NFC):</strong> <?= $t['allat_id'] ?><br>
Név: <?= htmlspecialchars($t['kutya_nev']) ?><br>

<?php if($t['termek_tipus']): ?>
⚡ Basic: <?= htmlspecialchars($t['termek_tipus']) ?>
<?php else: ?>
🎨 Egyedi<br>
Alap szín: <?= $t['egyedi_alapszin'] ?><br>
Keret szín: <?= $t['egyedi_keretszin'] ?><br>
Felirat: <?= htmlspecialchars($t['egyedi_felirat']) ?>
<?php endif; ?>

</div>
<?php endforeach; ?>

</div>

<?php endforeach; ?>

</body>
</html>