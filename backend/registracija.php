<?php
include "server.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $ime = $_POST['ime'];
        $priimek = $_POST['priimek'];
        $tel = $_POST['telefonska_stevilka'];
        $email = $_POST['email'];
        $geslo = hash('sha256', $_POST['geslo']);

        $query = "INSERT INTO uporabnik (ime, priimek, telefonska_stevilka, email, geslo) VALUES (:ime, :priimek, :telefonska_stevilka, :email, :geslo)";

        $stmt = $povezava->prepare($query);
        $stmt->bindParam(':ime', $ime);
        $stmt->bindParam(':priimek', $priimek);
        $stmt->bindParam(':telefonska_stevilka', $tel);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':geslo', $geslo);

        $stmt->execute();

        header("Location: ../frontend/login.php");
    } catch (PDOException $e) {
        echo "Napaka pri dodajanju uporabnika: " . $e->getMessage();
    }
}
?>
