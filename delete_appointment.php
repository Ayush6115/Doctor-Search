<?php
// Database configuration for appointments table
$appointHost = "localhost";
$appointUsername = "root";
$appointPassword = "";
$appointDBName = "appoint";

if (isset($_GET['id'])) {
    // Get the appointment ID from the request
    $appointmentId = $_GET['id'];

    // Create a new PDO instance for appointments table
    try {
        $appointPDO = new PDO("mysql:host=$appointHost;dbname=$appointDBName", $appointUsername, $appointPassword);
        $appointPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the SQL query to delete the appointment with the given ID
        $deleteStmt = $appointPDO->prepare("DELETE FROM appointment WHERE id = :id");
        $deleteStmt->bindParam(':id', $appointmentId, PDO::PARAM_INT);
        $deleteStmt->execute();
    } catch (PDOException $e) {
        die("Oops! Something went wrong: " . $e->getMessage());
    }
}
