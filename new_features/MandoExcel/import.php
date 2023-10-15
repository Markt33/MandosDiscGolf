<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['playersFile']) && $_FILES['playersFile']['error'] === UPLOAD_ERR_OK) {
    $uploadedFile = $_FILES['playersFile']['tmp_name'];

    try {
        $spreadsheet = IOFactory::load($uploadedFile);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        // Save data to session
        $_SESSION['players_data'] = $sheetData;

        // Redirect to display page
        header('Location: display.php');
        exit;
    } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
        $error = "File could not be read: " . $e->getMessage();
    }
}
?>