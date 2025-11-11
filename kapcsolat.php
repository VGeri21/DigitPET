<?php
$servername = "localhost";
$db_felhasznalo = "root"; 
$db_jelszo = ""; 
$db_nev = "vg_login"; 

$kapcsolat = new mysqli($servername, $db_felhasznalo, $db_jelszo, $db_nev);

if ($kapcsolat->connect_error) {
    die("Kapcsolódási hiba: " . $kapcsolat->connect_error);
}
?>