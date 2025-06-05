<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* CSS styles for the admin panel */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
        }

        h1 {
            margin: 0;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
        }

        section {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        button.delete-btn {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        button.delete-btn:hover {
            background-color: #c0392b;
        }
        
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Admin Panel</h1>
        <nav>
            <ul>
                <li><a href="admin_panel.php">Dashboard</a></li>
                <li><a href="a_contact.php">Contact Queries</a></li>
                <li><a href="a_users.php">Users</a></li>
                <li><a href="a_appointment.php">Appointments</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section id="appointments">
        <h2>Appointments</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Time</th>
                <th>Location</th>
                <th>Action</th> <!-- New column for action -->
            </tr>
            <?php
            // Database configuration for appointments table
            $appointHost = "localhost";
            $appointUsername = "root";
            $appointPassword = "";
            $appointDBName = "appoint";

            // Create a new PDO instance for appointments table
            try {
                $appointPDO = new PDO("mysql:host=$appointHost;dbname=$appointDBName", $appointUsername, $appointPassword);
                $appointPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Fetch appointment details from the database
                $appointStmt = $appointPDO->query("SELECT * FROM appointment");
                while ($row = $appointStmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['fullname'] . "</td>";
                    echo "<td>" . $row['mobile'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['doctor'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['time'] . "</td>";
                    echo "<td>" . $row['location'] . "</td>";
                    echo "<td><button class='delete-btn' onclick='deleteAppointment(" . $row['id'] . ")'>Delete</button></td>"; // Delete button with onclick event
                    echo "</tr>";
                }
            } catch (PDOException $e) {
                die("Oops! Something went wrong: " . $e->getMessage());
            }
            ?>
        </table>
    </section>

    <footer>
        <p>Logged in as Admin</p>
    </footer>

    <!-- JavaScript for handling the delete operation -->
    <script>
        function deleteAppointment(appointmentId) {
            if (confirm("Are you sure you want to delete this appointment?")) {
                // Send an AJAX request to delete the appointment from the database
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Reload the page to update the table after successful deletion
                        location.reload();
                    }
                };
                xhr.open("GET", "delete_appointment.php?id=" + appointmentId, true);
                xhr.send();
            }
        }
    </script>
</body>
</html>
