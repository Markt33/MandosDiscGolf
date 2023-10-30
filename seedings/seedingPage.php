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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
        <br>
        <button type="button" class="btn btn-danger" id="importBtn">Import</button>
    </div>


    </br>
    </br>

    <div class="container mb-4">
        <button type="button" class="btn btn-danger" onclick="generateFields(16)">16</button>
        <button type="button" class="btn btn-danger" onclick="generateFields(32)">32</button>
        <button type="button" class="btn btn-danger" onclick="generateFields(64)">64</button>
    </div>

    <!-- Seeding Form -->
    <form
            class="container needs-validation"
            name="form1"
            method="POST"
            action="ranking.php"
            novalidate
    >

        <!-- Placeholder for Dynamic Player Fields -->
        <div id="dynamic-fieldset"></div>


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
        const dataLength = data.length;

        // Generate fields first based on dataLength
        generateFields(dataLength);

        for (let i = 0; i < dataLength; i++) {
            let player = data[i];
            console.log(`Populating form for player ${i + 1}`);
            console.log(data[i]);

            document.querySelector(`input[name="players[${i}][name]"]`).value = player.name || '';
            // document.querySelector(`input[name="players[${i}][LastName]"]`).value = player.LastName || '';
            document.querySelector(`input[name="players[${i}][rating]"]`).value = player.rating || '';
            document.querySelector(`input[name="players[${i}][pdganumber]"]`).value = player.pdganumber || '';
            document.querySelector(`input[name="players[${i}][email]"]`).value = player.email || '';
            // Check if date exists and format it before assigning
            // if(player.Date) {
            //     document.querySelector(`input[name="players[${i}][Date]"]`).value = formatDate(player.Date);
            // } else {
            //     document.querySelector(`input[name="players[${i}][Date]"]`).value = '';
            // }
        }
    }

    function generateFields(num) {
        // const formContainer = document.querySelector('.container.needs-validation');
        // formContainer.innerHTML = '';  // Clear current form fields
        const formContainer = document.querySelector('#dynamic-fieldset');
        formContainer.innerHTML = '';  // Clear current player fields only

        for (let i = 0; i < num; i++) {
            // Create fieldset for grouping
            let fieldset = document.createElement('fieldset');
            fieldset.className = "row gx-2 gy-2 input-group pb-2";

            // Create fields: Name, Rating, PDGA Number, Email
            const fields = [
                { label: "Name", type: "text", max: null, placeholder: "Name", name: "name", pattern: ".{1,}", feedback: "Please provide a valid name." },
                { label: "Rating", type: "number", max: 1200, placeholder: "Rating", name: "rating", pattern: null, feedback: "Please provide a valid rating." },
                { label: "PDGA Number", type: "number", max: 1000000, placeholder: "PDGA Number", name: "pdganumber", pattern: null, feedback: "Please provide a valid PDGA number." },
                { label: "Email address", type: "email", max: null, placeholder: "example@example.com", name: "email", pattern: "[A-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,}$", feedback: "Please provide a valid email address." }
            ];

            fields.forEach(field => {
                let div = document.createElement('div');
                div.className = "col-lg-3 col-md-6 col-sm-12 form-floating mb-2";

                let input = document.createElement('input');
                input.type = field.type;
                if (field.max) input.setAttribute('max', field.max);
                if (field.pattern) input.setAttribute('pattern', field.pattern);
                input.className = 'form-control';
                input.placeholder = field.placeholder;
                input.setAttribute('aria-label', field.name);
                input.name = `players[${i}][${field.name}]`;
                input.required = true;

                let label = document.createElement('label');
                label.innerText = field.label;

                let validFeedback = document.createElement('div');
                validFeedback.className = "valid-feedback";
                validFeedback.innerText = "Looks good!";

                let invalidFeedback = document.createElement('div');
                invalidFeedback.className = "invalid-feedback";
                invalidFeedback.innerText = field.feedback;

                div.appendChild(input);
                div.appendChild(label);
                div.appendChild(validFeedback);
                div.appendChild(invalidFeedback);

                fieldset.appendChild(div);
            });

            // Append fieldset to the container
            formContainer.appendChild(fieldset);
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

<!--Player 0-->
<!--        --><?php
//        $players_data = $_SESSION['players_data'] ?? [];
//        for ($i = 0; $i <= 15; $i++) {
//            echo '<fieldset class="row gx-2 gy-2 input-group pb-2">';
//            echo '<div class="col-lg-3 col-md-6 col-sm-12 form-floating mb-2">';
//            echo '<input type="text" class="form-control" placeholder="Name" value="'.$players_data["name"].'" aria-label="name" name="players[' . $i . '][name]" pattern=".{1,}" required />';
//            echo '<label>Name</label>';
//            echo '<div class="valid-feedback">Looks good!</div>';
//            echo '<div class="invalid-feedback">Please provide a valid name.</div>';
//            echo '</div>';
//
//            echo '<div class="col-lg-3 col-md-6 col-sm-12 form-floating mb-2">';
//            echo '<input type="number" class="form-control" min="0" max="1200" placeholder="Rating" value="'.$players_data["rating"].'" aria-label="rating" name="players[' . $i . '][rating]" required />';
//            echo '<label>Rating</label>';
//            echo '<div class="valid-feedback">Looks good!</div>';
//            echo '<div class="invalid-feedback">Please provide a valid rating.</div>';
//            echo '</div>';
//
//            echo '<div class="col-lg-3 col-md-6 col-sm-12 form-floating mb-2">';
//            echo '<input type="number" class="form-control" min="0" max="1000000" placeholder="PDGA Number" value="'.$players_data["pdganumber"].'" aria-label="pdganumber" name="players[' . $i . '][pdganumber]" />';
//            echo '<label>PDGA Number</label>';
//            echo '<div class="valid-feedback">Looks good!</div>';
//            echo '<div class="invalid-feedback">Please provide a valid PDGA number.</div>';
//            echo '</div>';
//
//            echo '<div class="col-lg-3 col-md-6 col-sm-12 form-floating mb-2">';
//            echo '<input type="email" class="form-control" placeholder="example@example.com" value="'.$players_data["email"].'" aria-label="email" name="players[' . $i . '][email]" pattern="[A-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,}$" required />';
//            echo '<label>Email address</label>';
//            echo '<div class="valid-feedback">Looks good!</div>';
//            echo '<div class="invalid-feedback">Please provide a valid email address.</div>';
//            echo '</div>';
//
//            echo '</fieldset>';
//        }
//        ?>

</html>




