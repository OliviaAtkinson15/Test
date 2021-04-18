<!--/**
 * Name: ILOANUGO ONYINYR
 * StudentId: 2009808
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
                <a class="nav-link" href="admin.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Logout</a>
            </li>

        </ul>
    </nav>
</header>
<?php echo "<h1 id='groupnames'>Group: $gname</h1>"?>
<a href="admin2.php"><img src="assets/arrow.png" width="40" height="40" class="return" alt="return"></a>


<body>



<main class="container">

    <div class="col-md-4 col-sm-12" id="scroll">

        <?PHP
        //view pbi's
        //$view = $_GET["view"];


        //$result = mysqli_query($db, $sql); //execute SQL query
        $result = $db->query("SELECT * FROM product_backlog");
        //print "<div class='card'>\n";
        //print "<h2 class='backlogItem'></h2>";
        //print "<p class='userStory'></p>";
        //print "<h4 class='criteria'></h4>";
        //print "<h4 class='effort'></h4>";

        //fetch the result
        //check
        $resultCheck = mysqli_num_rows($result);
        print "<h3 class='PBIheader'>Product Backlog Items</h3>";
        if($resultCheck > 0) {

            while($row = mysqli_fetch_assoc($result)){
                $pbi= $row['product_item'];
                print "<div class=''>";
                print "<div class='card'>";
                //print "<p><input type=hidden name=id value=<?php echo $row['product_backlog_id']; ?//>><p>";
                print "<h3 class='bitem'>".$pbi."</h3>";
                print "<p class='userstory'> '<em>".$row['product_task']."</em> '</p>";
                print "<p class='criteria'><b>Acceptance Criteria:</b> ".$row['criteria']."</p>";
                print "<p class='effort'>".$row['effort']."</p>";

                print "</div>";
                print "</div><br>";

            }// end while loop





        }


        $result->close();
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




