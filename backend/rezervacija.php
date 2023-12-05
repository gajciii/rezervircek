<?php

include "server.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once __DIR__ . '/../vendor/autoload.php';



session_start();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    $datum_rezervacije = $_POST['datum_rezervacije'];
    $st_ljudi = $_POST['st_ljudi'];
    $TK_uporabnik = $_POST['TK_uporabnik'];
    $current_restavracija_id = $_POST['restavracija_id'];


    dodajRezervacijo($datum_rezervacije, $st_ljudi, $TK_uporabnik, $current_restavracija_id);



    $enquirydata = [
        "Datum rezervacije" => $datum_rezervacije,
        "Število ljudi" => $st_ljudi,
        "Uporabnik" => $TK_uporabnik,
        "Restavracija" => $current_restavracija_id
    ];
    posljiEmail($enquirydata);

    header("Location: ../frontend/restavracijeUporabnik.php");
    exit;
}



function dodajRezervacijo($datum_rezervacije, $st_ljudi, $TK_uporabnik, $current_restavracija_id){
    global $povezava;

    $stanje = 1;

    $stmt = $povezava->prepare("INSERT INTO dsr.rezervacija (stanje, datum_rezervacije, št_ljudi, TK_uporabnik, TK_restavracija) VALUES (?, ?, ?, ?, ?)");
 
    
    $stmt->bindValue(1, $stanje, PDO::PARAM_INT);
    $stmt->bindValue(2, $datum_rezervacije, PDO::PARAM_STR);
    $stmt->bindValue(3, $st_ljudi, PDO::PARAM_INT);
    $stmt->bindValue(4, $TK_uporabnik, PDO::PARAM_INT);
    $stmt->bindValue(5, $current_restavracija_id, PDO::PARAM_INT);

    
    $stmt->execute();

    
    if ($stmt->errorCode() !== '00000') {
        $errorInfo = $stmt->errorInfo();
        echo "Error adding reservation: " . $errorInfo[2];
    } else {
        echo "Reservation added successfully!</br> $datum_rezervacije.
        $st_ljudi.
        $TK_uporabnik.
        $current_restavracija_id" ;
    }

 
    $stmt->closeCursor();
}






function posljiEmail($enquirydata){
    $mail = new PHPMailer(true);

    try {
       
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                  
        $mail->isSMTP();                                         
        $mail->Host       = 'sandbox.smtp.mailtrap.io';                   
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = '9f53e7b04eb819';                    
        $mail->Password   = '8df62b92620aab';                           
        $mail->SMTPSecure = 'tls';            
        $mail->Port       = 2525;                                   
    
        $mail->setFrom('rezervircekAdmin@gmail.com', 'Admin');
        $mail->addAddress('user1@gmail.com', 'User1'); 

        $mail->isHTML(true);                                 
        $mail->Subject = 'Rezervacija uspesna!';
        $mail->Body    = 'Pozdravljeni, <br />zahvaljujemo se vam za rezervacijo preko Rezervircka! <br /> Lep pozdrav, <br />Ekipa Retervircek';
        $mail->AltBody = 'Zahvaljujemo se vam za rezervacijo preko Rezervircka!';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }


}

?>
