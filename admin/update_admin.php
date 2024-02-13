
<!DOCTYPE html>
<html>
<head>
    <title>Update admin Record</title>
    <link rel="stylesheet" href="tyylit2.css">
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location: admin_sign.php');
    exit();
}

require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Fatal Connection Error");
}

// Function to sanitize user inputs
function get_post($conn, $var) {
    return $conn->real_escape_string($_POST[$var]);
}

if (isset($_POST['id'])) {
    $id = get_post($conn, 'id');
    $query = "SELECT * FROM admin WHERE id='$id'";
    $result = $conn->query($query);
    if (!$result) {
        echo "Error fetching data: " . $conn->error;
    } else {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $address = $row['address'];
        $phone = $row['phone'];
        $email = $row['email'];
        $password = $row['password'];
        $usertype = $row['usertype'];
    }
}

// Update admin record if 'Update' is submitted
if (isset($_POST['update']) && isset($_POST['id'])) {
    // Retrieve values from the form
    $name = get_post($conn, 'name');
    $address = get_post($conn, 'address');
    $phone = get_post($conn, 'phone');
    $email = get_post($conn, 'email');
    $password = get_post($conn, 'password');
    $usertype = get_post($conn, 'usertype');
    $id = get_post($conn, 'id');

    // Prepare and execute the UPDATE query using prepared statement
    $stmt = $conn->prepare("UPDATE admin SET name=?, address=?, phone=?, email=?, password=?, usertype=? WHERE id=?");
    $stmt->bind_param("ssssssi", $name, $address, $phone, $email, $password, $usertype, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully.<br><br>";
        header('location: admin.php');
    } else {
        echo "UPDATE failed: " . $conn->error . "<br><br>";
    }
} else {
    echo "No data to update.<br><br>";
}
?>
<form action="update_admin.php" method="post">
    <!-- Display the form with the retrieved data -->
    <pre>
        Name:     <input type="text" name="name" value="<?php echo $name ?? ''; ?>">
        Address:  <input type="text" name="address" value="<?php echo $address ?? ''; ?>">
        Phone:    <input type="text" name="phone" value="<?php echo $phone ?? ''; ?>">
        Email:    <input type="text" name="email" value="<?php echo $email ?? ''; ?>">
        Password: <input type="text" name="password" value="<?php echo $password ?? ''; ?>">
        Usertype: <input type="text" name="usertype" value="<?php echo $usertype ?? ''; ?>">
        <input type="hidden" name="id" value="<?php echo $id ?? ''; ?>">
        <input type="submit" name="update" value="Update">
    </pre>
</form>
</body>
</html>
