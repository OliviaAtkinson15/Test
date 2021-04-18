<!--/**
 * Name: OLIVIA
 * StudentId: 1305999
 * CourseCode: CMM004
 * Course: Software Engineering Project
 * 
 */


/**
 * * CHAT SCRIPT
 * 
 * 
 * -->



<?php
include ("dbconnect.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprint Retrospective</title>
    <link rel="stylesheet" href="pBacklog.css">
    <link rel="stylesheet" href="style.css">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jomhuria&family=Lobster&display=swap" rel="stylesheet">

</head>

<body>

<header>
    <!-- Image and text -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="assets/collabo_logo.jpeg" width="30" height="30" class="d-inline-block align-center" alt="collaborations logo"><b class="logoName">
                Collaborations...</b></a>
        <?php
        session_start();
        $email = $_SESSION['user'];
        echo "<h5>Hello $email</h5>";
        ?>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="userPage.php">My Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="team_page.php">Team Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pBacklog.php">Product Backlog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="sprint_planning.php">Sprint Planning</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="Chat.php">Chat</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Logout</a>
            </li>

        </ul>
    </nav>






</header>

<body>



<main class="container">
    <h3 id="discussion">Sprint Retrospective</h3>
<div id="chat">

<div id="content">

<?php
include("dbconnect.php");


$sql_query = "SELECT * FROM chat ORDER BY date_time DESC";
$result = $db-> query($sql_query);

// File upload path
$targetDir = "/Applications/MAMP/htdocs/Test/";
$fileName = basename($_FILES["image"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);



while($row = $result ->fetch_array()) {
    $text = $row ['text'];
    $date_time = $row ['date_time'];
    $user = $row ['user'];


        if (!empty($row["image"])) {
            Print '<div id="box"><h6 id="username">' . $user . '</h6><h6 id="time">' . $date_time . '</h6><p>' . $text . '</p><img src="' . $row["image"] . '" style="width:150px;"></div><br>';
        } else {
            Print '<div id="box"><h6 id="username">' . $user . '</h6><h6 id="time">' . $date_time . '</h6><p>' . $text . '</p></div><br>';
        }

}

?>
</div>
</div>
    <div class="newchat">

        <form id="newchat" method="post" enctype="multipart/form-data">
            <h5>Reply</h5>
        <TEXTAREA id="text" name="text" rows="3" cols="64" placeholder="..."></TEXTAREA><br>
        <input id="file" type="file" name="image">
        <input type="submit" id="send" name="send" value="send"><br>
            <?php

            if (isset($_POST['send'])) { /* If the user clicked login then continue with this */

                // $email = $_POST["email"];
                $text = $_POST["text"];


                    if (!empty($_FILES["image"]["name"])) {
                        $allowTypes = array('jpg', 'png', 'jpeg');
                        if (in_array($fileType, $allowTypes)) {
                            // Upload file to server
                            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                                // Insert image file name into database
                                $insert = $db->query("INSERT into chat (user, text, image) VALUES ('$email', '$text', '$fileName')");

                                if ($insert) {
                                    header("Refresh:0");
                                } else {
                                    echo "Unable to send message.";
                                }
                            } else {
                                echo "Error uploading your file.";
                            }
                        } else {
                            echo 'Sorry, only JPG, JPEG or PNG files are allowed to upload.';
                        }

                    } else {
                        $insert = $db->query("INSERT INTO chat (user, text) VALUES ('$email', '$text')");
                        if ($insert) {
                            header("Refresh:0");
                        } else {
                            echo "Unable to send message.";
                        }
                    }

            }
            ?>
        </form>
    </div>

</main>

<?php
$db->close();

?>

<footer class="container-fluid">
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link active" href="#">copyright &copy; collaborations...</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"></a>
        </li>
    </ul>

</footer>
<body>
</body>
</html>