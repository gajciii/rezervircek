<?php
include "server.php";

session_start(); // Začni sejo

// Odjava uporabnika
session_unset();
session_destroy();

// Preusmeri nazaj na login.php ali drugo stran
header("location: ../frontend/home.php");
exit;
?>