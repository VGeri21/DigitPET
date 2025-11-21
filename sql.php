<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'kapcsolat.php';

if ($kapcsolat) {
    echo "Kapcsolat OK!";
} else {
    echo "Hiba a kapcsolódásnál!";
}
?>