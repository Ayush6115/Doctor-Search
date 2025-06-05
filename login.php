<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get email and password from the login form (replace with appropriate code)
$userEmail = $_POST["email"];
$userPassword = $_POST["password"];

// Query to retrieve email and password
$sql = "SELECT email, password FROM users";
$result = $conn->query($sql);

$loggedIn = false;

if ($result->num_rows > 0) {
    // Check if the provided email and password match any records
    while ($row = $result->fetch_assoc()) {
        $email = $row["email"];
        $password = $row["password"];
        
        if ($userEmail === $email && $userPassword === $password) {
            // Email and password match, set the logged-in flag and break the loop
            $loggedIn = true;
            break;
        }
    }
}

if ($loggedIn) {
    // Additional actions after successful login
    echo "Login successful.";
    // Redirect to userpage.php
    header("Location: userpage.html");
    exit();
} else {
    echo "Wrong credentials. Login failed.";
}

// Close the database connection
$conn->close();
?>
