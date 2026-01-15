
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

// Állat törlése
if (isset($_GET['id'])) {
    $allat_id = $_GET['id'];
    
    // Ellenőrzés, hogy az állat a felhasználóhoz tartozik-e
    $ellenoriz = $kapcsolat->prepare("SELECT felhasznalo_id FROM allatok WHERE id = ?");
    $ellenoriz->bind_param("i", $allat_id);
    $ellenoriz->execute();
    $allat = $ellenoriz->get_result()->fetch_assoc();
    
    if ($allat && $allat['felhasznalo_id'] == $felhasznalo_id) {
        $torol = $kapcsolat->prepare("DELETE FROM allatok WHERE id = ?");
        $torol->bind_param("i", $allat_id);
        
        if ($torol->execute()) {
            header("Location: allat.php?delete_success=1");
            exit();
        } else {
            header("Location: allat.php?delete_error=1");
            exit();
        }
    } else {
        header("Location: allat.php?delete_error=1");
        exit();
    }
} else {
    header("Location: allat.php?delete_error=1");
    exit();
}
?>