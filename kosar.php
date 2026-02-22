<?php
session_start(); 
include 'kapcsolat.php'; 

if (!isset($_SESSION['felhasznalo'])) { 
    header("Location: bejelentkez.php"); exit(); 
}

$felhasznalonev = $_SESSION['felhasznalo'];
// Felhasználó ID
$q = $kapcsolat->prepare("SELECT id FROM felhasznalok WHERE felhasznalonev = ?");
$q->bind_param("s", $felhasznalonev);
$q->execute();
$user = $q->get_result()->fetch_assoc();
$felhasznalo_id = $user['id'];

// RENDELÉS LEADÁSA
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rendeles_leadas'])) {
    $rendelesek = $kapcsolat->query("SELECT id FROM rendeles WHERE felhasznalo_id = $felhasznalo_id AND teljesitett = 0");
    while($r = $rendelesek->fetch_assoc()) {
        $kapcsolat->query("UPDATE rendeles SET teljesitett = 1 WHERE id = {$r['id']}");
    }
    $_SESSION['uzenet'] = "✅ Minden rendelésed leadva! Hamarosan felvesszük veled a kapcsolatot.";
    header("Location: kosar.php");
    exit();
}

// TÖRLÉS
if (isset($_GET['torles'])) {
    $rendeles_id = (int)$_GET['torles'];
    $kapcsolat->query("DELETE FROM kosar WHERE rendeles_id = $rendeles_id");
    $kapcsolat->query("DELETE FROM rendeles WHERE id = $rendeles_id AND felhasznalo_id = $felhasznalo_id");
    $_SESSION['uzenet'] = "🗑️ Kosár törölve.";
    header("Location: kosar.php");
    exit();
}

// AKTÍV KOSARAK (nem teljesítettek)
$kosarak = $kapcsolat->query("
    SELECT r.id, r.datum, COUNT(k.id) as darab,
           GROUP_CONCAT(DISTINCT a.kutya_nev SEPARATOR ', ') as allat_nevek,
           GROUP_CONCAT(DISTINCT CONCAT('#', HEX(COALESCE(s.szin, 'alap'))) SEPARATOR ', ') as szinek,
           GROUP_CONCAT(DISTINCT f.forma SEPARATOR ', ') as formak
    FROM rendeles r 
    LEFT JOIN kosar k ON r.id = k.rendeles_id
    LEFT JOIN allatok a ON k.allat_id = a.id
    LEFT JOIN szin s ON k.szin_id = s.id
    LEFT JOIN forma f ON k.forma_id = f.id
    WHERE r.felhasznalo_id = $felhasznalo_id AND r.teljesitett = 0
    GROUP BY r.id 
    ORDER BY r.datum DESC
")->fetch_all(MYSQLI_ASSOC);

// ÖSSZES TERMÉK DARABSZÁM
$osszes_db = array_sum(array_column($kosarak, 'darab'));
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kosaram - DigitPet</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .kosar-container { max-width: 800px; margin: 20px auto; padding: 20px; }
        .kosar-osszes { background: #e8f5e8; padding: 20px; border-radius: 10px; text-align: center; margin-bottom: 30px; }
        .kosar-item { background: white; border: 2px solid #28a745; border-radius: 10px; padding: 20px; margin: 15px 0; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .kosar-item.egyezd { border-color: #007bff; }
        .lead-button { background: #28a745; color: white; padding: 15px 40px; font-size: 18px; border: none; border-radius: 8px; cursor: pointer; width: 100%; }
        .torles-btn { background: #dc3545; color: white; padding: 8px 15px; border: none; border-radius: 5px; margin-left: 10px; }
        .ures-kosar { text-align: center; padding: 60px; color: #6c757d; }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="kosar-container">
    <h1>🛒 Kosarad</h1>
    
    <?php if(isset($_SESSION['uzenet'])): ?>
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
            <?= $_SESSION['uzenet'] ?>
        </div>
        <?php unset($_SESSION['uzenet']); ?>
    <?php endif; ?>

    <?php if($osszes_db > 0): ?>
    
    <div class="kosar-osszes">
        <h2>📦 Összesen: <strong><?= $osszes_db ?> db</strong> biléta</h2>
        <p>Kész rendelés leadásához nyomd meg a nagy zöld gombot!</p>
    </div>

    <?php foreach($kosarak as $kosar): ?>
    <div class="kosar-item <?= strpos($kosar['szinek'], '#') !== false ? 'egyezd' : '' ?>">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h3>📅 <?= date('Y.m.d H:i', strtotime($kosar['datum'])) ?></h3>
            <div>
                <strong><?= $kosar['darab'] ?> db</strong>
                <a href="?torles=<?= $kosar['id'] ?>" class="torles-btn" onclick="return confirm('Biztosan törlöd ezt a kosarat?')">🗑️ Törlés</a>
            </div>
        </div>
        
        <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
            <strong>🐕 Állatok:</strong> <?= htmlspecialchars($kosar['allat_nevek']) ?><br>
            <?php if(strpos($kosar['szinek'], '#') !== false): ?>
            <strong>🎨 Színek:</strong> <?= $kosar['szinek'] ?><br>
            <?php endif; ?>
            <?php if($kosar['formak']): ?>
            <strong>🔧 Formák:</strong> <?= $kosar['formak'] ?>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>

    <form method="POST" style="margin-top: 30px;">
        <button type="submit" name="rendeles_leadas" class="lead-button">
            ✅ RENDELÉST LEADOM (<?= $osszes_db ?> db biléta)
        </button>
    </form>

    <?php else: ?>
    <div class="ures-kosar">
        <h2>😊 Üres a kosarad</h2>
        <p>Még nem tetted semmit a kosárba. Nézd meg a <a href="termekek.php">termékeket</a> vagy <a href="tervez.php">tervezz egyedit</a>!</p>
    </div>
    <?php endif; ?>

</div>
</body>
</html>
