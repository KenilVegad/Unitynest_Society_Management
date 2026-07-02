<?php
// Database connection details
$servername = "localhost";  // The database host
$username = "root";         // MySQL username
$password = "";             // MySQL password
$dbname = "society_management";  // The database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);
                                                                                              
// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$uploadSuccess = false;  // Initialize flag for success

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get and sanitize the form data
    $visitorName = mysqli_real_escape_string($conn, $_POST['visitor_name']);
    $arrivalDateTime = mysqli_real_escape_string($conn, $_POST['arrival_time']);
    $departureDateTime = mysqli_real_escape_string($conn, $_POST['departure_time']);
    $relativeName = mysqli_real_escape_string($conn, $_POST['relative_name']);
    $purposeOfVisit = mysqli_real_escape_string($conn, $_POST['purpose_of_visit']);

    // Handle optional fields
    $numberOfMembers = isset($_POST['number_of_members']) ? mysqli_real_escape_string($conn, $_POST['number_of_members']) : NULL;
    $hasVehicle = isset($_POST['has_vehicle']) ? mysqli_real_escape_string($conn, $_POST['has_vehicle']) : NULL;
    $vehicleNumber = isset($_POST['vehicle_number']) ? mysqli_real_escape_string($conn, $_POST['vehicle_number']) : NULL;
    
    // Validate the datetime format: YYYY-MM-DD HH:MM:SS
    $arrivalDateTimeObj = DateTime::createFromFormat('Y-m-d H:i:s', $arrivalDateTime);
    $departureDateTimeObj = DateTime::createFromFormat('Y-m-d H:i:s', $departureDateTime);
    
    if ($arrivalDateTimeObj && $departureDateTimeObj) {
        // Dates are valid, proceed with insertion
        $sql = "INSERT INTO visitor_details (visitor_name, arrival_time, departure_time, relative_name, purpose_of_visit, number_of_members, has_vehicle, vehicle_number)
                VALUES ('$visitorName', '$arrivalDateTime', '$departureDateTime', '$relativeName', '$purposeOfVisit', '$numberOfMembers', '$hasVehicle', '$vehicleNumber')";
        
        if ($conn->query($sql) === TRUE) {
            // Success message after inserting data into the database
            $uploadSuccess = true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<p>Invalid date-time format. Please enter the date and time in YYYY-MM-DD HH:MM:SS format.</p>";
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Form</title>
    <style>
        /* Reset some basic styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Global styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            color: #333;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            font-size: 24px;
            color: #0056b3;
            margin-bottom: 20px;
        }

        /* Form elements styling */
        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
            background-color: #f9f9f9;
            transition: background-color 0.3s ease;
        }

        input[type="text"]:focus,
        textarea:focus,
        select:focus {
            background-color: #e6f7ff;
            border-color: #0056b3;
            outline: none;
        }

        textarea {
            resize: vertical;
        }

        button[type="submit"] {
            background-color: #0056b3;
            color: white;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        button[type="submit"]:hover {
            background-color: #004d99;
        }

        /* Input fields and form group */
        input[type="text"] {
            height: 40px;
        }

        select {
            height: 40px;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h2 {
                font-size: 20px;
            }

            label {
                font-size: 14px;
            }

            input[type="text"],
            select,
            textarea {
                font-size: 14px;
            }

            button[type="submit"] {
                font-size: 14px;
            }
        }
    </style>
    <script>
        // JavaScript for pop-up message
        window.onload = function() {
            <?php if ($uploadSuccess) { ?>
                alert("Visitor data has been uploaded successfully.");
            <?php } ?>
        };
    </script>
</head>
<body>

<div class="container">
    <h2>Enter Visitor Details</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="visitor_name">Visitor Name:</label>
            <input type="text" id="visitor_name" name="visitor_name" required><br><br>
        </div>
        
        <div class="form-group">
            <label for="arrival_time">Arrival Date and Time (YYYY-MM-DD HH:MM:SS):</label>
            <input type="text" id="arrival_time" name="arrival_time" placeholder="YYYY-MM-DD HH:MM:SS" required><br><br>
        </div>
        
        <div class="form-group">
            <label for="departure_time">Departure Date and Time (YYYY-MM-DD HH:MM:SS):</label>
            <input type="text" id="departure_time" name="departure_time" placeholder="YYYY-MM-DD HH:MM:SS" required><br><br>
        </div>
        
        <div class="form-group">
            <label for="relative_name">Relative's Name:</label>
            <input type="text" id="relative_name" name="relative_name" required><br><br>
        </div>
        
        <div class="form-group">
            <label for="purpose_of_visit">Purpose of Visit:</label>
            <textarea id="purpose_of_visit" name="purpose_of_visit" rows="4" required></textarea><br><br>
        </div>
        
        <!-- New fields for number of members and vehicle info -->
        <div class="form-group">
            <label for="number_of_members">Number of Members:</label>
            <input type="text" id="number_of_members" name="number_of_members"><br><br>
        </div>

        <div class="form-group">
            <label for="has_vehicle">Has Vehicle:</label>
            <select id="has_vehicle" name="has_vehicle">
                <option value="">Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select><br><br>
        </div>

        <div class="form-group">
            <label for="vehicle_number">Vehicle Number (if any):</label>
            <input type="text" id="vehicle_number" name="vehicle_number"><br><br>
        </div>

        <div class="form-group">
            <label >Identity card:</label>
            <input type="file" name="identity_doc" accept=".pdf,.jpg,.png"id="documentadd">
        </div>
        
        <button type="submit">Submit Visitor</button>
    </form>
</div>

</body>
</html>