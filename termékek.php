<?php
session_start();
include 'kapcsolat.php';

if (!isset($_SESSION['felhasznalo'])) {
    header("Location: bejelentkez.php");
    exit();
}

$felhasznalonev = $_SESSION['felhasznalo'];

// felhasználó ID
$q = $kapcsolat->prepare("SELECT id FROM felhasznalok WHERE felhasznalonev = ?");
$q->bind_param("s", $felhasznalonev);
$q->execute();
$user = $q->get_result()->fetch_assoc();
$felhasznalo_id = $user['id'];

// állatok
$allatok = $kapcsolat->prepare("SELECT id, kutya_nev FROM allatok WHERE felhasznalo_id = ?");
$allatok->bind_param("i", $felhasznalo_id);
$allatok->execute();
$allatokLista = $allatok->get_result();

// FIX termékek (később jöhet DB-ből)
$termekek = [
    [
        'id' => 1,
        'nev' => 'Zöld NFC Biléta',
        'ar' => 2990,
        'kep' => 'img/zold.png'
    ],
    [
        'id' => 2,
        'nev' => 'Fekete NFC Biléta',
        'ar' => 2990,
        'kep' => 'img/fekete.png'
    ]
];
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
    <h1>Basic NFC Biléták</h1>
    <div class="allat-valaszto">
        <label>Állat kiválasztása (kötelező):</label>
        <select id="allatSelect">
            <option value="">-- Válassz állatot --</option>
            <?php while($a = $allatokLista->fetch_assoc()): ?>
                <option value="<?= $a['id'] ?>">
                    <?= htmlspecialchars($a['kutya_nev']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <!-- TERMÉKEK -->
    <div class="termek-grid">
        <?php foreach ($termekek as $t): ?>
            <div class="termek">
                <img src="<?= $t['kep'] ?>">
                <h3><?= $t['nev'] ?></h3>
                <div class="ar"><?= number_format($t['ar'], 0, ',', ' ') ?> Ft</div>

                <form action="kosarba_tesz.php" method="POST">
                    <input type="hidden" name="termek_id" value="<?= $t['id'] ?>">
                    <input type="hidden" name="allat_id" class="allatHidden">

                    <button type="submit" disabled>
                        Kosárba
                    </button>
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

    buttons.forEach(btn => {
        btn.disabled = (val === "");
    });
});
</script>

</body>
</html>
