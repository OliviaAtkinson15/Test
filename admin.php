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
<div id="groupnames"
<h3>Choose a group to assess</h3><br>

<label for="groups">Group name:</label>

<select name="groups" id="groups">
<?php



$sql= $db->query("SELECT team_name FROM team_users WHERE NOT (team_name = 'admin') group by team_name");

$array = [];
while($row = mysqli_fetch_array($sql))
{
    $array[] = $row;
}

foreach($array as $item){

?>
    <option value="<?php echo $item['team_name'] ?>"><?php echo $item['team_name'] ?></option>
    <?php
    }
if(isset($_POST['groups']) )
{
    $group = $_POST['groups'];
    $errorMessage = "";
}
if(!isset($_POST['groups']))
{
    $errorMessage .= "<li>Please select a group</li>";
}
    ?>
    </select>
<ul>
    <li>Product Backlog<a href="pBacklog2.php"></li>
    <li>Sprint Planning<a href="sprintBacklog2.php"></li>
    <li>Sprint Review<a href="sprintReview"></li>
    <li>Sprint Retrospective<a href="Retrospective2.php"></li>
</ul>
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

