<?php
 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "polls_db";

 
$conn = new mysqli($servername, $username, $password, $dbname);

 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 
if (isset($_GET['poll_id'])) {
    $poll_id = $_GET['poll_id'];

     
    $sql_poll = "SELECT * FROM polls WHERE id = $poll_id";
    $result_poll = $conn->query($sql_poll);
    if ($result_poll->num_rows > 0) {
        $poll = $result_poll->fetch_assoc();

         
        $sql_options = "SELECT * FROM poll_options WHERE poll_id = $poll_id";
        $result_options = $conn->query($sql_options);
    } else {
        echo "Poll not found!";
        exit();
    }
} else {
    echo "Poll ID is missing!";
    exit();
}

 
if (isset($_POST['vote'])) {
    $selected_option = $_POST['option'];

     
    $sql_vote = "INSERT INTO poll_votes (poll_id, option_id) VALUES ('$poll_id', '$selected_option')";
    if ($conn->query($sql_vote) === TRUE) {
        echo "<script>alert('Thank you for voting!'); window.location.href='poll_success.php?poll_id=$poll_id';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poll - <?php echo htmlspecialchars($poll['question']); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .poll-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .poll-container h1 {
            color: #075e54;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .poll-options {
            margin-bottom: 20px;
        }

        .poll-options label {
            display: block;
            color: #075e54;
            margin: 10px 0;
            font-size: 1.1rem;
        }

        .submit-btn {
            background-color: #25d366;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #128c7e;
        }

        .back-btn {
            background-color: #ddd;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            margin-top: 15px;
            cursor: pointer;
        }

        .back-btn:hover {
            background-color: #aaa;
        }
    </style>
</head>
<body>
    <div class="poll-container">
        <h1>Vote on Poll: <?php echo htmlspecialchars($poll['question']); ?></h1>

        <form action="poll_success.php?poll_id=<?php echo $poll_id; ?>" method="POST">
            <div class="poll-options">
                <?php while ($option = $result_options->fetch_assoc()) : ?>
                    <label>
                        <input type="radio" name="option" value="<?php echo $option['id']; ?>" required>
                        <?php echo htmlspecialchars($option['option_text']); ?>
                    </label>
                <?php endwhile; ?>
            </div>

            <button type="submit" name="vote" class="submit-btn">Submit Vote</button>
        </form>

        <button onclick="window.location.href='index.php'" class="back-btn">Back to Polls</button>
    </div>
</body>
</html>
