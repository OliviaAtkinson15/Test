<!--/**
 * Name: OLIVIA ATKINSON
 * StudentId: 1305999
 * CourseCode: CMM 004
 * Course: Software Engineering Project
 *
 */


/** A TEMPORARY USER HOME PAGE
 * *
 * A USER CAN NAVIGATE TO THE TEAM PAGE FROM HERE.
 *
 *
 */-->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jomhuria&family=Lobster&display=swap" rel="stylesheet">
</head>



<header class="container-fluid">
    <!-- Image and text -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="assets/collabo_logo.jpeg" width="30" height="30" class="d-inline-block align-center" alt="collaborations logo"><b class="logoName">
                Collaborations...</b></a>
        <?php
        include("dbconnect.php");
        session_start();
        $email = $_SESSION['email'];
        $gname = $_SESSION['gname'];
        echo "<h5>$email</h5>";
        ?>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link disabled" href="admin.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Logout</a>
            </li>

        </ul>
    </nav>
</header>
<?php echo "<h1>Group: $gname</h1>"?>


<body>



<main class="container">
    <a href="admin2.php">Return</a>
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