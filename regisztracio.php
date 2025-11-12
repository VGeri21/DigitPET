<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Regisztráció</title>
</head>
<body>
<?php
session_start();
include 'kapcsolat.php';

if (isset($_POST['regisztral'])) {
    $felhasznalonev = trim($_POST['felhasznalonev']);
    $email = trim($_POST['email']);
    $jelszo = password_hash($_POST['jelszo'], PASSWORD_DEFAULT);

    // Ellenőrzés: gmail.com cím kötelező
    if (!preg_match('/^[a-zA-Z0-9._%+-]+@gmail\.com$/', $email)) {
        alert("❌ Csak gmail.com végződésű e-mail címmel lehet regisztrálni!");
    } else {
        // Ellenőrizzük, létezik-e már ez a felhasználónév
        $lekerdezes1 = $kapcsolat->prepare("SELECT * FROM felhasznalok WHERE felhasznalonev = ?");
        $lekerdezes1->bind_param("s", $felhasznalonev);
        $lekerdezes1->execute();
        $eredmeny1 = $lekerdezes1->get_result();

        // Ellenőrizzük, van-e már ilyen Gmail
        $lekerdezes2 = $kapcsolat->prepare("SELECT * FROM felhasznalok WHERE email = ?");
        $lekerdezes2->bind_param("s", $email);
        $lekerdezes2->execute();
        $eredmeny2 = $lekerdezes2->get_result();

        if ($eredmeny1->num_rows > 0) {
            echo "<p>❌ Ez a felhasználónév már foglalt!</p>";
        } elseif ($eredmeny2->num_rows > 0) {
            echo "<p>⚠️ Ezzel az e-mail címmel már regisztráltak fiókot!</p>";
        } else {
            // Új felhasználó hozzáadása
            $hozzaadas = $kapcsolat->prepare("INSERT INTO felhasznalok (felhasznalonev, jelszo, email) VALUES (?, ?, ?)");
            $hozzaadas->bind_param("sss", $felhasznalonev, $jelszo, $email);

            if ($hozzaadas->execute()) {
                // Átirányítás sikeres regisztráció után
                header("Location: bejelentkez.php?ujsiker=1");
                exit;
            } else {
                echo "<p>⚠️ Hiba történt a regisztráció során!</p>";
            }
        }
    }
}
?>


<div class="ring">
  <i style="--clr:#00FF00;"></i>
  <i style="--clr:#32CD32;"></i>	
  <i style="--clr:#228B22;"></i>
  <div class="login">
    <h2>Regisztráció</h2>
    <div class="inputBx">
    <form method="post">
        <input name="felhasznalonev" required placeholder="Felhasználónév"><br><br>
        <input type="email" name="email" required placeholder="E-mail (csak Gmail)"><br><br>
        <input type="password" name="jelszo" required placeholder="Jelszó"><br><br>
        <button name="regisztral" class="gomb">Regisztráció</button>
    </form>
    </div>
  </div>
</div>
</body>
</html>
