<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Fatal connection Error");
}

// Handle customer deletion
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $id = get_post($conn, 'id');
    $query = "DELETE FROM customers WHERE id='$id'";
    $result = $conn->query($query);
    if (!$result) {
        echo "DELETE failed<br><br>";
    }
}

// Display customers
$query = "SELECT * FROM customers";
$result = $conn->query($query);
if (!$result) {
    die("Database access failed");
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <!-- Include Bootstrap CSS (modify as needed) -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy6mL5mdIMYy9PiERkF5eg9DlNG9FEx8" crossorigin="anonymous">
</head>
<body>
<header>
    <div class="px-3 py-2 text-bg-dark border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
              <a href="#" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi d-block mx-auto mb-1" width="50" height="50" viewBox="0 0 16 16" viewBox="0 0 16 16">
                    <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z"/>
                    <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                  </svg>
              </a>
    
              <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                <li>
                  <a href="#" class="nav-link text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi d-block mx-auto mb-1" width="24" height="24" viewBox="0 0 16 16">
                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 1 1-1 0v-1h-1a.5.5 0 1 1 0-1h1v-1a.5.5 0 0 1 1 0"/>
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
                        <path d="m8 3.293 4.712 4.712A4.5 4.5 0 0 0 8.758 15H3.5A1.5 1.5 0 0 1 2 13.5V9.293z"/>
                      </svg>
                    Home
                  </a>
                </li>
                <li>
                  <a href="#" class="nav-link text-white">
                    <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi d-block mx-auto mb-1" width="24" height="24" viewBox="0 0 16 16" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.39.39 0 0 0-.029-.518z"/>
                        <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A8 8 0 0 1 0 10m8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3"/>
                      </svg>
                    Dashboard
                  </a>
                </li>
                <li>
                  <a href="#" class="nav-link text-white">
                    <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi d-block mx-auto mb-1" width="24" height="24" viewBox="0 0 16 16" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                        <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                      </svg>
                    Posts
                  </a>
                </li>
                <li>
                  <a href="#" class="nav-link text-white">
                    <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi d-block mx-auto mb-1" width="24" height="24" viewBox="0 0 16 16" viewBox="0 0 16 16" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                      </svg>
                    Customers
                  </a>
                </li>
              </ul>
            </div>
        </div>
        </div>
        <div class="px-3 py-2 border-bottom mb-3">
          <div class="container d-flex flex-wrap justify-content-center">
            <form class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto" role="search">
              <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
            </form>
    
            <div class="text-end">
              <button type="button" class="btn btn-light text-dark me-2">Login</button>
              <button type="button" class="btn btn-primary">Sign-up</button>
            </div>
        </div>
    </div>
</header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
</nav>

<div class="container mt-4">
    <h2>Customer Details</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>User Type</th>
                <th width="15%">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?php echo $customer['id']; ?></td>
                    <td><?php echo $customer['name']; ?></td>
                    <td><?php echo $customer['address']; ?></td>
                    <td><?php echo $customer['phone']; ?></td>
                    <td><?php echo $customer['email']; ?></td>
                    <td><?php echo $customer['usertype']; ?></td>
                    <td>
                        <a href="edit_customer.php?customer_id=<?php echo $customer['id']; ?>&operation=edit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a href="#" class="btn btn-danger delete_btn" data-toggle="modal" data-target="#confirm-delete-<?php echo $customer['id']; ?>"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                        <form action="home.php" method="post" class="d-inline-block me-3">';
                        echo '<input type="hidden" name="delete" value="yes">';
                        echo '<input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">';
                        echo '<input class="delete-btn btn btn-lg btn-link fs-6 text-decoration-none rounded-0 border-end" fdprocessedid="2ld1d4"" type="submit" value="DELETE RECORD">';
                        echo '</form>';
                        echo '<form action="update.php" method="post" class="d-inline-block">';
                        echo '<input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">';
                        echo '<input class="update-btn btn btn-lg btn-link fs-6 text-decoration-none rounded-0 border-end" fdprocessedid="2ld1d4"" type="submit" value="UPDATE">';
                        echo '</form>'
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>



<div class="container mt-4">
    <h2>Messages</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Message</th>
                <th>Timestamp</th>
                <th>Parent ID</th>
                <th>Is Deleted</th>
                <th width="15%">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message): ?>
                <tr>
                    <td><?php echo $message['id']; ?></td>
                    <td><?php echo $message['username']; ?></td>
                    <td><?php echo $message['message']; ?></td>
                    <td><?php echo $message['timestamp']; ?></td>
                    <td><?php echo $message['parent_id']; ?></td>
                    <td><?php echo $message['is_deleted']; ?></td>
                    <td>
                        <a href="edit_message.php?message_id=<?php echo $message['id']; ?>&operation=edit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a href="#" class="btn btn-danger delete_btn" data-toggle="modal" data-target="#confirm-delete-<?php echo $message['id']; ?>"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                        <pre>
        Username:   <input type="text" name="username" value="<?php echo $username ?? ''; ?>" readonly>
        Message:    <textarea name="message" readonly><?php echo $message ?? ''; ?></textarea>
        Timestamp:  <input type="text" name="timestamp" value="<?php echo $timestamp ?? ''; ?>" readonly>
        Parent ID:   <input type="text" name="parent_id" value="<?php echo $parent_id ?? ''; ?>" readonly>
        Is Deleted: <input type="text" name="is_deleted" value="<?php echo $is_deleted ?? ''; ?>" readonly>
        <input type="hidden" name="id" value="<?php echo $id ?? ''; ?>">
        <input type="submit" name="delete" value="Delete">
    </pre>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Delete Confirmation Modal for Messages -->

 </tbody>
</table>
</div>

<!-- Include Bootstrap JS (modify as needed) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js" integrity="sha384-ue8NOyZAKzISz2xg9aAiAdAXFOWR2faoBOBEUHiJzZGAlFzJTkGRM/J3YbgtjIf0" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy6mL5mdIMYy9PiERkF5eg9DlNG9FEx8" crossorigin="anonymous"></script>
</body>
</html>
