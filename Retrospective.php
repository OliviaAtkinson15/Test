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
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jomhuria&family=Lobster&display=swap" rel="stylesheet">
</head>
<body>


<header class="container-fluid">
    <!--Image and text -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="assets/collabo_logo.jpeg" width="30" height="30" class="d-inline-block align-center" alt="collaborations logo"><b class="logoName">
                Collaborations...</b></a>
        <?php
        session_start(); /* To pass information between pages */
        $email = $_SESSION['email'];
        echo "<h5>$email</h5>";
        ?>

        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="my_page.php">My Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="team_page.php">Team Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pBacklog.php">Product Backlog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Sprint Planning</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Daily Sprint</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="Retrospective.php">Sprint Retrospective</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Chat.php">Chat</a>
            </li>
        </ul>
    </nav>
</header>



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