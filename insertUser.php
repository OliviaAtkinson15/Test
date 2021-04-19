<!--/**
 * Name: OLIVIA
 * StudentId: 
 * CourseCode: 
 * Course: Software Engineering Project
 * 
 */
/**
 * *
 *
 *
 *
 */-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create group</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jomhuria&family=Lobster&display=swap" rel="stylesheet">
</head>
<body>


<header class="container-fluid">
    <!-- Image and text -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="assets/collabo_logo.jpeg" width="30" height="30" class="d-inline-block align-center" alt="collaborations logo"><b class="logoName">
                Collaborations...</b></a>

        <ul class="nav justify-content-center">

            <li class="nav-item">
                <a class="nav-link disabled" href="Login.php">Log In</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="sign_up index.html">Sign up</a>
            </li>
        </ul>
    </nav>
</header>
<main class="container">

    <?php

    include("dbconnect.php");


    if (isset($_POST['register'])) { /* If the user clicked sign up then continue with this*/
        $email = $_POST["email"];
        $password = $_POST["password"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $teamname = $_POST["teamName"];
        $useremail1 = $_POST["email1"];
        $useremail2 = $_POST["email2"];
        $useremail3 = $_POST["email3"];
        $useremail4 = $_POST["email4"];

        $sql = "SELECT * FROM team_users WHERE (email_address= '$email')";
        $sql2 = "SELECT * FROM team_users WHERE team_name = '$teamname'";

        $res = mysqli_query($db, $sql);
        $res2 = mysqli_query($db, $sql2);

        if (mysqli_num_rows($res) > 0) {

            echo "an account with this email address already exists";

        }

        else if(mysqli_num_rows($res2) > 0) {

            echo "a team with this team name already exists";

        } else {
            //insert into database


            $insert = $db->query("INSERT INTO team_users (FirstName, LastName, email_address, password, team_name) VALUES ('$fname', '$lname', '$email', '$password','$teamname')");


            if ($useremail1 != NULL) {
                $insert1 = $db->query("INSERT INTO team_users (email_address, password, team_name) VALUES ('$useremail1', '$password', '$teamname')");
            }
            if ($useremail2 != NULL) {
                $insert2 = $db->query("INSERT INTO team_users (email_address, password, team_name) VALUES ('$useremail2', '$password','$teamname')");
            }
            if ($useremail3 != NULL) {
                $insert3 = $db->query("INSERT INTO team_users (email_address, password, team_name) VALUES ('$useremail3', '$password','$teamname')");
            }
            if ($useremail4 != NULL) {
                $insert4 = $db->query("INSERT INTO team_users (email_address, password, team_name) VALUES ('$useremail4', '$password','$teamname')");
            }
            if ($insert && $insert1) {
                echo "<h2>Group created successfully.</h2>";
            } else {
                echo "<h2>Unable to create group.</h2>";
            }
        }
    }


    // close connection to database
    $db->close();

    ?>
    <br><a href="Login.php" class="backtologin">Back to Login</a>
</main>

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

</body>
</html>