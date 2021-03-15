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
                <a class="nav-link " href="Login.php">Log In</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="sign_up index.html">Sign up</a>
            </li>
        </ul>
    </nav>
</header>
<main class="container">
    <form id="form" method="post">
        <h2>Enter Your Details</h2>
        <label for="Email">Your Email:</label><br>
        <input type="email" id="email" name="email" placeholder="@rgu.ac.uk" pattern=".+@rgu.ac.uk" required><br>
        <label for="fname">First Name:</label><br>
        <input type="text" id="fname" name="fname" required><br>
        <label for="lname">Last name:</label><br>
        <input type="text" id="lname" name="lname" required><br>
        <input type="submit" class="submit" name="submit" value="Submit">
</form>
<?php

include("dbconnect.php");

if (isset($_POST['submit'])) { /* If the user clicked login then continue with this */
    $email = $_POST["email"];
    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];

    $insert = $db->query ("UPDATE team_users SET FirstName='$firstname' WHERE email_address = '$email'");
    $insert2 = $db->query ("UPDATE team_users SET LastName='$lastname' WHERE email_address = '$email'");
    if ($insert && $insert2) {
        echo "<p>Details updated successfully.</p>";
        header("location: home.php"); // Redirecting To another Page
    } else {
        echo "<p>Unable to enter details.</p>";
        header("location: login.php"); // Redirecting To another Page
    }

}

session_start();
$_SESSION['fname'] = $firstname; /* Passing the email address to the next page */
$_SESSION['lname'] = $lastname; /* Passing the email address to the next page */

$insert->close();
// close connection to database
$db->close();
?>
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