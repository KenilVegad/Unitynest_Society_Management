<?php
session_start();

 
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.html");
    exit;
}

 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "polls_db";

 
$conn = new mysqli($servername, $username, $password, $dbname);

 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 
$poll_id = 1;  
$sql = "SELECT * FROM poll_options WHERE poll_id = $poll_id";
$result = $conn->query($sql);

 
if (isset($_POST['vote_option'])) {
    $user_id = $_SERVER['REMOTE_ADDR'];  
    $option_id = $_POST['vote_option'];

     
    $check_vote_sql = "SELECT * FROM user_votes WHERE user_id = '$user_id' AND poll_id = $poll_id";
    $check_result = $conn->query($check_vote_sql);

    if ($check_result->num_rows > 0) {
        echo "<script>alert('You have already voted!');</script>";
    } else {
         
        $vote_sql = "INSERT INTO user_votes (user_id, poll_id, option_id) VALUES ('$user_id', '$poll_id', '$option_id')";
        if ($conn->query($vote_sql) === TRUE) {
            echo "<script>alert('Your vote has been recorded!');</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote on Poll</title>
    <link rel="stylesheet" href="dashstyle.css">
    <script src="https://kit.fontawesome.com/2edfbc5391.js" crossorigin="anonymous"></script>
    <style>
        
        .content-table {
            border-collapse: collapse;
            margin: 25px 19px;
            margin-left: 13px;
            font-size: 0.9em;
            min-width: 400px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .content-table thead tr {
            background-color: #19B3D3;
            color: #ffffff;
            text-align: left;
            font-weight: 900;
        }

        .content-table th,
        .content-table td {
            padding: 15px 15px;
        }

        .content-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .content-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .content-table tbody tr:last-of-type {
            border-bottom: 2px solid #82abc7;
        }

         
        .vote-form {
            margin: 20px;
        }

        .vote-form button {
            background-color: #19B3D3;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .vote-form button:hover {
            background-color: #128c7e;
        }
    </style>
</head>
<body>
    <input type="checkbox" id="check">
     
    <header>
        <label for="check">
            <i class="fas fa-bars" id="sidebar_btn"></i>
        </label>
        <div class="left_area">
            <h3>UNITY<span>NEST</span></h3>
        </div>
        <div class="right_area">
            <a href="logout.php" class="logout_btn">Logout</a>
        </div>
    </header>
     
    <div class="sidebar">
        <center>
            <img src="Images/download.png" class="profile_image" alt="">
            <h4> <?php echo $_SESSION['username']; ?> </h4>
        </center>
        <a href="Welcome.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
        <a href="noticebrd.php"><i class="fas fa-bullhorn"></i><span>Notice Board</span></a>
        <a href="complaint.php"><i class="fas fa-envelope-open-text"></i><span>Register Complaint</span></a>
        <a href="payment.php"><i class="fas fa-file-invoice-dollar"></i><span>Maintenance Payment</span></a>
        <a href="userphoto.php"><i class="fas fa-camera-retro"></i><span>Photo Gallery</span></a>
        <a href="uservote.php" class="active"><i class="fas fa-vote-yea"></i><span>Vote Machine</span></a>
        <a href="visitor_form.php"><i class="fas fa-globe"></i><span>Visitor</span></a>
    </div>
     
    <div class="content">
        <h1>Vote on Poll</h1>
        <form action="vote.php" method="POST" class="vote-form">
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><input type='radio' name='vote_option' value='" . $row['id'] . "'> " . $row['option_text'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td>No poll options available.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit">Vote</button>
        </form>
    </div>
    
</body>
</html>

<?php
$conn->close();
?>
