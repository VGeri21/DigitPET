
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
</body>
</html>
<?php
session_start();
include 'kapcsolat.php';

if (isset($_POST['regisztral'])) {
    $felhasznalonev = $_POST['felhasznalonev'];
    $jelszo = password_hash($_POST['jelszo'], PASSWORD_DEFAULT);
    $lekerdezes = $kapcsolat->prepare("SELECT * FROM users WHERE username = ?");
    $lekerdezes->bind_param("s", $felhasznalonev);
    $lekerdezes->execute();
    $eredmeny = $lekerdezes->get_result();
    
    if($eredmeny->num_rows > 0){
        echo "Ez a felhasználónév már foglalt!";
    } else {
        $hozzaadas = $kapcsolat->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $hozzaadas->bind_param("ss", $felhasznalonev, $jelszo);
        if($hozzaadas->execute()){
            echo "Sikeres regisztráció! <a href='index.php' class='gomb2'>Bejelentkezés</a>";
        } else {
            echo "Hiba történt!";
        }
    }
}
?>

<form method="post">
    Felhasználónév: <input name="felhasznalonev" required><br>
    Jelszó: <input type="password" name="jelszo" required><br>
    <button name="regisztral" class="gomb">Regisztráció</button>
</form>