<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adminlogin</title>
    <script src="https://kit.fontawesome.com/2edfbc5391.js"crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style1.css">
    <style>
    .form-container1{
    background: #88d3e3;
    width: 300px;
    height: 300px;
    position: relative;
    text-align: center;
    padding: 10px 0;
    margin: auto;
    box-shadow: 0 0 20px 0px rgba(0,0,0,0.1);
    overflow: hidden;
    border-radius: 35px;
}
    .adminfbtn h1{
        font-size: 25px;
    }
    .form-container1 .admimg {
        width: 130px;
        height: 100px;
        border-radius: 35px;
        
        
    }
    </style>
</head>
<body>
<div class="page">
       <div class="navbar">
           <img src="https://static.vecteezy.com/system/resources/previews/025/255/374/non_2x/tree-people-and-home-beach-sun-set-logo-design-symbol-template-vector.jpg" class="logo">
           <h1>Unity<span style="font-family: 'Merienda', cursive;
            color:#a6e1fa;">Nest</span></h1>
           <nav>
               <ul>
                   <li><a href=""class="active">Home</a></li>
                   <li><a href="#rules">Rules & Regulations</a></li>
                </ul>
            </nav>
            <a href="login.html" class="btn1">User Login</a>
       </div>
       <div class="row">
        <div class="col-1">
        <div class="slider-wrapper">
                <div class="slider">
                    <img src="https://www.commercialproperty.review/wp-content/uploads/2020/10/Godrej-Garden-City-Apartments-SG-Highway-Ahmedabad.jpg" id="slide1"  >
                    <img src="https://media.istockphoto.com/id/1388026461/photo/apartment-buildings-in-a-residential-area.jpg?s=612x612&w=0&k=20&c=GCy56iiHP2PtU_NWXQ02lHAMCzAZehH15k_akMS17gs=" id="slide2">
                    <img src="https://www.belvoir.co.uk/wp-content/uploads/2024/05/Flats-in-the-UK.jpeg" id="slide3">
                 </div>
                 <div class="slider-nav">
                     <a href="#slide1"></a>
                     <a href="#slide2"></a>
                     <a href="#slide3"></a>
                 </div>
            </div>
        </div> 
        <div class="col-2">
           <div class="form-container1">
               <div class="adminfbtn">
                   <h1>Admin Login</h1>
               </div>
               <img src="Images/adminlogin.jpg" class="admimg" alt="">
              <form action="Adminlogin.php" method="POST">
                    <input type="text" placeholder="Username" name="username" required>
                    <input type="numbere" placeholder="Admin Code" name="admincode" required>
                    <button type="submit" class="btn-losi" name="logina" >Login</button>     
                </form>
            </div>
        </div>
        </div>
</div>
<hr>
   <div id="rules">
       <h1>Rules and Regulations</h1>
       <hr>
       
       <li>All users must create an account to access certain features of the website. A valid email address and strong password are required.</li>  
     <li>Users must be at least 13 years old to register on the site. If under 18, parental consent is required.</li>
     <li>Users must acknowledge the website’s privacy policy, which governs the collection and use of personal data.</li>
     <li>All users must interact in a respectful, civil manner. Harassment, hate speech, bullying, or discriminatory behavior is strictly prohibited.</li>
     <li>Every member of the society should park their vehicles in their respective allotted parking spaces only.</li> 
     <li> Users are not allowed to post content that is pornographic, violent, abusive, or illegal.</li> 
     <li>Users retain ownership of their content but grant the website a non-exclusive license to display, distribute, and modify the content as part of the service.</li> 
     <li>Unsolicited advertising, spam, or promotional messages are prohibited. Users may not send mass messages or email without permission.</li>
     <li>All users must adhere to the website’s community standards, which foster a safe and positive environment for all.</li>
     <li>Residents must immediately report any damage to society property (walls, elevators, etc.). Repeated or intentional damage will be charged to the resident.</li> 
     <li>Common areas, including gardens, hallways, and parking lots, must be used responsibly and kept clean. No personal belongings should be stored in these areas.</li> 
     <li>Pets are allowed only if they are registered with the society. Pet owners must clean up after their pets and ensure they do not disturb other residents.</li> 
     <li>Smoking is strictly prohibited in common areas (lobbies, elevators, etc.) and in areas that are not designated as smoking zones.</li> 
     <li>The use of loudspeakers, musical instruments, or sound systems in individual apartments is prohibited, especially during late hours, unless it’s for society-approved events.</li> 
     <li>The society committee members are elected every 2 years. All members are encouraged to participate in elections and in meetings.</li> 
    </div>
    <!-- footer code -->
    <hr>
    <footer>
        <div class="main-content">
            <div class="left box">
                <h2>About Us</h2>
                <div class="content">
                    <p>
                        unityNest is webapp  where society members can get all the updates related to their society. The members also get notified with notices and events held in society and can see information about members in society. Members can also post complaints regarding any issue in society. 
                    </p>
                </div>
            </div>
            <div class="center box adjust">
                <div class="cen">
                    <h2>Quick Links</h2>
                    <ul>
                        <li><a href="login.html">Home</a></li>
                        <li><a href="#Loginform">Login</a></li>
                        <li><a href="#rules">Rules and Regulations</a></li>
                    </ul>
                </div>
                
            </div>
            <div class="right box">
                <h2>Address</h2>
                <div class="content">
                <div class="place">
                        <span class="fas fa-map-marker-alt"></span>
                        <span class="text">Gec Bhavnagar-364002</span>
                    </div>
                    <div class="phone">
                        <span class="fas fa-phone-alt"></span>
                        <span class="text">+91 9999988888</span>
                    </div>
                    <div class="email">
                        <span class="fas fa-envelope"></span>
                        <span class="text">unitynest@gmail.com</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <h3>Copyright @2021|Designed with HTML,CSS,PHP.</h3>
        </div>
    </footer>
</body>
</html>
 
<?php
if(isset($_POST['logina'])){
    $user = $_POST['username'];
    $adcode = $_POST['admincode'];
    if($user=="Admin" && $adcode=="100"){
        echo "<script>alert('Welcome,You are logged in...!');
        window.location.href ='managemem.php';
        </script>";
    }
    else{
        echo "<script>alert('Sorry,Please enter valid details.!!');
        </script>";
    }
}
?>