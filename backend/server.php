<?php

$server = "localhost";
$username = "dsr";
$geslo = "dsr";

try{
    $povezava = new PDO("mysql:host=$server;dbname=dsr", $username, $geslo);
    $povezava->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $e){
    echo "NE uspešna povezava: " . $e->getMessage();
}


$requestPath = $_SERVER['PHP_SELF'];


if ($requestPath == "/frontend/restavracije.php") {
   
    include "restavracije.html"; 
    exit;
} else if ($requestPath == "/frontend/urediRestavracije.php") {

    include "urediRestavracije.html";
    exit;
}
else if ($requestPath == "/frontend/login.php") {
  
    include "login.html";
    exit;
}
else if ($requestPath == "/frontend/registracija.php") {

    include "registracija.html";
    exit;
}
else if ($requestPath == "/frontend/restavracijeUporabnik.php") {

    include "restavracijeUporabnik.html";
    exit;
}
else if ($requestPath == "/frontend/home.php") {
 
    include "home.html";
    exit;
}
else if ($requestPath == "/frontend/rezervacija.php") {
    
    include "rezervacija.html";
    exit;
}


?>