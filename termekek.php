<?php
session_start();
include 'kapcsolat.php';

if (!isset($_SESSION['felhasznalo'])) {
    header("Location: bejelentkez.php");
    exit();
}

$felhasznalonev = $_SESSION['felhasznalo'];

/* USER ID */
$stmt = $kapcsolat->prepare("SELECT id FROM felhasznalok WHERE felhasznalonev = ?");
$stmt->bind_param("s", $felhasznalonev);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$felhasznalo_id = $user['id'];

/* AKTÍV RENDELÉS */
$stmt = $kapcsolat->prepare("SELECT id FROM rendeles WHERE felhasznalo_id = ? AND teljesitett = 0 LIMIT 1");
$stmt->bind_param("i", $felhasznalo_id);
$stmt->execute();
$rendeles = $stmt->get_result()->fetch_assoc();

if (!$rendeles) {
    $stmt = $kapcsolat->prepare("INSERT INTO rendeles (felhasznalo_id, datum, teljesitett) VALUES (?, NOW(), 0)");
    $stmt->bind_param("i", $felhasznalo_id);
    $stmt->execute();
    $rendeles_id = $stmt->insert_id;
} else {
    $rendeles_id = $rendeles['id'];
}

/* ÁLLATOK */
$allatok = $kapcsolat->prepare("SELECT id, kutya_nev FROM allatok WHERE felhasznalo_id = ?");
$allatok->bind_param("i", $felhasznalo_id);
$allatok->execute();
$allatokLista = $allatok->get_result();

/* TERMÉKEK */
$termekek = [
    ['id' => 1, 'nev' => 'Fehér alapon fekete basic NFC Biléta', 'tipus' => 'Basick fehér alapon fekete', 'kep' => 'basic2.png'],
    ['id' => 2, 'nev' => 'Fekete alapon fehér basic NFC Biléta', 'tipus' => 'Basick fekete alapon fehér', 'kep' => 'basic1.png'],
];

/* KOSÁR HOZZÁADÁS */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['termek_id'])) {

    $stmt = $kapcsolat->prepare("
        INSERT INTO kosar (rendeles_id, allat_id, termek_tipus)
        VALUES (?, ?, ?)
    ");

    $stmt->bind_param(
        "iis",
        $rendeles_id,
        $_POST['allat_id'],
        $_POST['termek_tipus']
    );

    $stmt->execute();

    $_SESSION['uzenet'] = "✅ Basic biléta kosárba téve!";
    header("Location: termekek.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="UTF-8">
<title>Basic NFC Biléták</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="termekek.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    footer{
        display:block;
        margin:auto;
        align-items: center;
        width: 100%;
    }
</style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">

<?php if(isset($_SESSION['uzenet'])): ?>
<div style="background:#d4edda;padding:10px;margin-bottom:20px;">
    <?= $_SESSION['uzenet']; unset($_SESSION['uzenet']); ?>
</div>
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

<hr>

<div class="termek-grid">
<?php foreach ($termekek as $t): ?>
<div class="termek">
    <form method="POST">
        <img src="<?= $t['kep'] ?>" alt="<?= $t['nev'] ?>" class="termek-kep">
        <h3><?= $t['nev'] ?></h3>
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