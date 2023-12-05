<?php
include "../backend/server.php";
session_start();

if (isset($_SESSION['user_id'])) {
    
    $additionalButton1 = '<li class="nav-item"><a class="nav-link" href="restavracijeUporabnik.php">RESTAVRACIJE</a></li>';
    $additionalButton = '';
    $logoutButton = '<li class="nav-item"><a class="nav-link" href="../backend/logout.php">LOGOUT</a></li>';
    $logIn = '';
    $register = '';

} else if (isset($_SESSION['lastnik_id'])){
   
    $additionalButton = '<li class="nav-item"><a class="nav-link" href="restavracije.php">UREDI</a></li>';
    $additionalButton1 = '';
    $logoutButton = '<li class="nav-item"><a class="nav-link" href="../backend/logout.php">LOGOUT</a></li>';
    $logIn = '';
    $register = '';
} else {
   
    $additionalButton1 = '';
    $additionalButton = '';
    $logoutButton = '';
    $logIn = '<li class="nav-item"><a class="nav-link" href="login.php">LOGIN</a></li>';
    $register = '<li class="nav-item"><a class="nav-link" href="registracija.php">REGISTRACIJA</a></li>';
}


$stmt = $povezava->query("
    SELECT
        r.ID AS restavracija_id,
        r.naziv AS restavracija_naziv,
        r.stevilo_mest AS restavracija_stevilo_mest,
        r.naslov AS restavracija_naslov,
        r.tk_lastnik AS restavracija_tk_lastnik,
        n.ime AS lastnik_ime,
        n.priimek AS lastnik_priimek
    FROM
        restavracija r
    INNER JOIN lastnik n ON r.tk_lastnik = n.ID
");


$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>


<head>
    <meta charset="utf-8">
    <title>Rezervircek</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">


    <link href="img/logo.png" rel="icon">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap" rel="stylesheet"> 

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    

    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="home.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 mint">Rezervirček</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto p-4 p-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="home.php">DOMOV</a>
            </li>
            <?php echo $additionalButton1;?>
            <?php echo $additionalButton; ?>
            <?php echo $logoutButton; ?>
            <?php echo $logIn; ?>
            <?php echo $register; ?>
 

                </ul>
         </div>
    </nav>

    <h2 class="mt-5">Vnos podatkov za restavracijo</h2>
    <form method="POST" action="../backend/restavracije.php">
        <div class="mb-3">
            <label for="naziv" class="form-label">Naziv:</label>
            <input type="text" class="form-control" name="naziv" id="naziv" value="<?php echo isset($row['restavracija_naziv']) ? $row['restavracija_naziv'] : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label for="stevilo_mest" class="form-label">Število mest:</label>
            <input type="text" class="form-control" name="stevilo_mest" id="stevilo_mest" value="<?php echo isset($row['restavracija_stevilo_mest']) ? $row['restavracija_stevilo_mest'] : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="tk_naslov" class="form-label">Naslov:</label>
            <input type="text" class="form-control" name="naslov" id="naslov" value="<?php echo isset($row['restavracija_naslov']) ? $row['restavracija_naslov'] : ''; ?>" required>
        </div>

        <input type="hidden" name="action" value="shrani">
        
        <button type="submit" name="shrani" class="btn btn-primary">Shrani</button>
        <button type="submit" name="download_pdf" class="btn btn-success">Download PDF</button>
    </form>

    <h2 class="mt-5">Seznam restavracij</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Naziv</th>
                <th>Število mest</th>
                <th>Naslov</th>
                <th>Lastnik</th>
                <th>Opcije</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?php echo $row['restavracija_id']; ?></td>
                    <td><?php echo $row['restavracija_naziv']; ?></td>
                    <td><?php echo $row['restavracija_stevilo_mest']; ?></td>
                    <td><?php echo $row['restavracija_naslov']; ?></td>
                    <td><?php echo $row['lastnik_ime']; ?></td>
                    <td>                  
                    <a href="urediRestavracije.php?id=<?php echo $row['restavracija_id']; ?>" class="btn btn-primary">Uredi</a>
                    </td>
                   
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
              
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        Rezervirček.doo
                    </div>
                    
                </div>
            </div>
        </div>
    </div>



    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>



    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>


    <script src="js/main.js"></script>
    <script src="js/navbar.js"></script>
</body>

</html>

