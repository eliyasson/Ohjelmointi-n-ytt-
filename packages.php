<?php
session_start();
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Fatal connection Error");
}

$email = $_SESSION['email'];
$sql = "SELECT name, address FROM customers WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $address = $row['address'];
} else {
    die("Error in query: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Spirax' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="tyylit.css">
  <title>KuvaKantele</title>
  <style>
    body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
    body {font-size:16px;}
    .w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
    .w3-half img:hover{opacity:1}
    .image-container {
      position: relative;
      height: 400px;
      overflow: hidden;
    }

  .image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  </style>
</head>
<body>
    <div class="header">
      <svg xmlns="http://www.w3.org/2000/svg" width="102" height="102" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
        <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z"/>
        <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
      </svg>
        <h1><b>KuvaKantele Photography</b></h1>
        <h2>Tervetuloa, <?php echo $_SESSION['name']; ?>!</h2>
      </div>
      <div class="row">
       <div class="col-3 col-s-3 menu">
         <ul>
          <li><a href="home.php" onclick="w3_close()" ><i class="fa fa-th-large fa-fw w3-margin-right"></i>Etusivu</a></li>
          <li><a href="about.php" onclick="w3_close()" ><i class="fa fa-user fa-fw w3-margin-right"></i>About</a></li>
          <li><a href="packages.php" onclick="w3_close()" ><i class="fa fa-suitcase fa-fw w3-margin-right"></i>Packages</a></li>
          <li><a href="contact.php" onclick="w3_close()"><i class="fa fa-envelope fa-fw w3-margin-right"></i>Contact</a></li>
          <li><a href="forum.html" onclick="w3_close()"><i class="fa fa-envelope fa-fw w3-margin-right"></i>Forum</a></li>
         </ul>
         <div class="aside">
            <div class="w3-card w3-round w3-white">
                <div class="w3-container">
                <h4 class="w3-center"><?php echo $name; ?></h4>
                 <p class="w3-center"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                    <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5"/>
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                  </svg></p>
                 <hr>
                 <p><i class="fa fa-envelope fa-fw w3-margin-right w3-text-theme"></i> <?php echo $email; ?></p>
                 <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i><?php echo $address; ?> </p>

                </div>
              </div>
          </div>
       </div>
   
       <div class="col-9 col-s-9">

        <!-- Packages / Pricing Tables -->
  <div class="w3-container" id="packages" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-red"><b>Packages.</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
    <p class="w3-center w3-padding-64"><span class="w3 w3-wide">Don't miss out on our limited-time special packages! Grab the perfect deal that suits your needs and enjoy exclusive benefits. It's the perfect opportunity to experience more for less.</span></p>
  </div>

  <div class="w3-row-padding">
    <div class="w3-half w3-margin-bottom">
      <ul class="w3-ul w3-light-grey w3-center">
        <li class="w3-dark-grey w3-xlarge w3-padding-32">Basic Photography</li>
            <li class="w3-padding-16">Photo Session</li>
            <li class="w3-padding-16">10 edited images</li>
            <li class="w3-padding-16">Digital Delivery</li>
            <li class="w3-padding-16">Online Gallery</li>
            <li class="w3-padding-16">20% off on additional prints</li>
            <li class="w3-padding-16">
                <h2>$199</h2>
                <span class="w3-opacity">per session</span>
            </li>
            <li class="w3-light-grey w3-padding-24">
                <button class="w3-button w3-white w3-padding-large w3-hover-black">Sign Up</button>
            </li>
        </ul>
    </div>
        
    <div class="w3-half">
      <ul class="w3-ul w3-light-grey w3-center">
        <li class="w3-red w3-xlarge w3-padding-32">Pro Photography & Filming</li>
            <li class="w3-padding-16">Full-Day Coverage</li>
            <li class="w3-padding-16">High-Quality Edited Photos and Videos</li>
            <li class="w3-padding-16">Professional Editing</li>
            <li class="w3-padding-16">Online Gallery</li>
            <li class="w3-padding-16">50% off on additional prints</li>
            <li class="w3-padding-16">
                <h2>$249</h2>
                <span class="w3-opacity">per session</span>
            </li>
            <li class="w3-light-grey w3-padding-24">
                <button class="w3-button w3-red w3-padding-large w3-hover-black">Sign Up</button>
            </li>
        </ul>
    </div>
  </div>
  <!-- Modal for full size images on click-->
        <div id="modal01" class="w3-modal w3-black" style="padding-top:0" onclick="this.style.display='none'">
          <span class="w3-button w3-black w3-xxlarge w3-display-topright">×</span>
          <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
            <img id="img01" class="w3-image">
            <p id="caption"></p>
          </div>
        </div>
       </div>
      </div>
      
   <!-- W3.CSS Container -->
   
   
  <div class="footer w3-container w3-padding-32">
    <footer class="footer w3-content  w3-text-grey w3-xlarge">
      <i class="fa fa-facebook-official w3-hover-opacity"></i>
      <i class="fa fa-instagram w3-hover-opacity"></i>
      <i class="fa fa-snapchat w3-hover-opacity"></i>
      <i class="fa fa-pinterest-p w3-hover-opacity"></i>
      <i class="fa fa-twitter w3-hover-opacity"></i>
      <i class="fa fa-linkedin w3-hover-opacity"></i>
    </footer>
    <p >Powered by: eliyas k. </p>
  </div>
  
  <script>
  // Script to open and close sidebar
  function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
  }
  
  function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
  }

  // Modal Image Gallery
  function onClick(element) {
    document.getElementById("img01").src = element.src;
    document.getElementById("modal01").style.display = "block";
    var captionText = document.getElementById("caption");
    captionText.innerHTML = element.alt;
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>