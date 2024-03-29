
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'login.php';
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM customers WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $row = mysqli_fetch_assoc($result);
            $user_type = $row['usertype'];

            session_start();
            $_SESSION['email'] = $email;

            if ($user_type === 'admin') {
                header('Location: home.php');
                exit();
            } else if ($user_type === 'customer') {
                header('Location: user.php');
                exit();
            }
        } else {
            echo "<p class='error-message'>Invalid username or password</p>";
        }
    } else {
        echo "<p class='error-message'>Error in query: " . mysqli_error($conn) . "</p>";
    }
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
      </div>
   
      <div class="row">
        
   
       <div class="col-3 col-s-3 menu">
         <ul>
          <li><a href="#home" onclick="w3_close()" ><i class="fa fa-th-large fa-fw w3-margin-right"></i>Etusivu</a></li>
          <li><a href="#about" onclick="w3_close()" ><i class="fa fa-user fa-fw w3-margin-right"></i>About</a></li>
          <li><a href="#packages" onclick="w3_close()" ><i class="fa fa-suitcase fa-fw w3-margin-right"></i>Packages</a></li>

          <li><a href="#contact" onclick="w3_close()"><i class="fa fa-envelope fa-fw w3-margin-right"></i>Contact</a></li>
         </ul>
         <div class="aside">
            <div class="modal-dialog" role="document">
              <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                  <h1 class="fw-bold mb-0 fs-2">Kirjaudu sisään</h1>
                </div>
          
                <div class="modal-body p-5 pt-0">
                  <form action="signin.php" method="post">
                    <div class="form-floating mb-3">
                      <input type="text" name="email" class="aside2 form-control rounded-3" id="floatingInput" placeholder="Email">
                      <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="password" name="password" class="aside2 form-control rounded-3" id="floatingPassword" placeholder="Password" fdprocessedid="fqch9">
                      <label  for="password">Password</label>
                    </div>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit"  fdprocessedid="jmae6a">Kirjaudu</button>
                    <hr class="my-4">
                    <h2 class="fs-5 fw-bold mb-3">Jos sinulla ei ole tiliä, paina Sign up</h2>
                  </form>
                  <form action="signup.html">
                    <button class="w-100 py-2 mb-2 btn btn-lg btn-outline-primary rounded-3" type="submit" fdprocessedid="e7wrx4">
                      Sign up
                    </button>
                  </form>
          
                </div>
              </div>
            </div>
          </div>
       </div>
   
       <div class="col-9 col-s-9">
        <div class="w3-container" style="margin-top:80px" id="showcase">
          <h1 class="w3-jumbo w3-center"><b>Kuvakantele Photography!</b></h3>
          <h3 class="w3-xxxlarge w3-text-red w3-center"><b>Capturing Moments, Creating Memories.</b></h3>
         
          <hr style="width:50px;border:5px solid rgb(255, 0, 0)" class="w3-round w3-center">
          <p class="w3-center w3-padding-64"><span class="w3 w3-wide">welcomes you to Kuvakantele, where each click tells a unique story. Our passion for photography goes beyond the lens – it's about freezing moments in time, 
            weaving emotions into pixels, and creating a visual symphony that resonates with your soul.</span></p>
        </div>
        <div class="w3-row ">

    <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="w3-display-container">
          <div class="image-container"><img src="./kuva//IMG20240110161320~2.jpg" style="width:100%" onclick="onClick(this)"></div>
          
          <span class="w3-tag w3-display-topleft">New</span>
          <div class="w3-display-middle w3-display-hover">
            <button class="w3-button w3-black">Like<i class="fa fa-shopping-cart"></i></button>
          </div>
        </div>
        
        <p>Lorem Ipsum<br><b>$24.99</b></p>
      </div>
      <div class="w3-container">
        <div class="image-container"><img src="./kuva/IMG20230503135440.jpg" onclick="onClick(this)"></div>
        
        <p>Mega Ripped Jeans<br><b>$19.99</b></p>
      </div>
    </div>

    <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="w3-display-container">
          <div class="image-container"><img src="./kuva/IMG20230812140517.jpg" style="width:100%" onclick="onClick(this)"></div>
          
          <span class="w3-tag w3-display-topleft">New</span>
          <div class="w3-display-middle w3-display-hover">
            <button class="w3-button w3-black">Like<i class="fa fa-shopping-cart"></i></button>
          </div>
        </div>
        <p>Mega Ripped Jeans<br><b>$19.99</b></p>
      </div>
      <div class="w3-container">
        <div class="image-container"><img src="./kuva/IMG20231001142208.jpg" style="width:100%" onclick="onClick(this)"></div>
        
        <p>Washed Skinny Jeans<br><b>$20.50</b></p>
      </div>
    </div>

    <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="image-container"><img src="./kuva/IMG20240102123511.jpg" style="width:100%" onclick="onClick(this)"></div>
        
        <p>Washed Skinny Jeans<br><b>$20.50</b></p>
      </div>
      <div class="w3-container">
        <div class="w3-display-container">
          <div class="image-container"><img src="./kuva/IMG20231116142958_01.jpg" style="width:100%" onclick="onClick(this)"></div>
          
          <span class="w3-tag w3-display-topleft">Sale</span>
          <div class="w3-display-middle w3-display-hover">
            <button class="w3-button w3-black">Buy now <i class="fa fa-shopping-cart"></i></button>
          </div>
        </div>
        <p>Vintage Skinny Jeans<br><b class="w3-text-red">$14.99</b></p>
      </div>
    </div>

    <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="image-container"><img src="./kuva/IMG20231210105955.jpg" style="width:100%" onclick="onClick(this)"></div>
        
        <p>Vintage Skinny Jeans<br><b>$14.99</b></p>
      </div>
      <div class="w3-container">
        <div class="image-container"><img src="./kuva/IMG20231215162916.jpg" style="width:100%" onclick="onClick(this)"></div>
        
        <p>Ripped Skinny Jeans<br><b>$24.99</b></p>
      </div>
    </div>
  </div>

  <div class="w3-center w3-padding-32">
    <div class="w3-bar">
      <a href="#" class="w3-bar-item w3-button w3-hover-black">«</a>
      <a href="#" class="w3-bar-item w3-black w3-button">1</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">2</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">3</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">4</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">»</a>
    </div>
  </div>
  <hr id="about">

  <!-- About Section -->
  <div class="w3-container w3-padding-32 w3-center">  
    <h3 class="w3-black w3-button" ><b>About Us</b></h3><br>
    <div class="w3-row-padding">
      <h4><b>Our Story</b></h4>
      <p class="w3-center w3-padding-64"><span class="w3 w3-wide">Kuvakantele Photography was born from a deep love for the art of capturing moments. Founded by Eliyas k., our team is driven by creativity, passion, and a commitment to delivering stunning visuals that leave a lasting impression.</span></p>
      <video width="1000" height="600" controls onclick="onClick(this)">
        <source src="./kuva/VID20231127151342 (1).mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>
  </div>
  <hr>
        <!-- Photo grid (modal) -->
        <div class="w3-container w3-padding-32 w3-center">  
          <h3><b>Philosophy</b></h3>
          <p class="w3-center w3-padding-32"><span class="w3 w3-wide">At Kuvakantele, we believe in the power of storytelling through imagery. Each photograph is a chapter in the narrative of your life, and we strive to make those chapters extraordinary. Our approach blends technical expertise with an artistic touch to create images that speak volumes</span></p>
          <div class="w3-row-padding">
            <div class="w3-half">
              <div class="image-container" ><img src="./kuva/IMG20240124145950.jpg" style="width:100%" onclick="onClick(this)"></div>
            </div>
        
            <div class="w3-half">
              <div class="image-container"><img src="./kuva/IMG20230503135440.jpg" style="width:100%" onclick="onClick(this)"></div>
            </div>
          </div>
        </div>

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
  
  <div class="w3-container" id="contact" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-red"><b>Contact.</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  
    <p class="w3-center w3-padding-64"><span class="w3 w3-wide">Have a question, want to discuss a project, or simply share your thoughts? We'd love to hear from you. Use the contact form below, and we'll get back to you as soon as possible.</span></p>
   
  </div>
        <div class="w3-container w3-grey w3-padding-32">
          <h1>Subscribe</h1>
          <p>To get special offers and VIP treatment:</p>
          <p><input class="w3-input w3-border" type="text" placeholder="Enter e-mail" style="width:30%"></p>
          <button type="button" class="w3-button w3-red w3-margin-bottom">Subscribe</button>
        </div>
        
        <!-- Footer -->
        <footer class="w3-padding-64 w3-light-grey w3-small w3-center" id="footer">
          <div class="w3-row-padding">
            <div class="w3-col s4">
              <h4>Contact</h4>
              <h6>Questions? Go ahead.</h6>
              <form action="/action_page.php" target="_blank">
                <p><input class="w3-input w3-border" type="text" placeholder="Name" name="Name" required></p>
                <p><input class="w3-input w3-border" type="text" placeholder="Email" name="Email" required></p>
                <p><input class="w3-input w3-border" type="text" placeholder="Subject" name="Subject" required></p>
                <p><input class="w3-input w3-border" type="text" placeholder="Message" name="Message" required></p>
                <button type="submit" class="w3-button w3-block w3-black">Send</button>
              </form>
            </div>
      
            <div class="w3-col s4">
              <h4>About</h4>
              <p>About us</p>
              <p>We're hiring</p>
              <p>Support</p>
              <p>Find store</p>
              <p>Shipment</p>
              <p>Payment</p>
              <p>Gift card</p>
              <p>Return</p>
              <p>Help</p>
            </div>
      
            <div class="w3-col s4 w3-justify">
              <h4>Store</h4>
              <p><i class="fa fa-fw fa-map-marker"></i>Helsinki</p>
              <p><i class="fa fa-fw fa-phone"></i> 045678901</p>
              <p><i class="fa fa-fw fa-envelope"></i>eliyas@gmail.com</p>
              <h4>We accept</h4>
              <p><i class="fa fa-fw fa-cc-amex"></i> Visa</p>
              <p><i class="fa fa-fw fa-credit-card"></i> Credit Card</p>
              <br>
              <i class="fa fa-facebook-official w3-hover-opacity w3-large"></i>
              <i class="fa fa-instagram w3-hover-opacity w3-large"></i>
              <i class="fa fa-snapchat w3-hover-opacity w3-large"></i>
              <i class="fa fa-pinterest-p w3-hover-opacity w3-large"></i>
              <i class="fa fa-twitter w3-hover-opacity w3-large"></i>
              <i class="fa fa-linkedin w3-hover-opacity w3-large"></i>
            </div>
          </div>
        </footer>
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
    <p >Powered by: eliyas k. </p></div>
  
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