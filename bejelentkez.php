
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

if (isset($_POST['belep'])) {
    $felhasznalonev = $_POST['felhasznalonev'];
    $jelszo = $_POST['jelszo'];

    $lekerdezes = $kapcsolat->prepare("SELECT * FROM users WHERE username = ?");
    $lekerdezes->bind_param("s", $felhasznalonev);
    $lekerdezes->execute();
    $eredmeny = $lekerdezes->get_result();
    
    if($eredmeny->num_rows === 1){
        $user = $eredmeny->fetch_assoc();
        if(password_verify($jelszo, $user['password'])){
            $_SESSION['felhasznalo'] = $felhasznalonev;
            header("Location: index.php");
            exit;
        } else {
            echo "Hibás jelszó!";
        }
    } else {
        echo "Nincs ilyen felhasználó!";
    }
}
?>

<form method="post">
    Felhasználónév: <input name="felhasznalonev" required><br>
    Jelszó: <input type="password" name="jelszo" required><br>
    <button name="belep" class="gomb" >Bejelentkezés</button>
</form>
<a href="regisztracio.php" class="gomb">Regisztráció</a>