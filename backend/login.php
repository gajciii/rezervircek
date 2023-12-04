<?php


include "server.php";// Adjust the path to your server file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $email = $_POST['email'];
        $geslo = $_POST['geslo'];

        // Check if the user is in the 'uporabnik' table
        $queryUporabnik = "SELECT * FROM uporabnik WHERE email=:email";
        $stmtUporabnik = $povezava->prepare($queryUporabnik);
        $stmtUporabnik->bindParam(':email', $email);
        $stmtUporabnik->execute();

        if ($stmtUporabnik->rowCount() == 1) {
            $user = $stmtUporabnik->fetch(PDO::FETCH_ASSOC);
            // Compare hashed password using hash()
            if (hash('sha256', $geslo) === $user['geslo']) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user['ID'];
                header("location: ../frontend/home.php"); // Adjust the path accordingly
                exit;
            } else {
                echo "Napačen email ali geslo!";
            }
        } else {
            // Check if the user is in the 'lastnik' table
            $queryLastnik = "SELECT * FROM lastnik WHERE email=:email";
            $stmtLastnik = $povezava->prepare($queryLastnik);
            $stmtLastnik->bindParam(':email', $email);
            $stmtLastnik->execute();

            if ($stmtLastnik->rowCount() == 1) {
                $lastnik = $stmtLastnik->fetch(PDO::FETCH_ASSOC);
                // Compare hashed password using hash()
                if (hash('sha256', $geslo) === $lastnik['geslo']) {
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['lastnik_id'] = $lastnik['ID'];
                    header("location: ../frontend/home.php");
                    exit;
                } else {
                    echo "Napačen email ali geslo!";
                }
            } else {
                echo "Napačen email ali geslo!";
            }
        }
    } catch (PDOException $e) {
        echo "Napaka pri prijavi: " . $e->getMessage();
    }
}
?>
