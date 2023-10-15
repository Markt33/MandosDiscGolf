<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.8/xlsx.full.min.js"></script>
    <title>Player Seeding</title>
</head>
<body>
<div class="container mt-5">
    <h1>Player Seeding</h1>

    <!-- Import Form -->
    <form id="importForm">
        <div class="form-group">
            <label for="playersFile">Upload Excel File</label>
            <input type="file" class="form-control-file" id="playersFile" name="playersFile" accept=".xlsx" required>
        </div>
        <button type="button" id="importBtn" class="btn btn-primary">Import</button>
    </form>

    <!-- Seeding Form -->
    <form action="process_data.php" method="post" id="seedingForm">
        <h2>Seeding Form</h2>
        <!-- Dynamically created form fields will go here -->
        <button type="submit" name="seed" class="btn btn-secondary">Seed Players</button>
    </form>
</div>
<script>
    document.getElementById('importBtn').addEventListener('click', handleFileUpload);

    function handleFileUpload() {
        const file = document.getElementById('playersFile').files[0];
        if (!file) return;

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
        const form = document.getElementById('seedingForm');
        data.forEach((player, index) => {
            const playerSection = document.createElement('div');
            playerSection.className = 'player-section';

            // First Name
            const firstNameLabel = document.createElement('label');
            firstNameLabel.textContent = `First Name ${index + 1}:`;
            const firstNameInput = document.createElement('input');
            firstNameInput.type = 'text';
            firstNameInput.name = `players[${index}][first_name]`;
            firstNameInput.value = player.FirstName;  // Note the key based on Excel column

            playerSection.appendChild(firstNameLabel);
            playerSection.appendChild(firstNameInput);

            // Last Name
            const lastNameLabel = document.createElement('label');
            lastNameLabel.textContent = `Last Name ${index + 1}:`;
            const lastNameInput = document.createElement('input');
            lastNameInput.type = 'text';
            lastNameInput.name = `players[${index}][last_name]`;
            lastNameInput.value = player.LastName;

            playerSection.appendChild(lastNameLabel);
            playerSection.appendChild(lastNameInput);

            // PDGA Number
            const pdgaNumberLabel = document.createElement('label');
            pdgaNumberLabel.textContent = `PDGA Number ${index + 1}:`;
            const pdgaNumberInput = document.createElement('input');
            pdgaNumberInput.type = 'text';
            pdgaNumberInput.name = `players[${index}][pdga_number]`;
            pdgaNumberInput.value = player.PDGA_Number;

            playerSection.appendChild(pdgaNumberLabel);
            playerSection.appendChild(pdgaNumberInput);

            // ... More fields for Rank, Tournament_ID, and Date ...

            form.appendChild(playerSection);
        });
    }


</script>
</body>
</html>
