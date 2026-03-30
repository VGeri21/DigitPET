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
$stmt = $kapcsolat->prepare("SELECT id, kutya_nev FROM allatok WHERE felhasznalo_id = ?");
$stmt->bind_param("i", $felhasznalo_id);
$stmt->execute();
$allatokLista = $stmt->get_result();

/* EGYEDI KOSÁRBA */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['egyedi_kosar'])) {

    $stmt = $kapcsolat->prepare("
        INSERT INTO kosar 
        (rendeles_id, allat_id, egyedi_alapszin, egyedi_keretszin, egyedi_felirat)
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "iisss",
        $rendeles_id,
        $_POST['allat_id'],
        $_POST['alapszin'],
        $_POST['kiemelo_szin'],
        $_POST['nev']
    );

    $stmt->execute();

    $_SESSION['uzenet'] = "✅ Egyedi biléta kosárba téve!";
    header("Location: tervez.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitPet Biléta Tervező</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="tervez.css">
    <link rel="icon" type="image/x-icon" href="DP.png">
    <style>
        .kosar { background: #f0f8f0; padding: 15px; margin: 20px 0; border-radius: 8px; }
        .rendeles-lead button { background: #28a745; color: white; padding: 12px 30px; border: none; border-radius: 5px; }
        .kosarba-gomb { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; margin-top: 10px; }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<?php if(isset($_SESSION['uzenet'])): ?>
    <div style="color: green; padding: 10px; background: #d4edda; border: 1px solid #c3e6cb; margin-bottom: 20px;">
        <?= $_SESSION['uzenet'] ?> 
    </div>
    <?php unset($_SESSION['uzenet']); ?>
<?php endif; ?>

<?php if(!empty($kosar)): ?>
<div class="kosar">
    <h3>Kosárad (<?= count($kosar) ?> db)</h3>
    <?php foreach($kosar as $item): 
        $kutya = $kapcsolat->query("SELECT kutya_nev FROM allatok WHERE id = {$item['allat_id']}")->fetch_assoc();
    ?>
    <div>- <?= $kutya['kutya_nev'] ?> biléta</div>
    <?php endforeach; ?>
    <form method="POST" style="text-align: center; margin-top: 15px;">
        <button type="submit" name="rendeles_leadas">Rendelés leadása</button>
    </form>
</div>
<?php endif; ?>

<div class="bileta-oldal">
    <div class="bileta-kartya">
        <h2>Biléta Tervező</h2>
        <svg id="elonezet" viewBox="0 0 250 250">
            <circle id="forma-kor" cx="125" cy="125" r="100" fill="#00FF00" stroke="#000000" stroke-width="10" style="display:none"/>
            <rect id="forma-negyzet" x="25" y="25" width="200" height="200" rx="20" fill="#00FF00" stroke="#000000" stroke-width="10" style="display:none"/>
            <path id="forma-csont" d="M40,125 Q10,80 40,35 Q60,10 90,30 Q110,50 125,50 Q140,50 160,30 Q190,10 210,35 Q240,80 210,125 Q190,150 160,130 Q140,110 125,110 Q110,110 90,130 Q60,150 40,125 Z" fill="#00FF00" stroke="#000000" stroke-width="10"/>
            <text id="kutya-nev" x="125" y="125" fill="#000000" font-size="22">Állat Neve</text>
            <text id="digitpet" x="125" y="210" fill="#000000" font-size="14">DigitPet</text>
        </svg>

        <form method="POST" id="tervezoForm">
            <div class="controls">
                <div>
                    <label>Állat kiválasztása:</label>
                    <select id="allatSelect" name="allat_id" required>
                        <option value="">-- Válassz állatot --</option>
                        <?php while($allat = $allatokLista->fetch_assoc()): ?>
                        <option value="<?= $allat['id'] ?>"><?= htmlspecialchars($allat['kutya_nev']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div>
                    <label>Forma:</label>
                    <select id="forma" name="forma">
                        <option value="csont">Csont</option>
                        <option value="kor">Kör</option>
                        <option value="negyzet">Négyzet</option>
                    </select>
                </div>
                <div>
                    <label>Alap színe:</label>
                    <input type="color" id="alapszin" name="alapszin" value="#00FF00">
                </div>
                <div>
                    <label>Keret színe:</label>
                    <input type="color" id="kiemelo-szin" name="kiemelo_szin" value="#000000">
                </div>
                <div>
                    <label>Állat neve:</label>
                    <input type="text" id="nev" name="nev" value="Állat Neve" maxlength="15" required>
                </div>
                <button type="submit" name="egyedi_kosar" class="kosarba-gombok" id="kosarbaGomb" disabled>Kosárba!</button>
            </div>
        </form>
    </div>
</div>
<script>
const formak = {
    kor: document.getElementById('forma-kor'),
    negyzet: document.getElementById('forma-negyzet'),
    csont: document.getElementById('forma-csont')
};
const kutyaNevEl = document.getElementById('kutya-nev');
const digitPetEl = document.getElementById('digitpet');
const formaSelect = document.getElementById('forma');
const alapszin = document.getElementById('alapszin');
const kiemeloSzin = document.getElementById('kiemelo-szin');
const nevInput = document.getElementById('nev');
const allatSelect = document.getElementById('allatSelect');
const kosarbaGomb = document.getElementById('kosarbaGomb');

function frissitElonezet() {
    for (let key in formak) {
        formak[key].style.display = (key === formaSelect.value) ? 'block' : 'none';
        formak[key].setAttribute('fill', alapszin.value);
        formak[key].setAttribute('stroke', kiemeloSzin.value);
    }
    kutyaNevEl.setAttribute('fill', kiemeloSzin.value);
    kutyaNevEl.textContent = nevInput.value || "KUTYA NÉV";
    digitPetEl.setAttribute('fill', kiemeloSzin.value);
    
    if (formaSelect.value === 'csont') {
        kutyaNevEl.setAttribute('x', '125'); kutyaNevEl.setAttribute('y', '75');
        digitPetEl.setAttribute('y', '95');
    } else {
        kutyaNevEl.setAttribute('x', '125'); kutyaNevEl.setAttribute('y', '125');
        digitPetEl.setAttribute('y', '210');
    }
    
    // Kosár gomb aktív/inaktív
    kosarbaGomb.disabled = !allatSelect.value || !nevInput.value.trim();
}

[formaSelect, alapszin, kiemeloSzin, nevInput, allatSelect].forEach(el => el.addEventListener('input', frissitElonezet));
frissitElonezet();
</script>
</body>
</html>
