<?php
include "server.php";

require_once __DIR__ . '/../vendor/autoload.php';

/*if ($_SERVER["REQUEST_METHOD"] === "POST") {
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
}*/

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check which button was clicked
    if (isset($_POST['shrani'])) {
        // "Shrani" button was clicked
        $id = $_POST['id'];
        $naziv = $_POST['naziv'];
        $stevilo_mest = $_POST['stevilo_mest'];
        $naslov = $_POST['naslov'];

        if (empty($id)) {
         
            dodajRestavracijo($naziv, $stevilo_mest, $naslov);
        } else {
     
            posodobiRestavracijo($id, $naziv, $stevilo_mest, $naslov);
        }

        header("Location: ../frontend/restavracije.php");
        exit;
    } elseif (isset($_POST['download_pdf'])) {
       
        $naziv = $_POST['naziv'];
        $stevilo_mest = $_POST['stevilo_mest'];
        $naslov = $_POST['naslov'];

        $mpdf = new \Mpdf\Mpdf();


        $header = '<table width="100%">
        <tr> 
            <td style="text-align: center;">Rezervirček</td>
        </tr>
        </table>';
        
        $mpdf->SetHeader($header);
        
    
        $footer = '<table width="100%">
            <tr>
                <td style="text-align: right;">rezervircek d.o.o.</td>
            </tr>
        </table>';
        
        $mpdf->SetFooter($footer);
        
        
        $style = '
            body {
                font-family: Arial, sans-serif;

            }
            h1 {
                height: 100px;
             
                text-align: center;
            }
            .strong-container {
                background-color: #d4f0e8; 
                padding: 10px;
               
            }
            strong {
              
                font-size: 18px;
            }
            .hvala {
                margin-top: 20px; 
                text-align: center;
                color: #3eb489; 
                font-size: 18px; 
            }
        ';
        
        $mpdf->WriteHTML($style, 1);
        
      
        $data = '';
        $data .= '<br /><h1>POTRDILO O VNESENI RESTAVRACIJI</h1>';
        $data .= '<div class="strong-container">';
        $data .= '<strong>Naziv: </strong>' . $naziv . '<br />';
        $data .= '<strong>Število mest: </strong>' . $stevilo_mest . '<br />';
        $data .= '<strong>Naslov: </strong>' . $naslov . '<br />';
        $data .= '</div>';
        $data .= '<p class="hvala">Hvala za sodelovanje z nami!</p>';
 
        $mpdf->WriteHTML($data);
        

        $mpdf->Output('mojdokument.pdf', 'D');


        exit;
    }
}



if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $id_to_edit = $_GET['edit'];

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
