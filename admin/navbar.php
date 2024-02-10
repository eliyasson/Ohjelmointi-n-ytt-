<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy6mL5mdIMYy9PiERkF5eg9DlNG9FEx8" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

  <!-- Your custom styles, if any -->
  <style>
    /* Add your custom styles here */
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #82a0ad;">
  <a class="navbar-brand" href="#">Admin Dashboard</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../index.php" target="_blank">Visit Website</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add_banner.php">Add Banner</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add_service.php">Add Services</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="guest_message.php">
          Guest Message
          <?php
            require_once 'login.php';
            $get_total_message_query = "SELECT COUNT(*) AS total_unread_message FROM messages WHERE read_status = 1";
            $total_message_from_db = mysqli_query($db_connect, $get_total_message_query);
            $after_assoc = mysqli_fetch_assoc($total_message_from_db);
          ?>
          <span class="badge badge-danger">
            <?php
              echo $after_assoc['total_unread_message'];
            ?>
          </span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="profile.php">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="change_password.php">Change Password</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php"><span class="text-danger">Logout</span></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<!-- Main content goes here -->
<div class="container">
  <!-- Add your dashboard content here -->
</div>

<!-- Footer -->
<footer class="footer mt-auto py-3 bg-light">
  <div class="container text-center">
    <span class="text-muted">Your Company &copy; 2022</span>
  </div>
</footer>

<!-- Bootstrap JS, Popper.js, and jQuery (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js" integrity="sha384-ue8NOyZAKzISz2xg9aAiAdAXFOWR2faoBOBEUHiJzZGAlFzJTkGRM/J3YbgtjIf0" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy6mL5mdIMYy9PiERkF5eg9DlNG9FEx8" crossorigin="anonymous"></script>

<!-- Your custom scripts, if any -->
<script>
  // Add your custom scripts here
</script>

</body>
</html>
