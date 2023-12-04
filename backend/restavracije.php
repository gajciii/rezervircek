<?php
include "server.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get data from the form
    $id = $_POST['id'];
    $naziv = $_POST['naziv'];
    $stevilo_mest = $_POST['stevilo_mest'];
    $naslov = $_POST['naslov'];

    if (empty($id)) {
        // If ID is missing, it's adding a new entry
        dodajRestavracijo($naziv, $stevilo_mest, $naslov);
    } else {
        // If ID is present, it's editing an existing entry
        posodobiRestavracijo($id, $naziv, $stevilo_mest, $naslov);
    }
    
    header("Location: ../frontend/restavracije.php");
    exit;
}


// Check if you are in edit mode (if ID is present in the URL or another way)
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $id_to_edit = $_GET['edit'];
    // Get existing data for editing
    $stmt = $povezava->prepare("SELECT * FROM dsr.restavracija WHERE ID = :id");
    $stmt->bindParam(':id', $id_to_edit, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}





function posodobiRestavracijo($id, $naziv, $stevilo_mest, $naslov) {
    global $povezava;

    $stmt = $povezava->prepare("UPDATE restavracija SET naziv = :naziv, stevilo_mest = :stevilo_mest, naslov = :naslov WHERE ID = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':naziv', $naziv);
    $stmt->bindParam(':stevilo_mest', $stevilo_mest);
    $stmt->bindParam(':naslov', $naslov);
    $stmt->execute();
}



function dodajRestavracijo($naziv, $stevilo_mest, $naslov){
    global $povezava;
    $tk_lastnik = rand(1, 10);
    $stmt = $povezava->prepare("INSERT INTO dsr.restavracija (naziv, stevilo_mest, naslov, tk_lastnik) VALUES (:naziv, :stevilo_mest, :naslov, :tk_lastnik)");
    $stmt->bindParam(':naziv', $naziv);
    $stmt->bindParam(':stevilo_mest', $stevilo_mest);
    $stmt->bindParam(':naslov', $naslov);
    $stmt->bindParam(':tk_lastnik', $tk_lastnik, PDO::PARAM_INT);
    $stmt->execute();
}

function pridobiRestavracijo($id) {
    global $povezava;

    $stmt = $povezava->prepare("SELECT * FROM dsr.restavracija WHERE ID = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
