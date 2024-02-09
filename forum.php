<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Fatal connection Error");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['delete'])) {
        $deleteId = $_POST['delete'];

        // Delete the message or reply directly
        $deleteQuery = "DELETE FROM messages WHERE id = ?";
        $stmtDelete = $conn->prepare($deleteQuery);
        $stmtDelete->bind_param("i", $deleteId);
        $resultDelete = $stmtDelete->execute();

        if (!$resultDelete) {
            echo "DELETE failed: " . $stmtDelete->error;
        } else {
            echo "<p>Message or reply deleted.</p>";
        }

        $stmtDelete->close();
    } else {
        $username = $_POST['username'];
        $message = $_POST['message'];

        // Validate that username and message are not empty
        if (empty($username) || empty($message)) {
            echo "Username and message cannot be empty.";
        } else {
            $timestamp = date('Y-m-d H:i:s');
            $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : 0;

            $query = "INSERT INTO messages (username, message, timestamp, parent_id) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssi", $username, $message, $timestamp, $parent_id);
            $result = $stmt->execute();

            if (!$result) {
                echo "INSERT failed: " . $stmt->error;
            } else {
                echo "<p>Message posted.</p>";
            }

            $stmt->close();
        }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="tyylit.css">
    <title>KuvaKantele</title>
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: "Poppins", sans-serif
        }

        body {
            font-size: 16px;
        }

        .w3-half img {
            margin-bottom: -6px;
            margin-top: 16px;
            opacity: 0.8;
            cursor: pointer
        }

        .w3-half img:hover {
            opacity: 1
        }

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
        <svg xmlns="http://www.w3.org/2000/svg" width="102" height="102" fill="currentColor" class="bi bi-camera"
            viewBox="0 0 16 16">
            <path
                d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z" />
            <path
                d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
        </svg>
        <h1><b>KuvaKantele Photography</b></h1>
    </div>

    <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
        <!-- The Grid -->
        <div class="w3-row">
            <!-- Left Column -->
            <div class="w3-col m3">
                <div class="col- col- menu">
                    <ul>
                        <li><a href="home.php" onclick="w3_close()"><i
                                    class="fa fa-th-large fa-fw w3-margin-right"></i>Etusivu</a></li>
                        <li><a href="about.php" onclick="w3_close()"><i
                                    class="fa fa-user fa-fw w3-margin-right"></i>About</a></li>
                        <li><a href="packages.php" onclick="w3_close()"><i
                                    class="fa fa-suitcase fa-fw w3-margin-right"></i>Packages</a></li>
                        <li><a href="contact.php" onclick="w3_close()"><i
                                    class="fa fa-envelope fa-fw w3-margin-right"></i>Contact</a></li>
                        <li><a href="forum.php" onclick="w3_close()"><i
                                    class="fa fa-envelope fa-fw w3-margin-right"></i>Forum</a></li>
                    </ul>
                    <div class="aside">
                        <div class="w3-card w3-round w3-white">
                            <div class="w3-container">
                                <h4 class="w3-center"><?php echo $name; ?></h4>
                                <p class="w3-center"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100"
                                        fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                                        <path
                                            d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5" />
                                        <path
                                            d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                    </svg></p>
                                <hr>
                                <p><i class="fa fa-envelope fa-fw w3-margin-right w3-text-theme"></i>
                                    <?php echo $email; ?></p>
                                <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i><?php echo $address; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Middle Column -->
            <div class="w3-col m7">
                <div class="w3-row-padding">
                    <div class="w3-col m12">
                        <!-- Ask a Question Form -->
                        <div class="w3-card w3-round w3-white">
                            <div class="w3-container w3-padding">
                                <h4>Ask a Question</h4>
                                <form action="forum.php" method="post">
                                    <label for="username">Username:</label>
                                    <input class="w3-border w3-padding" type="text" name="username"><br>
                                    <label for="message">Question:</label>
                                    <textarea name="message"></textarea>
                                    <button type="submit" class="w3-button w3-theme"><i
                                            class="fa fa-pencil"></i> Post</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $query = "SELECT id, username, message, timestamp FROM messages WHERE is_deleted = 0 AND parent_id = 0 ORDER BY timestamp DESC";
                $result = $conn->query($query);
                
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $questionId = $row['id'];
                        $username = $row['username'];
                        $message = $row['message'];
                        $timestamp = $row['timestamp'];
                
                        // Display the question
                        echo "<div class='w3-container w3-card w3-white w3-round w3-margin'>";
                        echo "<h4>$username <span>$timestamp</span></h4>";
                        echo "<p>$message</p>";
                
                        // Add a delete button for the question
                        echo "<form action='forum.php' method='post'>";
                        echo "<input type='hidden' name='delete' value='$questionId'>";
                        echo "<button type='submit' class='w3-button w3-theme w3-margin-bottom'><i class='fa fa-trash'></i> Delete</button>";
                        echo "</form>";
                
                        // Add a reply form for each question
                        echo "<form action='forum.php' method='post'>";
                        echo "<input type='hidden' name='parent_id' value='$questionId'>";
                        echo "<label for='username'>Your Username:</label>";
                        echo "<input class='w3-border w3-padding' type='text' name='username'><br>";
                        echo "<label for='message'>Your Reply:</label>";
                        echo "<textarea name='message'></textarea>";
                        echo "<button type='submit' class='w3-button w3-theme'><i class='fa fa-reply'></i> Reply</button>";
                        echo "</form>";
                
                        // Fetch and display replies for each question
                        $replyQuery = "SELECT id, username, message, timestamp FROM messages WHERE parent_id = $questionId AND is_deleted = 0 ORDER BY timestamp DESC";
                        $replyResult = $conn->query($replyQuery);
                
                        if ($replyResult) {
                            while ($replyRow = $replyResult->fetch_assoc()) {
                                $replyId = $replyRow['id'];
                                $replyUsername = $replyRow['username'];
                                $replyMessage = $replyRow['message'];
                                $replyTimestamp = $replyRow['timestamp'];
                
                                echo "<div class='w3-container w3-card w3-white w3-round w3-margin'>";
                                echo "<h5>$replyUsername <span class='w3-opacity'>$replyTimestamp</span></h5>";
                                echo "<p>$replyMessage</p>";
                
                                // Add a delete button for the reply
                                echo "<form action='forum.php' method='post'>";
                                echo "<input type='hidden' name='delete' value='$replyId'>";
                                echo "<button type='submit' class='w3-button w3-theme'><i class='fa fa-trash'></i> Delete</button>";
                                echo "</form>";
                
                                echo "</div>";
                            }
                
                            $replyResult->free_result();
                        }
                
                        echo "</div>";
                    }
                
                    $result->free_result();
                }
                ?>

            </div>

            <!-- Right Column -->
            <div class="w3-col m2">
                <div class="w3-card w3-round w3-white w3-center">
                    <div class="w3-container">
                        <p>Upcoming Events:</p>
                        <img src="./kuva/IMG20230503135440.jpg" alt="Forest" style="width:100%;">
                        <p><strong>Holiday</strong></p>
                        <p>Friday 15:00</p>
                        <p><button class="w3-button w3-block w3-theme-l4">Info</button></p>
                    </div>
                </div>
                <br>

                <div class="w3-card w3-round w3-white w3-center">
                    <div class="w3-container">
                        <p>Friend Request</p>
                        <img src="/w3images/avatar6.png" alt="Avatar" style="width:50%"><br>
                        <span>Jane Doe</span>
                        <div class="w3-row w3-opacity">
                            <div class="w3-half">
                                <button class="w3-button w3-block w3-green w3-section" title="Accept"><i
                                        class="fa fa-check"></i></button>
                            </div>
                            <div class="w3-half">
                                <button class="w3-button w3-block w3-red w3-section" title="Decline"><i
                                        class="fa fa-remove"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="w3-container w3-theme-d3 w3-padding-16">
        <h5>Footer</h5>
    </footer>

    <footer class="w3-container w3-theme-d5">
        <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
    </footer>

    <!-- END MAIN -->
    </div>
</body>
</html>