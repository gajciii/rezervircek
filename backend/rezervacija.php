<?php

include "server.php";
session_start();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get data from the form
    $datum_rezervacije = $_POST['datum_rezervacije'];
    $st_ljudi = $_POST['st_ljudi'];
    $TK_uporabnik = $_POST['TK_uporabnik'];
    $current_restavracija_id = $_POST['restavracija_id'];

    // Call the function to add the reservation to the database
    dodajRezervacijo($datum_rezervacije, $st_ljudi, $TK_uporabnik, $current_restavracija_id);

    // Redirect to the appropriate page
   // header("Location: ../frontend/restavracijeUporabnik.php");
    exit;
}



function dodajRezervacijo($datum_rezervacije, $st_ljudi, $TK_uporabnik, $current_restavracija_id){
    global $povezava;

    // Assuming 'stanje' should be set to 1 for a new reservation
    $stanje = 1;

    // Prepare the SQL statement
    $stmt = $povezava->prepare("INSERT INTO dsr.rezervacija (stanje, datum_rezervacije, št_ljudi, TK_uporabnik, TK_restavracija) VALUES (?, ?, ?, ?, ?)");
 
    // Bind parameters using bindValue for PDO
    $stmt->bindValue(1, $stanje, PDO::PARAM_INT);
    $stmt->bindValue(2, $datum_rezervacije, PDO::PARAM_STR);
    $stmt->bindValue(3, $st_ljudi, PDO::PARAM_INT);
    $stmt->bindValue(4, $TK_uporabnik, PDO::PARAM_INT);
    $stmt->bindValue(5, $current_restavracija_id, PDO::PARAM_INT);

    // Execute the statement
    $stmt->execute();

    // Check for errors
    if ($stmt->errorCode() !== '00000') {
        $errorInfo = $stmt->errorInfo();
        echo "Error adding reservation: " . $errorInfo[2];
    } else {
        echo "Reservation added successfully!</br> $datum_rezervacije.
        $st_ljudi.
        $TK_uporabnik.
        $current_restavracija_id" ;
    }

    // Close the statement
    $stmt->closeCursor();
}
?>
