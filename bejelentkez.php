<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Bejelentkezés</title>
    <style>
        .navbar-bejel{
            display:none;
        }
    </style>
</head>
<body>
<?php
session_start();
include 'kapcsolat.php';

if (isset($_POST['belep'])) {
    $felhasznalonev = $_POST['felhasznalonev'];
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
            header("Location: index.php");
            exit;
        } else {
            echo "<p>❌ Hibás jelszó!</p>";
        }
    } else {
        echo "<p>⚠️ Nincs ilyen felhasználó!</p>";
    }
}
// include 'navbar.php';
?>
<div class="ring">
  <i style="--clr:#00FF00;"></i>
  <i style="--clr:#32CD32;"></i>	
  <i style="--clr:#228B22;"></i>
  <div class="login">
    <h2>Bejelentkezés</h2>
    <div class="inputBx">
    <form method="post"><input name="felhasznalonev" required placeholder="Felhasználónév"><br> <br><input type="password" name="jelszo" placeholder="Jelszó" required><br> <button name="belep" class="gomb" >Belépés</button> </form>
    </div>
    <div class="links">
      <a href="regisztracio.php">Signup</a>
    </div>
  </div>
</div>
</body>
</html>
