<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Data Confirmation</title>
</head>
<body>
<div class="container mt-5">
    <h1>Confirmed Player Data</h1>

    <?php
    if (isset($_SESSION['players_data'])):
        $players = $_SESSION['players_data'];
        foreach ($players as $index => $player):
            ?>
            <h3>Player <?= $index + 1 ?></h3>
            <p>Name: <?= htmlspecialchars($player['first_name'] ?? '') ?> <?= htmlspecialchars($player['last_name'] ?? '') ?></p>
            <p>PDGA Number: <?= htmlspecialchars($player['pdga_number'] ?? '') ?></p>
            <!-- ... Display other player info ... -->
        <?php
        endforeach;
    else:
        ?>
        <p>No data to display.</p>
    <?php endif; ?>
</div>
</body>
</html>
