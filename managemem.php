<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Member</title>
  <link rel="stylesheet" href="dashstyle.css">
  <script src="https://kit.fontawesome.com/2edfbc5391.js" crossorigin="anonymous"></script>
  <style>
    .content-table {
      border-collapse: collapse;
      margin: 25px 0;
      margin-left: 13px;
      font-size: 0.9em;
      min-width: 400px;
      border-radius: 5px 5px 0 0;
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

    .Table_btn {
      padding: 5px;
      background: #0B87A6;
      text-decoration: none;
      float: right;
      margin-top: -3px;
      margin-right: 40px;
      border-radius: 8px;
      font-size: 15px;
      font-weight: 600;
      color: #fff;
      transition: 0.5s;
    }

    .Table_btn:hover {
      background: #19B3D3;
    }

    .Table_btn1 {
      padding: 8px;
      background: #0B87A6;
      text-decoration: none;
      float: left;
      margin-top: -1px;
      margin-left: 15px;
      margin-right: 40px;
      border-radius: 5px;
      font-size: 15px;
      font-weight: 600;
      color: #fff;
      transition: 0.5s;
    }

    .Table_btn1:hover {
      background: #19B3D3;
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
    <h3>Unity<span>Nest</span></h3>
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
  <a href="managemem.php" class="active"><i class="fas fa-desktop"></i><span>Manage Members</span></a>
  <a href="addnotice.php"><i class="fas fa-bullhorn"></i><span>Add Notice</span></a>
  <a href="viewcomplaints.php"><i class="fas fa-envelope-open-text"></i><span>View Complaints</span></a>
  <a href="viewpayment.php"><i class="fas fa-file-invoice-dollar"></i><span>View Payments</span></a>
  <a href="photo.php"><i class="fas fa-camera-retro"></i><span>Photo Gallery</span></a>
  <a href="admin_create_poll.php"><i class="fas fa-vote-yea"></i><span>Vote Machine</span></a>
  <a href="view_visitors.php"><i class="fas fa-vote-yea"></i><span>Visitors Detail</span></a>
</div>

<div class="content"><br><br><br><br><br><br>
  <a href="insertuser.php" class="Table_btn1">Add Member</a><br><br>

  <?php
  $connection = mysqli_connect("localhost", "root", "", "usersregister");

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['activate'])) {
    $id = $_POST['Id'];
    $query = "UPDATE registration SET active = 1 WHERE Id = '$id'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
      echo "<script>alert('User activated successfully!'); window.location.href='managemem.php';</script>";
    } else {
      echo "<script>alert('Failed to update status!'); window.location.href='managemem.php';</script>";
    }
  }

  $query = "SELECT * FROM registration";
  $query_run = mysqli_query($connection, $query);
  ?>

  <table class="content-table">
    <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Flat No.</th>
      <th>Mobile No.</th>
      <th>No. of Family Members</th>
      <th>Role</th>
      <th>Document</th>
      <th>Update</th>
      <th>Delete</th>
      <th>Status</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($query_run) {
      while ($row = mysqli_fetch_array($query_run)) {
        ?>
        <tr>
          <td><?php echo $row['Id']; ?></td>
          <td><?php echo $row['Username']; ?></td>
          <td><?php echo $row['Email']; ?></td>
          <td><?php echo $row['Flatno']; ?></td>
          <td><?php echo $row['MobileNo']; ?></td>
          <td><?php echo $row['no of family members']; ?></td>

          <td><?php echo $row['role']; ?></td>
         
          <form action="view_doc.php" method="post">
            <input type="hidden" name="Id" value="<?php echo $row['Id']; ?>">
            <td><input type="submit" name="edit" class="Table_btn" value="view"></td>
          </form>

          <form action="updateuser.php" method="post">
            <input type="hidden" name="Id" value="<?php echo $row['Id']; ?>">
            <td><input type="submit" name="edit" class="Table_btn" value="Update"></td>
          </form>

          <form action="deleteuser.php" method="post">
            <input type="hidden" name="Id" value="<?php echo $row['Id']; ?>">
            <td><input type="submit" name="delete" class="Table_btn" value="Delete"></td>
          </form>

          <td>
            <?php if ($row['active'] == 1) { ?>
              <button class="Table_btn" style="background-color: green; color: white;" disabled>Active</button>
            <?php } else { ?>
              <form action="" method="post">
                <input type="hidden" name="Id" value="<?php echo $row['Id']; ?>">
                <input type="submit" name="activate" class="Table_btn" style="background-color: red; color: white;" value="Activate">
              </form>
            <?php } ?>
          </td>
        </tr>
        <?php
      }
    } else {
      echo "<tr><td colspan='11'>No Record found</td></tr>";
    }
    ?>
    </tbody>
  </table>
</div>
</body>
</html>