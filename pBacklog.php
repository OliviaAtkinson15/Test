<!--/**
 * Name: ILOANUGO ONYINYE
 * StudentId: 2009808
 * CourseCode: CMM 004
 * Course: Software Engineering Project
 *
 */
/**
 * * Backlog refinement page
 * This page refines the backlog items
 * Views the backlog items
 * And Deletes the backlog itmens individually
 */-->


<?PHP
include("dbconnect.php");


?>
<?php
session_start();
//$team = $_SESSION['team'];
//echo $team;

if (!isset($_SESSION['user'])){
    header("Location:login.php");

}
//echo $_SESSION['use'];
//echo '  login successful';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Backlog</title>
    <link rel="stylesheet" href="pBacklog.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jomhuria&family=Lobster&display=swap" rel="stylesheet">

</head>

<header>
    <!-- Image and text -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="assets/collabo_logo.jpeg" width="30" height="30" class="d-inline-block align-center" alt="collaborations logo"><b class="logoName">
                Collaborations...</b></a>
        <?php
        $email = $_SESSION['user'];
        echo "<h5>HELLO $email</h5>";
        ?>

        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="userTest.php">My Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="team_page.php">Team Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="pBacklog.php">Product Backlog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="try.php">Sprint Planning</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Daily Sprint</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Chat.php">Sprint Retrospective</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Logout</a>
            </li>

        </ul>
    </nav>



</header>

<main class="container">

    <div class="row">

        <div class="col-md-4 col-sm-12">

            <?php
            include ("viewPB.php");
            ?>
            <?php
            // send details to sql


            $message = "";

            if(isset($_POST["save"])){
                //if user clicked enter continue

                /*
                                //check if any data is empty
                                if(empty($_POST["bitem"]) || empty($_POST["userstory"]) || empty($_POST["criteria"]) || empty($_POST["effort"]))
                                {  //echo a code
                                    echo "enter a task first";
                                    //header('Location: signUp.php?signup=empty');
                                    //exit();
                                }else
                                { *///asign a variable to the input
                $pitem = $_POST["bitem"];
                $userstory = $_POST["userstory"];
                $criteria = $_POST["criteria"];
                $effort = $_POST["effort"];




                //check if task exist
                $sql=mysqli_query($db,"SELECT * FROM product_backlog where (product_item='$pitem')");

                //$res=mysqli_query($db,$sql);

                if (mysqli_num_rows($sql) > 0) {

                    $row = mysqli_fetch_assoc($sql);
                    //if($pitem==isset($row['bitem']))
                    //{
                    //echo "this task exist";
                    //header('Location: signUp.php?signup=email');
                    //exit();




                    //update the database
                    $sql1 = "UPDATE product_backlog SET product_task = '$userstory', criteria = '$criteria', effort= '$effort' WHERE product_item = '$pitem'";

                    if ($db->query($sql1) === TRUE) {
                        //header("location: login.php?signup=success");
                        //exit();
                        //header("Location: pBacklog.php");
                        $message= "New record UPDATED successfully";
                    } else {
                        $message= "Error: " . $sql1 . "<br>" . $db->error;
                        //header('Location: signUp.php?signup=failed');
                        //exit();
                    }

                    //$db->close();
                }else{
                    $message= "Product Backlog does not exist";
                }



            } //$res->close();
            ?>

        </div>

        <div class="col-md-4 col-sm-12" id="scroll">
            <form action="" method="POST">
                <div class="card">
                    <?php
                    print "<p>$message</p>";
                    ?>

                    <p class="backlogItem"><Label>Product Backlog Item</Label><br><input type="text" name="bitem" id="bitem" placeholder="login page "required></p>
                    <p class="userStory"><p><label for="">User story</label></p><textarea name="userstory" id="userstory" cols="20" rows="10" placeholder="as a user, i want to be able to log into the sytem using my credential" required></textarea></p>
                    <p class="criteria"><label for="">Acceptance Criteria</label><textarea  name = "criteria" id="criteria" cols="30" rows="10" placeholder="1.input a valid credential to the login boxes, the user should see a home page with user name displayed  2.input an invalid credentail the user should be refused entry and sent back to login page" required></textarea></p><br>
                    <p class="effort"><label for="">Effort</label><br><input type="text" name="effort" id="effort" placeholder="S,M,L,XL" required></p><br>
                    <input type="submit" name="save" id="save" value="Update PBI">
                </div>

            </form>
        </div>






        <div class="col-md-4 col-sm-12">

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
                    print "<a href='delete.php?id=".$row['product_backlog_id']."' class='button'>DELETE</a>";

                    print "</div>";
                    print "</div><br>";

                }// end while loop





            }


            $result->close();
            ?>

        </div>
        </form>
    </div>
    </div>
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


<body>

</body>
</html>