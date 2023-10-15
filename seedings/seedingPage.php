<?php
// Enables admin/visitor session to be used with this page
include_once '../includes/session.php';
// Checks to see if there is an active admin session
require_once '../includes/admin_check.php';
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
    <link rel="stylesheet" href="../styles/style.css" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Seeding for 16 players </title>
</head>
<body class="d-flex flex-column">

<header class="bg-dark">
    <div class="d-flex flex-column flex-sm-row align-items-center">
        <div>    <a class="navbar-brand" href="../index.php"><img src="../assets/mandos_redesign_3.webp" id="logo" alt="mandos_redesign_3.webp"></a>
        </div>

        <div>
            <nav class="nav nav-pills flex-column flex-sm-row navbar-dark bg-dark">
                <a class="flex-sm-fill text-sm-center nav-link alink" href="../index.php">Home</a>
                <?php
                if(isset($_SESSION['username'])){
                    echo '<a class="flex-sm-fill text-sm-center nav-link alink" href="../player_search.php">Player Search</a>';
                    echo '<a class="flex-sm-fill text-sm-center nav-link alink new-active" href="seedings.php">Seedings</a>';
                }
                ?>
                <a class="flex-sm-fill text-sm-center nav-link alink" href="../brackets/brackets.php">Brackets</a>
            </nav>
        </div>
        <nav class="nav ms-auto">
            <?php
            if(!isset($_SESSION['username'])){
                echo '<a class="text-sm-center nav-link alink" href="../login.php">Login</a>';
            } else {
                echo '<div id="loginName" class ="text-white">Hello '. $_SESSION['username'] .'! </div>';
                echo '<a class="text-sm-center nav-link alink" href="../logout.php">Logout</a>';
            }
            ?>
        </nav>
    </div>

    <h1 class="bg-dark text-center headertext"> Mando's Disc Golf Tournaments</h1>

</header>




<article>
    </br>
    </br>
    <form
        class="container needs-validation"
        name="form1"
        method="POST"
        action="ranking.php"
        novalidate
    >


        <!--Player 0-->
        <?php
        for ($i = 0; $i <= 15; $i++){

            ?>
            <fieldset class="row gx-2 gy-2 input-group pb-2">
                <div class="col-lg-3 col-md-6 col-sm-12 form-floating mb-2">
                    <input
                            type="text"
                            class="form-control"
                            placeholder="Name" value=""
                            aria-label="name"
                            name="players[<?php $i?>][name]"
                            pattern=".{1,}"
                            required
                    />
                    <label>Name</label>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please provide a valid name.</div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 form-floating mb-2">
                    <input
                            type="number"
                            class="form-control"
                            min="0"
                            max="1200"
                            placeholder="Rating" value="<?php $i?>"
                            aria-label="rating"
                            name="players[<?php $i?>][rating]"
                            required
                    />
                    <label>Rating</label>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please provide a valid rating.</div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 form-floating mb-2">
                    <input
                            type="number"
                            class="form-control"
                            min="0"
                            max="1000000"
                            placeholder="PDGA Number" value=""
                            aria-label="pdganumber"
                            name="players[<?php $i?>][pdganumber]"
                    />
                    <label>PDGA Number</label>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">
                        Please provide a valid PDGA number.
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 form-floating mb-2">
                    <input
                            type="email"
                            class="form-control"
                            placeholder="example@example.com" value="pentagongrc@outlook.com"
                            aria-label="email"
                            name="players[<?php $i?>][email]"
                            pattern="[A-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                            required
                    />
                    <label>Email address</label>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">
                        Please provide a valid email address.
                    </div>
                </div>
            </fieldset>
        <?php
        }

        ?>

        <!--Submit button-->
        <div class="row mt-3">
            <div class="col">
                <button
                    class="btn btn-outline-dark"
                    id="button"
                    type="submit"
                    value="Submit"
                    onclick="formValidation()"
                >
                    submit
                </button>
            </div>
        </div>
    </form>
    <!--End of container-->

    </br>
    </br>
</article>

<!-- footer -->

<footer class="w-100 bg-dark">
    </br>
    </br>
    <div class="d-flex flex-row justify-content-center mb-3">
        <div class="d-flex flex-column p-2 bd-highlight"><a href="https://www.mandos-shop.com/" target="_blank"><img src="../assets/globe.png" alt="globe.png"></a></div>
        <div class="d-flex flex-column p-2 bd-highlight"><a href="https://www.instagram.com/mandos_disc_golf/" target="_blank"><img src="../assets/instagram.png" alt="instagram.png"></a></a></div>
        <div class="d-flex flex-column p-2 bd-highlight"><a href="https://www.facebook.com/Mandosdiscgolfshop/" target="_blank"><img src="../assets/facebook.png" alt="facebook.png"></a></a></div>
    </div>
    </br>
    </br>
    </br>

    <div class="d-flex flex-row justify-content-evenly mb-3">
        <div class="text-center p-3">
            © 2023 Copyright:
            <a class="text-secondary text-decoration-none"

               href="https://thepentagon.greenriverdev.com/"
            >The Pentagon Team</a
            >
        </div>
    </div>
</footer>






<!-- JavaScript-->
<script src="../scripts/script.js"></script>
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
