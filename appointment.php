<?php
// Database configuration
$host = 'localhost';
$dbName = 'appoint';
$username = 'root';
$password = '';

// Establish database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $fullname = $_POST['fullname'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $doctor = $_POST['doctor'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];

    // Insert the appointment details into the database
    $stmt = $pdo->prepare("INSERT INTO appointment (fullname, mobile, email, doctor, date, time, location) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$fullname, $mobile, $email, $doctor, $date, $time, $location]);

    // Set the success message and delay time (in milliseconds) before redirecting
    $message = "Appointment request submitted successfully! We will call you to confirm the appointment.";
    $delay = 5000;

    // Generate the HTML content with the countdown and redirect
    echo '<div id="countdown"></div>';
    echo '<script>
        var seconds = ' . ($delay / 1000) . ';
        function countdown() {
            var countdownElem = document.getElementById("countdown");
            countdownElem.innerHTML = "Redirecting in " + seconds + " seconds...";
            seconds--;
            if (seconds >= 0) {
                setTimeout(countdown, 1000);
            } else {
                window.location.href = "userpage.html";
            }
        }
        countdown();
    </script>';

    echo '<div style="height: 30px;"></div>';

    // Display the success message with custom CSS styles and background image
    echo '<body style="background: radial-gradient(#fff, #67bbb9);
        margin-top: 100px; 
        font-size: 48px;
        text-align: center;
        color: #333;">' . $message . '</body>';
    exit;
}
?>
