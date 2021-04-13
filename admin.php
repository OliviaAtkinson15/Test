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
    <script
            src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>
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
        <?php
        include("dbconnect.php");
        session_start();
        $email = $_SESSION['email'];

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

<h1 id="choosegroup">Choose a group to assess</h1><br>

<form id="group" action="" method="post">
    <label for="groups">Group number:</label>
<br>
    <select name="groups" id="groups">
<?php

$sql= $db->query("SELECT team_name FROM team_users WHERE NOT (team_name = 'admin') group by team_name");

$array2 = [];

while($row = mysqli_fetch_array($sql))
{
    $array2[] = $row;
}
?>
    <option selected disabled >Select...</option>;
<?php
foreach($array2 as $item){

?>
    <option value="<?php echo $item['team_name'] ?>"><?php echo $item['team_name'] ?></option>
    <?php
    }

    ?>
    </select>
    <br>
    <input id="groupsubmit" name="submit" type="submit">
</form>
<?php
if(isset($_POST['submit'])) {
    $groupname = $_POST['groups'];
    if ($groupname == "") {
        echo "Please choose the group to grade.";
} else {

        header('location: admin2.php');

    }
}
$_SESSION['gname'] = $groupname;
?>
</div>



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

