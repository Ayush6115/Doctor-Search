<!-- admin.php -->

<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate the admin credentials (example: hardcoded values)
    $validUsername = "ayush";
    $validPassword = "7667406057";

    if ($username === $validUsername && $password === $validPassword) {
        // Set session variables
        $_SESSION["admin"] = true;
        header("Location: admin_panel.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* style.css */

/* Container */
.login-container {
  max-width: 400px;
  margin: 0 auto;
  margin-top: 200px;
  padding: 20px;
  border-radius: 4px;
  background: radial-gradient(#add2cd, #83c1c0);
  box-shadow:
    0 2px 4px rgba(0, 0, 0, 0.1),
    0 8px 16px rgba(0, 0, 0, 0.1),
    0 16px 32px rgba(0, 0, 0, 0.1);
}

/* Heading */
h2 {
  text-align: center;
  margin-bottom: 20px;
  color: #08453e;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
  z-index: 1;
}

/* Form */
form {
  display: flex;
  flex-direction: column;
}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 9px;
  font-size: 16px;
  border-radius: 8px;
  border: 1px solid #999999;
  margin-bottom: 5px;
}

input[type="submit"] {
  background-color: #155654;
  transition: background-color 0.3s ease;
  color: #fff;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  padding: 10px;
}

input[type="submit"]:hover {
  background-color: #123a3a;
   transform: scale(1.05);
}

.error {
  color: red;
  margin-top: 10px;
}

/* Optional: Additional styles to enhance the appearance */
body {
  background-color: #f5f5f5;
  font-family: Arial, sans-serif;
}

.login-container {
  margin-top: 100px;
}

    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Log In">
            <?php
            if (isset($error)) {
                echo '<p class="error">' . $error . '</p>';
            }
            ?>
        </form>
    </div>
</body>
</html>
