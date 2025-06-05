<?php
// Database configuration for contact table
$contactHost = "localhost";
$contactUsername = "root";
$contactPassword = "";
$contactDBName = "contact";

if (isset($_GET['id'])) {
    // Get the contact ID from the request
    $contactId = $_GET['id'];

    // Create a new PDO instance for contact table
    try {
        $contactPDO = new PDO("mysql:host=$contactHost;dbname=$contactDBName", $contactUsername, $contactPassword);
        $contactPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the SQL query to delete the contact message with the given ID
        $deleteStmt = $contactPDO->prepare("DELETE FROM contact WHERE id = :id");
        $deleteStmt->bindParam(':id', $contactId, PDO::PARAM_INT);
        $deleteStmt->execute();
    } catch (PDOException $e) {
        die("Oops! Something went wrong: " . $e->getMessage());
    }
}
