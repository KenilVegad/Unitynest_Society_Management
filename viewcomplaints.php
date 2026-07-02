<?php
session_start();

// Database connection
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'complaints');

// Check if delete request is made
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // SQL query to delete the complaint from the database
    $query = "DELETE FROM combox WHERE ID = $id";
    
    if (mysqli_query($connection, $query)) {
        // Redirect back to the page to refresh the table after deletion
        header('Location: viewcomplaints.php');
    } else {
        echo "Error deleting record: " . mysqli_error($connection);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View complaints</title>
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

      .delete-btn {
          background-color: red;
          color: white;
          padding: 8px 12px;
          text-decoration: none;
          border-radius: 5px;
          font-weight: bold;
      }

      .delete-btn:hover {
          background-color: darkred;
      }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
    <h4> Admin </h4>
  </center>
  <a href="managemem.php"><i class="fas fa-desktop"></i><span>Manage Members</span></a>
  <a href="addnotice.php"><i class="fas fa-bullhorn"></i><span>Add Notice</span></a>
  <a href="viewcomplaints.php" class="active"><i class="fas fa-envelope-open-text"></i><span>View Complaints</span></a>
  <a href="viewpayment.php" ><i class="fas fa-file-invoice-dollar"></i><span>View Payments</span></a>
  <a href="photo.php"><i class="fas fa-camera-retro"></i><span>Photo Gallery</span></a>
  <a href="admin_create_poll.php"><i class="fas fa-vote-yea"></i><span>Vote Machine</span></a> 
  <a href="view_visitor.php"><i class="fas fa-globe"></i><span>Visitor</span></a>
</div>

<div class="content"><br><br><br><br>
    <?php
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, 'complaints');

    $query = "SELECT * FROM combox";
    $query_run = mysqli_query($connection, $query);
    ?>

    <table class="content-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Complaint</th>
                <th>Action</th> <!-- Added column for Delete button -->
            </tr>
        </thead>
        <tbody>
            <?php
            if ($query_run) {
                while ($row = mysqli_fetch_array($query_run)) {
            ?>
                    <tr>
                        <td><?php echo $row['ID']; ?> </td>
                        <td><?php echo $row['Title']; ?> </td>
                        <td><?php echo $row['complaint']; ?> </td>
                        <td>
                            <!-- Delete button with GET parameter to identify the complaint to delete -->
                            <a href="viewcomplaints.php?delete=<?php echo $row['ID']; ?>" class="delete-btn">Delete</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='4'>No Record Found</td></tr>";
            }
            ?>
        </tbody>
    </table>

</div>
</body>
</html>
