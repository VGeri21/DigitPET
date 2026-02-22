<?php
session_start(); 
include 'kapcsolat.php'; 
if (!isset($_SESSION['felhasznalo'])) { 
    header("Location: bejelentkez.php"); exit(); 
}

$felhasznalonev = $_SESSION['felhasznalo'];
$q = $kapcsolat->prepare("SELECT id FROM felhasznalok WHERE felhasznalonev = ?");
$q->bind_param("s", $felhasznalonev);
$q->execute();
$user = $q->get_result()->fetch_assoc();
$felhasznalo_id = $user['id'];

$allatok = $kapcsolat->prepare("SELECT id, kutya_nev FROM allatok WHERE felhasznalo_id = ?");
$allatok->bind_param("i", $felhasznalo_id);
$allatok->execute();
$allatokLista = $allatok->get_result();

$termekek = [
    ['id' => 1, 'nev' => 'Zöld NFC Biléta', 'ar' => 2990, 'kep' => 'img/zold.png', 'tipus' => 'zold'],
    ['id' => 2, 'nev' => 'Fekete NFC Biléta', 'ar' => 2990, 'kep' => 'img/fekete.png', 'tipus' => 'fekete']
];

// KOSAR HOZZÁADÁS
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['termek_id'])) {
    $rendeles_id = $kapcsolat->query("INSERT INTO rendeles (felhasznalo_id, datum, teljesitett) VALUES ($felhasznalo_id, NOW(), 0)")->insert_id;
    $termek_tipus = $_POST['termek_tipus'];
    $kapcsolat->query("INSERT INTO kosar (rendeles_id, szin_id, forma_id, allat_id, termek_tipus) VALUES ($rendeles_id, NULL, NULL, '{$_POST['allat_id']}', '$termek_tipus')");
    $_SESSION['uzenet'] = "✅ {ucfirst($termek_tipus)} biléta kosárba téve!";
    header("Location: termekek.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Basic NFC Biléták</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="termekek.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <?php if(isset($_SESSION['uzenet'])): ?>
        <div style="color: green; padding: 10px; background: #d4edda;"><?= $_SESSION['uzenet'] ?></div>
        <?php unset($_SESSION['uzenet']); ?>
    <?php endif; ?>

    <h1>Basic NFC Biléták</h1>
    <div class="allat-valaszto">
        <label>Állat kiválasztása:</label>
        <select id="allatSelect">
            <option value="">-- Válassz --</option>
            <?php while($a = $allatokLista->fetch_assoc()): ?>
            <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['kutya_nev']) ?></option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="termek-grid">
        <?php foreach ($termekek as $t): ?>
        <div class="termek">
            <img src="<?= $t['kep'] ?>">
            <h3><?= $t['nev'] ?></h3>
            <div class="ar"><?= number_format($t['ar'], 0, ',', ' ') ?> Ft</div>
            <form method="POST">
                <input type="hidden" name="termek_id" value="<?= $t['id'] ?>">
                <input type="hidden" name="termek_tipus" value="<?= $t['tipus'] ?>">
                <input type="hidden" name="allat_id" class="allatHidden">
                <button type="submit" disabled>Kosárba!</button>
            </form>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<script>
const allatSelect = document.getElementById('allatSelect');
const allatInputs = document.querySelectorAll('.allatHidden');
const buttons = document.querySelectorAll('button');
allatSelect.addEventListener('change', () => {
    const val = allatSelect.value;
    allatInputs.forEach(i => i.value = val);
    buttons.forEach(btn => btn.disabled = !val);
});
</script>
</body>
</html>
