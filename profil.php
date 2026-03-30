<?php
session_start();
include 'kapcsolat.php';

if (!isset($_SESSION['felhasznalo'])) {
        header("Location: bejelentkez.php");
        exit();
}

$felhasznalonev = $_SESSION['felhasznalo'];
$alert = "";
$alert_type = "";

/* FELHASZNÁLÓ ADATOK */
$leker = $kapcsolat->prepare("SELECT * FROM felhasznalok WHERE felhasznalonev = ?");
$leker->bind_param("s", $felhasznalonev);
$leker->execute();
$user = $leker->get_result()->fetch_assoc();
$user_id = $user['id'];

/* FELHASZNÁLÓNÉV MÓDOSÍTÁS */
if (isset($_POST['nev_modosit'])) {
    $ujnev = trim($_POST['uj_felhasznalonev']);

    $ellenor = $kapcsolat->prepare("SELECT id FROM felhasznalok WHERE felhasznalonev = ?");
    $ellenor->bind_param("s", $ujnev);
    $ellenor->execute();

    if ($ellenor->get_result()->num_rows > 0) {
        $alert = "❌ Ez a felhasználónév már foglalt!";
        $alert_type = "error";
    } else {
        $frissit = $kapcsolat->prepare("UPDATE felhasznalok SET felhasznalonev = ? WHERE id = ?");
        $frissit->bind_param("si", $ujnev, $user_id);
        $frissit->execute();

        $_SESSION['felhasznalo'] = $ujnev;
        header("Location: profil.php?success=nev");
        exit;
    }
}

/* JELSZÓ MÓDOSÍTÁS */
if (isset($_POST['jelszo_modosit'])) {
    if (password_verify($_POST['regi_jelszo'], $user['jelszo'])) {
        $uj_jelszo = password_hash($_POST['uj_jelszo'], PASSWORD_DEFAULT);

        $frissit = $kapcsolat->prepare("UPDATE felhasznalok SET jelszo = ? WHERE id = ?");
        $frissit->bind_param("si", $uj_jelszo, $user_id);
        $frissit->execute();

        header("Location: profil.php?success=jelszo");
        exit;
    } else {
        $alert = "❌ Hibás régi jelszó!";
        $alert_type = "error";
    }
}

/* RENDELÉSEK */
function rendelesek($kapcsolat, $user_id, $allapot){
    $q = $kapcsolat->prepare("SELECT * FROM rendeles WHERE felhasznalo_id = ? AND teljesitett = ?");
    $q->bind_param("is", $user_id, $allapot);
    $q->execute();
    return $q->get_result();
}

$aktiv = rendelesek($kapcsolat, $user_id, 'aktiv');
$keszul = rendelesek($kapcsolat, $user_id, 'keszul');
$veg = rendelesek($kapcsolat, $user_id, 'vegrehajtott');
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="profil.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="profil">

<?php if($alert): ?>
<div class="alert <?= $alert_type ?>" id="alertBox"><?= $alert ?></div>
<?php endif; ?>

<h2>Profil adatok</h2>

<!-- FELHASZNÁLÓNÉV -->
<div class="profil-card">
<form method="post">
    <input name="uj_felhasznalonev" value="<?= htmlspecialchars($user['felhasznalonev']) ?>" placeholder="Új felhasználónév" required>
    <button name="nev_modosit" class="gomb">Felhasználónév módosítása</button>
</form>
</div>

<hr>

<!-- JELSZÓ -->
 <div class="profil-card">
<form method="post">
    <input type="password" name="regi_jelszo" placeholder="Régi jelszó" required>
    <input type="password" name="uj_jelszo" placeholder="Új jelszó" required>
    <button name="jelszo_modosit" class="gomb">Jelszó módosítása</button>
</form>
</div>

<hr>

<h2>Rendeléseim</h2>

<?php
function tabla($cim, $adat){
    echo "<h3>$cim</h3>";
    if($adat->num_rows == 0){
        echo "<p>Nincs ilyen rendelés.</p>";
        return;
        }
        echo "<table><tr><th>ID</th><th>Dátum</th><th>Összeg</th><th>Állapot</th></tr>";
        while($r = $adat->fetch_assoc()){
            echo "<tr>
            <td>{$r['id']}</td>
            <td>{$r['datum']}</td>
            <td>{$r['osszeg']} Ft</td>
            <td>{$r['allapot']}</td>
            </tr>";
            }
            echo "</table>";
            }
            
            echo '<div class="profil-card">';
            tabla("🟢 Aktív rendelések", $aktiv);
            tabla("⚙️ Készítés alatt", $keszul);
            tabla("✅ Végrehajtott rendelések", $veg);
            echo "</div>";
?>

</div>

<script>
const alertBox = document.getElementById("alertBox");
if(alertBox){
    setTimeout(()=>alertBox.classList.add("show"),200);
    setTimeout(()=>alertBox.classList.remove("show"),4000);
}
</script>
    <footer>
        <p>© 2025 DigitPet | Okos nyakörvek NFC technológiával</p>
    </footer>


</body>
</html>
