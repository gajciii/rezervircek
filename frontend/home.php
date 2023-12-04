

<?php
include "../backend/server.php";
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // User is logged in
    $additionalButton1 = '<li class="nav-item"><a class="nav-link" href="restavracijeUporabnik.php">RESTAVRACIJE</a></li>';
    $additionalButton = '';
    $logoutButton = '<li class="nav-item"><a class="nav-link" href="../backend/logout.php">LOGOUT</a></li>';
    $logIn = '';
    $register = '';

} else if (isset($_SESSION['lastnik_id'])){
    // User is logged in
    $additionalButton = '<li class="nav-item"><a class="nav-link" href="restavracije.php">UREDI</a></li>';
    $additionalButton1 = '';
    $logoutButton = '<li class="nav-item"><a class="nav-link" href="../backend/logout.php">LOGOUT</a></li>';
    $logIn = '';
    $register = '';
} else {
    // User is not logged in
    $additionalButton1 = '';
    $additionalButton = ''; // No additional button when not logged in
    $logoutButton = '';
    $logIn = '<li class="nav-item"><a class="nav-link" href="login.php">LOGIN</a></li>';
    $register = '<li class="nav-item"><a class="nav-link" href="registracija.php">REGISTRACIJA</a></li>';
}

?>


<!DOCTYPE html>


<head>
    <meta charset="utf-8">
    <title>Rezervircek</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">


    <link href="../img/logo.png" rel="icon">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap" rel="stylesheet"> 

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

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
            <?php echo $additionalButton; // Display additional button if logged in ?>
            <?php echo $logoutButton; // Display logout button if logged in ?>
            <?php echo $logIn; // Display logout button if logged in ?>
            <?php echo $register; // Display logout button if logged in ?>
 

                </ul>
         </div>
    </nav>


    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="../img/restavracije.jpg" alt="Image">
                    <div class="carousel-caption d-flex align-items-center">
                        <div class="container">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <div class="col-10 col-lg-7 text-center text-lg-start">
                                    <h6 class="text-white text-uppercase mb-3 animated slideInDown">Rezervacije restavracij</h6>
                                    <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">Rezervirajte svoj termin</h1>
                                    <a href="restavracijeUporabnik.php" class="btn btn-primary py-3 px-5 animated slideInDown">Izvedi več<i class="fa fa-arrow-right ms-3"></i></a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
           
        </div>
    </div>
    <!-- Carousel End -->


    
    <!-- Footer Start -->
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
    <!-- Footer End -->


    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>



    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/wow/wow.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/counterup/counterup.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>


    <script src="../js/main.js"></script>
    <script src="../js/navbar.js"></script>
</body>

</html>