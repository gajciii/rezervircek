<?php
include "server.php"; // Include the file with database connection

// Preveri, ali je obrazec za registracijo oddan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $ime = $_POST['ime'];
        $priimek = $_POST['priimek'];
        $tel = $_POST['telefonska_stevilka'];
        $email = $_POST['email'];
        $geslo = hash('sha256', $_POST['geslo']);

        // Pripravi SQL stavek
        $query = "INSERT INTO uporabnik (ime, priimek, telefonska_stevilka, email, geslo) VALUES (:ime, :priimek, :telefonska_stevilka, :email, :geslo)";

        // Pripravi in izvedi poizvedbo s PDO
        $stmt = $povezava->prepare($query);
        $stmt->bindParam(':ime', $ime);
        $stmt->bindParam(':priimek', $priimek);
        $stmt->bindParam(':telefonska_stevilka', $tel);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':geslo', $geslo);

        $stmt->execute();

        echo "Uporabnik uspešno dodan!";
    } catch (PDOException $e) {
        echo "Napaka pri dodajanju uporabnika: " . $e->getMessage();
    }
}
?>
