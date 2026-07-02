<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Owner Dashboard</title>
  <link rel="stylesheet" href="dashstyle.css">
  <script src="https://kit.fontawesome.com/2edfbc5391.js" crossorigin="anonymous"></script>
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
    <h4><?php echo $_SESSION['username']; ?></h4>
  </center>
  <a href="#" class="active"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
  <a href="noticebrd.php"><i class="fas fa-bullhorn"></i><span>Notice Board</span></a>
  <a href="complaint.php"><i class="fas fa-tools"></i><span>Complaints</span></a>
  <a href="payment.php"><i class="fas fa-wallet"></i><span>Payments</span></a>
</div>

<div class="content">
  <h1>Welcome Owner</h1>
  <p>You can view notices, raise complaints, and manage your payments here.</p>
</div>
</body>
</html>

