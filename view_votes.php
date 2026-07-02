<?php
session_start();

 
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");  
    exit();
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
$sql = "SELECT user_votes.*, poll_options.option_text FROM user_votes
        INNER JOIN poll_options ON user_votes.option_id = poll_options.id
        WHERE user_votes.poll_id = $poll_id";
$result = $conn->query($sql);

echo "<h1>Poll Votes</h1>";
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>User ID</th><th>Option Voted</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['user_id'] . "</td><td>" . $row['option_text'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No votes yet.";
}

$conn->close();
?>
