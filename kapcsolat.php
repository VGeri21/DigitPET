<?php
$servername = "mysql.omega:3306";
$db_felhasznalo = "vg_login"; 
$db_jelszo = "Gergi2007"; 
$db_nev = "vg_login"; 

$kapcsolat = new mysqli($servername, $db_felhasznalo, $db_jelszo, $db_nev);

if ($kapcsolat->connect_error) {
    die("Kapcsolódási hiba: " . $kapcsolat->connect_error);
}
?>