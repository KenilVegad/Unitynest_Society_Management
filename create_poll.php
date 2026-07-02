<?php
 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "polls_db";

 
$conn = new mysqli($servername, $username, $password, $dbname);

 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 
if (isset($_POST['create_poll'])) {
     
    $poll_question = $_POST['poll_question'];
    $poll_options = $_POST['poll_options'];

     
    $sql = "INSERT INTO polls (question) VALUES ('$poll_question')";
    
    if ($conn->query($sql) === TRUE) {
         
        $poll_id = $conn->insert_id;

        
        foreach ($poll_options as $option) {
            $sql_option = "INSERT INTO poll_options (poll_id, option_text) VALUES ('$poll_id', '$option')";
            if (!$conn->query($sql_option)) {
                
                echo "Error inserting options: " . $conn->error;
            }
        }

        
        echo "<script>alert('Poll created successfully!'); window.location.href='poll_success.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Poll</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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

        .poll-form .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .poll-form label {
            display: block;
            color: #075e54;
            font-size: 1rem;
            margin-bottom: 5px;
        }

        .poll-form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 1rem;
        }

        .add-option-btn {
            background-color: #075e54;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .add-option-btn:hover {
            background-color: #128c7e;
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
    </style>
</head>
<body>
    <div class="poll-container">
        <h1>Create Poll</h1>
        <form action="create_poll.php" method="POST" class="poll-form">
            
            <div class="form-group">
                <label for="poll_question">Poll Question</label>
                <input type="text" id="poll_question" name="poll_question" placeholder="Enter your question..." required>
            </div>

            
            <div class="form-group">
                <label for="poll_options">Options</label>
                <input type="text" name="poll_options[]" placeholder="Option 1" required>
                <input type="text" name="poll_options[]" placeholder="Option 2" required>
            </div>

            
            <button type="button" class="add-option-btn">Add More Options</button>

             
            
            <button type="submit" name="create_poll" class="submit-btn">Create Poll</button>
        </form>
    </div>

    <script>
        
        document.querySelector(".add-option-btn").addEventListener("click", function() {
            var newOption = document.createElement("input");
            newOption.type = "text";
            newOption.name = "poll_options[]";
            newOption.placeholder = "Additional Option";
            document.querySelector(".form-group").appendChild(newOption);
        });
    </script>
</body>
</html>
