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
<h1>Login</h1>
<form method="post">

    <label for="Email">Your Email:</label><br>
    <input type="email" id="email" name="email" placeholder="@rgu.ac.uk" pattern=".+@rgu.ac.uk" required><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br>
    <input type="submit" id="login" name="Login" value="Login"><br>
    <a href="sign_up index.html">Create a Group</a><br>
    <a href="password.php">Forgotten password?</a>
</form>
<?php

include("dbconnect.php");

if (isset($_POST['Login'])) { /* If the user clicked login then continue with this */

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT FirstName FROM team_users WHERE email_address='$email' and password='$password'";

    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if(isset($row['FirstName'])) {
            header("location: home.php"); // Redirecting To another Page
        } else {
            header("location: EnteringName.php"); // Redirecting To another Page
        }
    }
            else {
            echo "<p>Email or password not recognised.</p>";
        }

}

session_start();
$_SESSION['email'] = $email;


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