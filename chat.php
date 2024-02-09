<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Fatal connection Error");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $message = $_POST['message'];
    $timestamp = date('Y-m-d H:i:s');
    $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : 0;

    $query = "INSERT INTO messages (username, message, timestamp, parent_id) VALUES ('$username', '$message', '$timestamp', '$parent_id')";
    $result = $conn->query($query);

    if (!$result) {
        echo "INSERT failed: " . $conn->error;
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = "UPDATE messages SET is_deleted = 1 WHERE id = $delete_id";
    $result_delete = $conn->query($delete_query);

    if (!$result_delete) {
        echo "DELETE failed: " . $conn->error;
    } else {
        echo "<p>Message deleted. <a href='chat.php?undo=$delete_id'>Undo</a></p>";
    }
}

if (isset($_GET['undo'])) {
    $undo_id = $_GET['undo'];
    $undo_query = "UPDATE messages SET is_deleted = 0 WHERE id = $undo_id";
    $result_undo = $conn->query($undo_query);

    if (!$result_undo) {
        echo "UNDO failed: " . $conn->error;
    } else {
        echo "<p>Message restored.</p>";
    }
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <title>Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDS$
    <style>
        .chat-container {
            max-width: 40%;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        input[type="text"],
        textarea {
            width: 30%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100px;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            box-sizing: border-box;
        }
        .message {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .message-container {
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .user-message {
            background-color: #cceeff;
        }
        .librarian-reply {
            background-color: #ffcc99;
        }
        .message-info {
            font-size: 14px;
            color: #666;
        }
        .delete-link {
            color: red;
            text-decoration: none;
            margin-left: 10px;
        }
        .delete-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body style="isolation: isolate;">

<div class="container py-3">
<div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="availablebook.php">kirjalisraus</a>
                <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="borrow.php">Laitteiden Lainaus</a>
                <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="wishlist.php">Wish List</a>

                <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="chat.php">Chat</a>
                <a class="py-2 link-body-emphasis text-decoration-none" href="logout.php">Logout</a>
            </nav>

        </div>

        <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
            <h1 class="display-4 fw-normal text-body-emphasis">Tervetuloa Kyläkirjastoon</h1>
            <p class="fs-5 text-body-secondary">Täällä voit keskustella kirjaston henkilökunnan kanssa avun saamiseksi.</p>
        </div>

        <form action="forum.php" method="post">
        <pre>
            Username: <input type="text" name="username">
            Message: <textarea name="message"></textarea>
            <input type="submit" value="Send">
        </pre>
    </form>

    <?php
    $query = "SELECT * FROM messages WHERE is_deleted = 0 ORDER BY timestamp DESC";
    $result = $conn->query($query);


   
        $query = "SELECT * FROM messages WHERE is_deleted = 0 ORDER BY timestamp DESC";
        $result = $conn->query($query);

        if (!$result) {
            die("Database access failed: " . $conn->error);
        }

        while ($row = $result->fetch_assoc()) {
            $id = htmlspecialchars($row['id']);
            $username = htmlspecialchars($row['username']);
            $message = htmlspecialchars($row['message']);
            $timestamp = htmlspecialchars($row['timestamp']);
            $reply = htmlspecialchars($row['reply']);

            echo "<div class='message-container";
            if (empty($reply)) {
                echo " user-message'>";
            } else {
                echo " librarian-reply'>";
            }

            echo "<p><strong>Your name:</strong> $username</p>";
            echo "<p><strong>Message:</strong> $message</p>";
            echo "<p class='message-info'><strong>Timestamp:</strong> $timestamp</p>";

            if (!empty($reply)) {
                echo "<p><strong>Librarian's Reply:</strong> $reply</p>";
            }

            echo "<a class='delete-link' href='chat.php?delete=$id'>Delete</a>";
            echo "</div>";
        }

        $result->free_result();
        $conn->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/$
    </body>
</html>