<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'login.php';

    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $usertype = $_POST['usertype'];
    $password = $_POST['password'];

    if (empty($name) || empty($address) || empty($phone) || empty($email) || empty($usertype) || empty($password)) {
        echo "<p class='error-message'>All fields are required.</p>";
    } elseif ($usertype !== 'admin' && $usertype !== 'customer') {
        echo "<p class='error-message'>Please select a valid user type (librarian or customer).</p>";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertQuery = "INSERT INTO customers (name, address, phone, email, usertype, password)
            VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertQuery);

        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "ssssss", $name, $address, $phone, $email, $usertype, $password);

        $insertResult = mysqli_stmt_execute($stmt);

        if ($insertResult) {
            echo "<p class='success-message'>Signup Successful</p>";
            if ($usertype === 'admin') {
                header('Location: admin_sign.php');
            } elseif ($usertype === 'customer') {
                header('Location: index.php');
            }

            exit();
           } else {
            echo "<p class='error-message'>Insertion failed: " . mysqli_error($conn) . "</p>";
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
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
        .form-check.fw-bold {
            margin: 10px 50px;
            font-size: 16px;
        }
        .error-message {
            color: red;
            font-weight: bold;
        }
        .success-message {
            color: green;
            font-weight: bold;
        }
    </style>
    <title>Sign Up</title>

</head>
<body>
    <div class="header">
        <h1>KuvaKantele Photography</h1>
      </div>
    <div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignup">
        <div class="modal-dialog" role="document">
        <div class="modal-content rounded-4 shadow">
        <form action="signup.php" method="post">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2">Kirjaudu sisään</h1>
                <a href="home.html" onclick="$('#yourModalId').modal('hide');" aria-label="Close">Close</a>
            </div>
            <p style="margin-left: 10px;"  class="fw-bold fs-5 mt-3">Ennen kuin rekisteröidyt, valitse roolisi: joko librarian or customer.</p>

            <div class="modal-body p-5 pt-0">
                <div class="form-check fw-bold">
                    <input class="form-check-input" type="radio" name="usertype" id="adminRadio" value="admin">
                    <label class="form-check-label" for="adminRadio">
                        Admin
                    </label>
                </div>
                <div class="form-check fw-bold">
                    <input class="form-check-input" type="radio" name="usertype" id="customerRadio" value="customer">
                    <label class="form-check-label" for="customerRadio">
                        Customer
                    </label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control rounded-3" id="floatingInput" placeholder="Name">
                    <label for="name">Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="address" class="form-control rounded-3" id="floatingAddress" placeholder="Address">
                    <label for="address">Address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="phone" class="form-control rounded-3" id="floatingPhone" placeholder="Phone">
                    <label for="phone">Phone</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control rounded-3" id="floatingEmail" placeholder="Email">
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password">
                    <label for="password">Password</label>
                </div>
                <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit"  fdprocessedid="jmae6a">Sign Up</button>
                <small class="text-body-secondary">By clicking Sign up, you agree to the terms of use.</small>
                <hr class="my-4">
            </div>
        </form>
        
      </div>
  </div>
</div>


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
  function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
  }
  
  function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
  }

  function onClick(element) {
    document.getElementById("img01").src = element.src;
    document.getElementById("modal01").style.display = "block";
    var captionText = document.getElementById("caption");
    captionText.innerHTML = element.alt;
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>