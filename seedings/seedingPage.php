<?php
session_start();
$error = '';
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
    <!-- Import Section -->
    <div class="container mb-4">
        <label for="playersFile">Upload Excel File</label>
        <input type="file" class="form-control-file" id="playersFile" name="playersFile" accept=".xlsx" required>
        <button type="button" class="btn btn-primary" id="importBtn">Import</button>
    </div>


    </br>
    </br>
    <!-- Seeding Form -->
    <form
            class="container needs-validation"
            name="form1"
            id="seedingForm"
            method="POST"
            action="ranking.php"
            novalidate
    >
        <!--Player 0-->
        <?php
//        session_start();
        $players_data = $_SESSION['players_data'] ?? [];
        for ($i = 0; $i <= 15; $i++){
            $player = $players_data[$i] ?? [];
            ?>
            <fieldset class="row gx-2 gy-2 input-group pb-2">
                <?php
                for ($i = 0; $i <= 15; $i++){
                    $player = $players_data[$i] ?? [];
                    ?>
                    <!-- First Name -->
                    <div class="col-lg-2 form-floating mb-2">
                        <input
                                type="text"
                                class="form-control"
                                placeholder="First Name"
                                aria-label="firstname"
                                name="players[<?php echo $i; ?>][FirstName]"
                                value="<?php echo $player['FirstName'] ?? ''; ?>"
                                pattern=".{1,}"
                                required
                        />
                        <label>First Name</label>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please provide a first name.</div>
                    </div>

                    <!-- Last Name -->
                    <div class="col-lg-2 form-floating mb-2">
                        <input
                                type="text"
                                class="form-control"
                                placeholder="Last Name"
                                aria-label="lastname"
                                name="players[<?php echo $i; ?>][LastName]"
                                value="<?php echo $player['LastName'] ?? ''; ?>"
                                pattern=".{1,}"
                                required
                        />
                        <label>Last Name</label>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please provide a last name.</div>
                    </div>

                    <!-- PDGA Number -->
                    <div class="col-lg-2 form-floating mb-2">
                        <input
                                type="number"
                                class="form-control"
                                placeholder="PDGA Number"
                                aria-label="pdganumber"
                                name="players[<?php echo $i; ?>][PDGA_Number]"
                                value="<?php echo $player['PDGA_Number'] ?? ''; ?>"
                                required
                        />
                        <label>PDGA Number</label>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please provide a PDGA number.</div>
                    </div>

                    <!-- Rank -->
                    <div class="col-lg-2 form-floating mb-2">
                        <input
                                type="number"
                                class="form-control"
                                placeholder="Rank"
                                aria-label="rank"
                                name="players[<?php echo $i; ?>][Rank]"
                                value="<?php echo $player['Rank'] ?? ''; ?>"
                                required
                        />
                        <label>Rank</label>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please provide a rank.</div>
                    </div>

                    <!-- Tournament ID -->
                    <div class="col-lg-2 form-floating mb-2">
                        <input
                                type="number"
                                class="form-control"
                                placeholder="Tournament ID"
                                aria-label="tournamentid"
                                name="players[<?php echo $i; ?>][Tournament_ID]"
                                value="<?php echo $player['Tournament_ID'] ?? ''; ?>"
                                required
                        />
                        <label>Tournament ID</label>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please provide a tournament ID.</div>
                    </div>

                    <!-- Date -->
                    <div class="col-lg-2 form-floating mb-2">
                        <input
                                type="date"
                                class="form-control"
                                placeholder="Date"
                                aria-label="date"
                                name="players[<?php echo $i; ?>][Date]"
                                value="<?php echo $player['Date'] ?? ''; ?>"
                                required
                        />
                        <label>Date</label>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please provide a date.</div>
                    </div>

                    <?php
                }
                ?>
            </fieldset>

            <!--            <fieldset class="row gx-2 gy-2 input-group pb-2">-->
<!--                 Name -->
<!--                <div class="col-lg-3 col-md-6 col-sm-12 form-floating mb-2">-->
<!--                    <input-->
<!--                            type="text"-->
<!--                            class="form-control"-->
<!--                            placeholder="Name"-->
<!--                            aria-label="name"-->
<!--                            name="players[--><?php //echo $i; ?><!--][name]"-->
<!--                            value="--><?php //echo $player['Name'] ?? ''; ?><!--"-->
<!--                            pattern=".{1,}"-->
<!--                            required-->
<!--                    />-->
<!--                    <label>Name</label>-->
<!--                    <div class="valid-feedback">Looks good!</div>-->
<!--                    <div class="invalid-feedback">Please provide a valid name.</div>-->
<!--                </div>-->
<!--                 Rating -->
<!--                <div class="col-lg-3 col-md-6 col-sm-12 form-floating mb-2">-->
<!--                    <input-->
<!--                            type="number"-->
<!--                            class="form-control"-->
<!--                            min="0"-->
<!--                            max="1200"-->
<!--                            placeholder="Rating"-->
<!--                            aria-label="rating"-->
<!--                            name="players[--><?php //echo $i; ?><!--][rating]"-->
<!--                            value="--><?php //echo $player['Rating'] ?? ''; ?><!--"-->
<!--                            required-->
<!--                    />-->
<!--                    <label>Rating</label>-->
<!--                    <div class="valid-feedback">Looks good!</div>-->
<!--                    <div class="invalid-feedback">Please provide a valid rating.</div>-->
<!--                </div>-->
<!--                PDGA Number -->-->
<!--                <div class="col-lg-3 col-md-6 col-sm-12 form-floating mb-2">-->
<!--                    <input-->
<!--                            type="number"-->
<!--                            class="form-control"-->
<!--                            min="0"-->
<!--                            max="1000000"-->
<!--                            placeholder="PDGA Number"-->
<!--                            aria-label="pdganumber"-->
<!--                            name="players[--><?php //echo $i; ?><!--][pdganumber]"-->
<!--                            value="--><?php //echo $player['PDGANumber'] ?? ''; ?><!--"-->
<!--                    />-->
<!--                    <label>PDGA Number</label>-->
<!--                    <div class="valid-feedback">Looks good!</div>-->
<!--                    <div class="invalid-feedback">-->
<!--                        Please provide a valid PDGA number.-->
<!--                    </div>-->
<!--                </div>-->
<!--                Email -->-->
<!--                <div class="col-lg-3 col-md-6 col-sm-12 form-floating mb-2">-->
<!--                    <input-->
<!--                            type="email"-->
<!--                            class="form-control"-->
<!--                            placeholder="example@example.com"-->
<!--                            aria-label="email"-->
<!--                            name="players[--><?php //echo $i; ?><!--][email]"-->
<!--                            value="--><?php //echo $player['Email'] ?? ''; ?><!--"-->
<!--                            pattern="[A-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"-->
<!--                            required-->
<!--                    />-->
<!--                    <label>Email address</label>-->
<!--                    <div class="valid-feedback">Looks good!</div>-->
<!--                    <div class="invalid-feedback">-->
<!--                        Please provide a valid email address.-->
<!--                    </div>-->
<!--                </div>-->
<!--            </fieldset>-->
            <?php
        }
        ?>

        <!-- Submit button -->
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
</body>

