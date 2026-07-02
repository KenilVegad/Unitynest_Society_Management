<?php
session_start();


// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "society_management";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the delete request is received
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    // Delete the record from the database
    $deleteSql = "DELETE FROM visitor_details WHERE id = $deleteId";
    if ($conn->query($deleteSql) === TRUE) {
        // Deletion successful, set a flag to redirect to management.php
        echo "<script>
                alert('Record deleted successfully.');
                window.location.href = 'managemem.php'; // Redirect to management.php
              </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch visitor details from the database
$sql = "SELECT * FROM visitor_details";
$result = $conn->query($sql);

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Management System</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #007BFF;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        a {
            color: red;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Visitor Details</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Visitor Name</th><th>Arrival Time</th><th>Departure Time</th><th>Relative's Name</th><th>Purpose of Visit</th><th>Number of Members</th><th>Has Vehicle</th><th>Vehicle Number</th><th>Actions</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['visitor_name'] . "</td>
                    <td>" . $row['arrival_time'] . "</td>
                    <td>" . $row['departure_time'] . "</td>
                    <td>" . $row['relative_name'] . "</td>
                    <td>" . $row['purpose_of_visit'] . "</td>
                    <td>" . $row['number_of_members'] . "</td>
                    <td>" . $row['has_vehicle'] . "</td>
                    <td>" . $row['vehicle_number'] . "</td>
                    <td><a href='?delete_id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a></td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No visitor records found.</p>";
    }
    ?>
</div>

</body>
</html>