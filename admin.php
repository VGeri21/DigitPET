<?php
session_start();
include 'kapcsolat.php';

if (!isset($_SESSION['felhasznalo'])) {
    header("Location: bejelentkez.php"); exit();
}

$felhasznalonev = $_SESSION['felhasznalo'];
$user = $kapcsolat->query("SELECT id, is_admin FROM felhasznalok WHERE felhasznalonev = '$felhasznalonev'")->fetch_assoc();

if (!$user['is_admin']) {
    die("Nincs jogosultságod az admin felülethez!");
}

// RENDELÉSEK LEADÁSA LOGIKA
if (isset($_POST['rendeles_leadas'])) {
    $rendeles_id = $_POST['rendeles_id'];
    $kapcsolat->query("UPDATE rendeles SET teljesitett = 1 WHERE id = $rendeles_id");
    $_SESSION['admin_uzenet'] = "Rendelés jelölve teljesítettnek!";
}

// ÖSSZES RENDELÉS (csak nem teljesítettek)
$rendelesek = $kapcsolat->query("
    SELECT r.id, r.felhasznalo_id, r.datum, f.felhasznalonev, f.email, 
           COUNT(k.id) as darab,
           GROUP_CONCAT(k.allat_id) as allat_ids,
           GROUP_CONCAT(k.szin_id) as szin_ids,
           GROUP_CONCAT(k.forma_id) as forma_ids
    FROM rendeles r 
    JOIN felhasznalok f ON r.felhasznalo_id = f.id 
    LEFT JOIN kosar k ON r.id = k.rendeles_id
    WHERE r.teljesitett = 0
    GROUP BY r.id 
    ORDER BY r.datum DESC
")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - DigitPet Rendelések</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1200px; margin: 0 auto; padding: 20px; }
        .rendeles { background: #f8f9fa; border: 1px solid #dee2e6; margin: 15px 0; padding: 20px; border-radius: 8px; }
        .felhasznalo-info { background: #e9ecef; padding: 10px; margin-bottom: 15px; border-radius: 5px; }
        .termek-lista { margin: 10px 0; }
        .egyezd { background: #fff3cd; padding: 10px; border-radius: 5px; margin: 10px 0; }
        button { background: #dc3545; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer; }
        .teljesit { background: #28a745; }
    </style>
</head>
<body>
    <h1>🔧 Admin - Aktív Rendelések (<?= count($rendelesek) ?> db)</h1>
    
    <?php if(isset($_SESSION['admin_uzenet'])): ?>
        <div style="color: green; padding: 10px; background: #d4edda; border: 1px solid #c3e6cb; margin-bottom: 20px;">
            <?= $_SESSION['admin_uzenet'] ?>
        </div>
        <?php unset($_SESSION['admin_uzenet']); ?>
    <?php endif; ?>

    <?php foreach($rendelesek as $r): 
        $felhasznalo = $kapcsolat->query("SELECT * FROM felhasznalok WHERE id = {$r['felhasznalo_id']}")->fetch_assoc();
        $allat_ids = explode(',', $r['allat_ids']);
    ?>
    
    <div class="rendeles">
        <div class="felhasznalo-info">
            <strong>ID: <?= $r['felhasznalo_id'] ?></strong> | 
            <?= htmlspecialchars($felhasznalonev = $r['felhasznalonev']) ?> | 
            <a href="mailto:<?= $r['email'] ?>"><?= $r['email'] ?></a> | 
            <em><?= $r['datum'] ?></em> | 
            <strong><?= $r['darab'] ?> db termék</strong>
        </div>
        
        <div class="termek-lista">
            <?php foreach($allat_ids as $allat_id): 
                $kutya = $kapcsolat->query("SELECT * FROM allatok WHERE id = $allat_id")->fetch_assoc();
                $szin_info = $r['szin_ids'] ? 'Egyedi szín: ' . $r['szin_ids'] : 'Alap termék';
                $forma_info = $r['forma_ids'] ? 'Forma: ' . $r['forma_ids'] : '';
            ?>
            <div>
                🐕 <strong><?= htmlspecialchars($kutya['kutya_nev']) ?></strong> 
                (<?= $kutya['fajta'] ?>)
                <?php if($r['szin_ids'] || $r['forma_ids']): ?>
                <div class="egyezd">
                    🎨 E GYÉ D I TERVEZŐ<br>
                    Szín kódok: <?= $r['szin_ids'] ?><br>
                    Forma: <?= $r['forma_ids'] ?><br>
                    Név a bilétán: <?= htmlspecialchars($kutya['kutya_nev']) ?>
                </div>
                <?php else: ?>
                <div>⚡ Alap NFC biléta</div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        
        <form method="POST" style="margin-top: 15px;">
            <input type="hidden" name="rendeles_id" value="<?= $r['id'] ?>">
            <button type="submit" name="teljesit" class="teljesit">✅ Teljesítve jelöl</button>
            <button type="submit" name="torles" onclick="return confirm('Biztosan törlöd?')">🗑️ Törlés</button>
        </form>
    </div>
    
    <?php endforeach; ?>

    <?php if(empty($rendelesek)): ?>
    <div style="text-align: center; padding: 40px; color: #6c757d;">
        🎉 Nincs aktív rendelés! Minden teljesítve.
    </div>
    <?php endif; ?>
</body>
</html>