<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script>
    function formatDate(inputDate) {
        const parts = inputDate.split('/');
        return `${parts[2]}-${parts[0].padStart(2, '0')}-${parts[1].padStart(2, '0')}`;
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        document.getElementById('importBtn').addEventListener('click', handleFileUpload);
    });

    function handleFileUpload() {
        const file = document.getElementById('playersFile').files[0];
        // Log an error message to the console if no file.
        if (!file) return console.error("No file selected");

        const reader = new FileReader();
        reader.onload = function(e) {
            const data = new Uint8Array(e.target.result);
            const workbook = XLSX.read(data, {type: 'array'});
            const firstSheet = workbook.Sheets[workbook.SheetNames[0]];
            const jsonData = XLSX.utils.sheet_to_json(firstSheet);
            populateForm(jsonData);
        };
        reader.readAsArrayBuffer(file);
    }

    function populateForm(data) {
        // Fixed 16 player tournament
        const dataLength = Math.min(data.length, 16);

        for (let i = 0; i < dataLength; i++) {
            let player = data[i];
            console.log(`Populating form for player ${i + 1}`);
            console.log(data[i]);

            document.querySelector(`input[name="players[${i}][FirstName]"]`).value = player.FirstName || '';
            document.querySelector(`input[name="players[${i}][LastName]"]`).value = player.LastName || '';
            document.querySelector(`input[name="players[${i}][PDGA_Number]"]`).value = player.PDGA_Number || '';
            document.querySelector(`input[name="players[${i}][Rank]"]`).value = player.Rank || '';
            document.querySelector(`input[name="players[${i}][Tournament_ID]"]`).value = player.Tournament_ID || '';
            // Check if date exists and format it before assigning
            if(player.Date) {
                document.querySelector(`input[name="players[${i}][Date]"]`).value = formatDate(player.Date);
            } else {
                document.querySelector(`input[name="players[${i}][Date]"]`).value = '';
            }
        }
    }
</script>
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

</html>
