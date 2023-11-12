<?php
//include_once 'includes/session.php';
// call functions
require 'functions.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--Bootstrap 5 CSS-->
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous"
    />
    <link rel="stylesheet" href="styles/style.css" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mando's Disc Golf Tournaments </title>
</head>
<header class="bg-dark">
    <div class="d-flex flex-column flex-sm-row align-items-center">
        <div>    <a class="navbar-brand" href="../index.php"><img src="../assets/mandos_redesign_3.webp" id="logo" alt="mandos_redesign_3.webp"></a>
        </div>
    </div>

    <h1 class="text-center headertext"> Mando's Disc Golf Tournaments</h1>

</header>

    <body class="d-flex flex-column">
        <?php
        require $_SERVER['DOCUMENT_ROOT'].'/../db.php';
            $playerID = $_GET['token'];

            $sql = "UPDATE `player` SET get_email = 0 WHERE `player_id` = '$playerID'";

         ?>
        <br>
        <br>
        <div class="container text-center">
            <h4>You have been removed from the current Tournaments email list</h4>
            <p>We wish you the best!</p>
        </div>

        <!-- footer -->

<!--        <footer class="w-100 bg-dark">-->
<!--            </br>-->
<!--            </br>-->
<!--            <div class="d-flex flex-row justify-content-center mb-3">-->
<!--                <div class="d-flex flex-column p-2 bd-highlight"><a href="https://www.mandos-shop.com/" target="_blank"><img src="../assets/globe.png" alt="globe.png"></a></div>-->
<!--                <div class="d-flex flex-column p-2 bd-highlight"><a href="https://www.instagram.com/mandos_disc_golf/" target="_blank"><img src="../assets/instagram.png" alt="instagram.png"></a></a></div>-->
<!--                <div class="d-flex flex-column p-2 bd-highlight"><a href="https://www.facebook.com/Mandosdiscgolfshop/" target="_blank"><img src="../assets/facebook.png" alt="facebook.png"></a></a></div>-->
<!--            </div>-->
<!--            </br>-->
<!--            </br>-->
<!--            </br>-->
<!---->
<!--            <div class="d-flex flex-row justify-content-evenly mb-3">-->
<!--                <div class="text-center p-3">-->
<!--                    © 2023 Copyright:-->
<!--                    <a class="text-secondary text-decoration-none"-->
<!---->
<!--                       href="https://thepentagon.greenriverdev.com/"-->
<!--                    >The Pentagon Team</a-->
<!--                    >-->
<!--                </div>-->
<!--            </div>-->
<!--        </footer>-->

        <!-- JavaScript-->
        <script src="scripts/script.js"></script>
        <!--Bootstrap 5 JavaScript plugins and Popper.-->
        <script
                src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
                integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
                crossorigin="anonymous"
        ></script>
        <script
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
                integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
                crossorigin="anonymous"
        ></script>
    </body>
</html>

