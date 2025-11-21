<?php
session_start();
include 'kapcsolat.php';

if (!isset($_SESSION['felhasznalo'])) {
    die("❌ Ehhez az oldalhoz be kell jelentkezned!");
}

$felhasznalonev = $_SESSION['felhasznalo'];

// Felhasználó ID lekérése
$leker = $kapcsolat->prepare("SELECT id FROM felhasznalok WHERE felhasznalonev = ?");
$leker->bind_param("s", $felhasznalonev);
$leker->execute();
$user = $leker->get_result()->fetch_assoc();
$felhasznalo_id = $user['id'];

// Automatikus biléta kód generálás
function general_kod() {
    return "DOG-" . date("Ymd") . "-" . substr(md5(uniqid()), 0, 6);
}

$alert = "";
$alert_type = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['allat_reg'])) {

        $kutya_nev = $_POST['kutya_nev'];
        $fajta = $_POST['fajta'];
        $szul_datum = $_POST['szul_datum'];
        $telefonszam = $_POST['gazdi_telefonszam'];
        $lakcim = $_POST['lakcim'];
        $extra = $_POST['extra_megjegyzes'];
        $bileta_kod = general_kod();

        $beszuras = $kapcsolat->prepare("
            INSERT INTO allatok 
            (felhasznalo_id, kutya_nev, fajta, szul_datum, gazdi_telefonszam, lakcim, extra_megjegyzes, bileta_kod)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $beszuras->bind_param("isssssss",
            $felhasznalo_id, $kutya_nev, $fajta, $szul_datum,
            $telefonszam, $lakcim, $extra, $bileta_kod
        );

        if ($beszuras->execute()) {
            // PRG: átirányítás GET-re a dupla beszúrás elkerülésére
            header("Location: allat.php?success=1");
            exit();
        } else {
            header("Location: allat.php?error=1");
            exit();
        }
    }
}

// GET paraméterek alapján alert
$alert = "";
$alert_type = "";

if(isset($_GET['success'])){
    $alert = "✅ Állat sikeresen hozzáadva!";
    $alert_type = "success";
} elseif(isset($_GET['error'])){
    $alert = "❌ Hiba történt a regisztráció során!";
    $alert_type = "error";
}

// Felhasználó állatai
$allatok = $kapcsolat->prepare("SELECT * FROM allatok WHERE felhasznalo_id = ?");
$allatok->bind_param("i", $felhasznalo_id);
$allatok->execute();
$talalatok = $allatok->get_result();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="allat.css">
    <link rel="stylesheet" href="style.css"> <!-- navbar css -->
    <title>Állat regisztráció</title>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="allat-regisztracio">

<?php if($alert): ?>
<div class="alert <?= $alert_type ?>" id="alertBox">
    <?= $alert ?>
</div>
<?php endif; ?>

<h2>Új állat regisztrálása</h2>

<form class="allat-form" method="post">
    <input name="kutya_nev" required placeholder="Állat neve">
    <input name="fajta" placeholder="Fajta">
    <input type="date" name="szul_datum">
    <input name="gazdi_telefonszam" placeholder="Gazdi telefonszám">
    <input name="lakcim" placeholder="Lakcím">
    <textarea name="extra_megjegyzes" placeholder="Megjegyzés"></textarea>
    <button name="allat_reg" class="gomb">Regisztrálás</button>
</form>

<hr>

<h2>Regisztrált állataid</h2>

<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>Név</th>
                <th>Fajta</th>
                <th>Születési dátum</th>
                <th>Biléta kód</th>
                <th>Művelet</th>
            </tr>
        </thead>
        <tbody>
        <?php while($sor = $talalatok->fetch_assoc()): ?>
            <tr>
                <td><?= $sor['kutya_nev'] ?></td>
                <td><?= $sor['fajta'] ?></td>
                <td><?= $sor['szul_datum'] ?></td>
                <td><?= $sor['bileta_kod'] ?></td>
                <td><a href="allat_szerkeszt.php?id=<?= $sor['id'] ?>">✏ Szerkesztés</a></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</div>

<script>
const alertBox = document.getElementById("alertBox");
if(alertBox){
    setTimeout(() => alertBox.classList.add("show"), 200);
    setTimeout(() => alertBox.classList.remove("show"), 4000);
}
</script>

</body>
</html>
