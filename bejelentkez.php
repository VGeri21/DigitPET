<?php
session_start();
include 'kapcsolat.php';

$alert = "";
$alert_type = "";

if (isset($_POST['belep'])) {
    $felhasznalonev = trim($_POST['felhasznalonev']);
    $jelszo = $_POST['jelszo'];

    // Felhasználó lekérdezése
    $lekerdezes = $kapcsolat->prepare("SELECT * FROM felhasznalok WHERE felhasznalonev = ?");
    $lekerdezes->bind_param("s", $felhasznalonev);
    $lekerdezes->execute();
    $eredmeny = $lekerdezes->get_result();
    
    if($eredmeny->num_rows === 1){
        $user = $eredmeny->fetch_assoc();

        // Jelszó ellenőrzése
        if(password_verify($jelszo, $user['jelszo'])){
            $_SESSION['felhasznalo'] = $felhasznalonev;
            $alert = "✅ Sikeres bejelentkezés!";
            $alert_type = "success";
            header("Location: index.php");
            exit;
        } else {
            $alert = "❌ Hibás jelszó!";
            $alert_type = "error";
        }
    } else {
        $alert = "⚠️ Nincs ilyen felhasználó!";
        $alert_type = "error";
    }
}

// Ha sikeres regisztráció után jön ide a felhasználó
if(isset($_GET['ujsiker'])){
    $alert = "✅ Sikeres regisztráció! Most bejelentkezhetsz.";
    $alert_type = "success";
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Bejelentkezés</title>
    <style>
        .navbar-bejel{ display:none; }
    </style>
</head>
<body>

<?php if (!empty($alert)): ?>
<div class="alert <?= $alert_type ?>" id="alertBox">
    <?= $alert ?>
</div>
<?php endif; ?>

<div class="ring">
  <i style="--clr:#00FF00;"></i>
  <i style="--clr:#32CD32;"></i>	
  <i style="--clr:#228B22;"></i>
  <div class="login">
    <h2>Bejelentkezés</h2>
    <div class="inputBx">
        <form method="post">
            <input name="felhasznalonev" required placeholder="Felhasználónév"><br><br>
            <input type="password" name="jelszo" required placeholder="Jelszó"><br><br>
            <button name="belep" class="gomb">Belépés</button>
        </form>
    </div>
    <div class="links">
        <a href="regisztracio.php">Regisztráció</a>
    </div>
  </div>
</div>

<script>
const alertBox = document.getElementById("alertBox");
if(alertBox){
    setTimeout(()=>{ alertBox.classList.add("show"); }, 200);
    setTimeout(()=>{ alertBox.classList.remove("show"); }, 4500);
}
</script>
</body>
</html>
