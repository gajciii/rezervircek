<?php

$server = "localhost";
$username = "dsr";
$geslo = "dsr";

try{
    $povezava = new PDO("mysql:host=$server;dbname=dsr", $username, $geslo);
    $povezava->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Uspešna povezava";
}catch(PDOException $e){
    echo "NE uspešna povezava: " . $e->getMessage();
}



// Preverite zahtevano pot (URL)
$requestPath = $_SERVER['PHP_SELF'];


if ($requestPath == "/frontend/restavracije.php") {
    // Obdelava zahteve za prikaz oblike
    include "restavracije.html"; 
    exit;
} else if ($requestPath == "/frontend/urediRestavracije.php") {
    // Obdelava druge zahteve
    include "urediRestavracije.html";
    exit;
}
else if ($requestPath == "/frontend/login.php") {
    // Obdelava druge zahteve
    include "login.html";
    exit;
}
else if ($requestPath == "/frontend/registracija.php") {
    // Obdelava druge zahteve
    include "registracija.html";
    exit;
}
else if ($requestPath == "/frontend/restavracijeUporabnik.php") {
    // Obdelava druge zahteve
    include "restavracijeUporabnik.html";
    exit;
}
else if ($requestPath == "/frontend/home.php") {
    // Obdelava druge zahteve
    include "home.html";
    exit;
}
else if ($requestPath == "/frontend/rezervacija.php") {
    // Obdelava druge zahteve
    include "rezervacija.html";
    exit;
}


?>