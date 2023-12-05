<?php
include "server.php";

session_start(); 


session_unset();
session_destroy();


header("location: ../frontend/home.php");
exit;
?>