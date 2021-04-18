<!--/**
 * Name: ILOANUGO ONYINYE
 * StudentId: 2009808
 * CourseCode: CMM 004
 * Course: Software Engineering Project
 *
 */
/**  THE TEAM PAGE
 * * shows names of all team members
 * product backlog items are collected here
 * product backlog can be viewd here too
 *
 */-->

<?php
/*session_start();
//$team = $_SESSION['team'];
//echo $team;

if (!isset($_SESSION['user'])){
    header("Location:login.php");

}
//echo $_SESSION['use'];
//echo '  login successful';
*/?>



<?php
include ("dbconnect.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Page</title>
    <link rel="stylesheet" href="pBacklog.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/style.css">

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
        <!--Added a session with name (23/3/21)-->
        <?php
        $email = $_SESSION['user'];
        echo "<h1>Hello $email</h1>";
        ?>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="userPage.php">My Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="team_page.php">Team Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pBacklog.php">Product Backlog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="try.php">Sprint Planning</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Chat.php">Chat</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Logout</a>
            </li>

        </ul>
    </nav>






</header>

<main>

    <div class= "column">



        <?php
        $sql = "SELECT * FROM team_users WHERE team_name = 'c'";

        $result = mysqli_query($db, $sql); //execute SQL query

        $resultCheck = mysqli_num_rows($result);


        if($resultCheck > 0) {
            while($row = mysqli_fetch_assoc($result)){
                print "<div class=column>";
                print "<div class='card'>";
                print "<img src='assets/collabo_logo.jpeg' width='30' height='30' class='d-inline-block align-center' alt='collaborations logo'>";
                print "<h2>".$row['FirstName']."</h2>";
                print "<p>".$row['email_address']."</p>";
                print "</div>";
                print "</div>";
            }
        }
        $result->close();
        //$db->close();
        ?>

    </div>

    <!-- enter product backlogs-->
    <div class="row">
        <div class="col">
            <form action="" method="POST" id="teamform">
                <label for="">Enter your Product Backlogs: </label><br>
                <input type="text" name="bitem" id="bitem"><br>
                <input type="submit" name="enter" id="enter" value="ENTER"><br>




                <?php
                //save product backlogs to the database
                if(isset($_POST["enter"])){
                    //if user clicked enter



                    //check if any data is entered
                    if(empty($_POST["bitem"]))
                    {  //echo a code
                        echo "enter a product backlog item first";
                        //header('Location: signUp.php?signup=empty');
                        //exit();
                    }else
                    { //asign a variable to the input
                        $pitem = $_POST["bitem"];



                        //check if task exist
                        $sql="SELECT * FROM product_backlog where (product_item='$pitem')";

                        $res=mysqli_query($db,$sql);

                        if (mysqli_num_rows($res) > 0) {
                            echo "THIS TASK EXISTS";

                            $row = mysqli_fetch_assoc($res);

                            if($pitem==isset($row['bitem']))
                            {
                                echo "This task exist";
                                //header('Location: signUp.php?signup=email');
                                //exit();
                            }
                        }

                        else{

                            //insert to the database
                            $sql1 = "INSERT INTO product_backlog (product_item) VALUES ('$pitem')";


                            if ($db->query($sql1) != TRUE) {
                                echo "Error: " . $sql1 . "<br>" . $db->error;
                                //header('Location: signUp.php?signup=failed');
                                //exit();
                            } else {

                            }


                        }



                    }
                } //$res->close();
                ?>
            </form>
        </div>
        <!-- view product backogs -->
        <div class="col">
            <?php
            include ("viewPB.php");
            ?>


        </div>
        <!--chat box-->


    </div>
    <div id="uploads">
    <div id="upload">
    <form method="post" enctype="multipart/form-data" id="upload_form">

        <h5> Upload a File </h5><br>

        <input type="file" name="file" id="file_button"<br><br>
        <br><input type="submit" name="submit" id="submit_button"> <br><br>

    </form>

    <!-- PHP Code Start -->
    <?php


    $statusMsg = '';

    //File upload path
    $targetDir = "/Applications/MAMP/htdocs/Test/uploads/";

    if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        //Allow PDF, JPEG, DOCX, PPT, XLSX and mp4 files
        $allowTypes = array('pdf', 'jpeg', 'docx', 'ppt', 'xlsx', 'mp4', 'jpg', 'png');

        if (in_array($fileType, $allowTypes)) {
            //Upload file to server

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {

                $sql = "SELECT * FROM uploads WHERE (file_name = '$fileName')";
                $res = mysqli_query($db, $sql);

                if (mysqli_num_rows($res) > 0) {

                    $statusMsg = "Sorry, this file already exists";

                } else {

                    // Insert file into db
                    $insert = $db->query("INSERT INTO uploads (file_name, uploaded_on) VALUES ('$fileName', NOW())");

                    //Status message saying that the file has been uploaded succesfully
                    if ($insert) {
                        $statusMsg = "The file " . $fileName . " has been uploaded successfully";

                    } else {
                        // Status message saying unable to upload the file
                        $statusMsg = "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }
        else {
            echo 'Sorry, only pdf, jpeg, docx, ppt, xlsx, mp4 files are allowed to upload.';
        }
    }
    echo $statusMsg;

    ?>

    </div>
    <div id="viewuploads">
    <h5> View Uploads </h5><br>

    <!-- View Uploads Start -->

    <?php

    include ('dbconnect.php');

    // Get files from the DB

    $sql = "SELECT file_name FROM uploads ORDER BY file_name DESC";
    $result = $db -> query($sql);

    ?>


        <table id="viewuploads2">
            <thead>
            <tr>
                <th> File Name </th>
                <th> View File </th>
            </tr>
            </thead>

            <tbody>
            <?php
            if($result->num_rows > 0){
                while ($row = mysqli_fetch_array($result)) { ?>

                    <tr>
                        <td> <?php echo $row ['file_name']; ?></td>

                        <?php
                        echo '<td><a href=uploads/'.$row['file_name'].'>'?>Click here to view file</a></td>
                        <!--<td><a href="/Applications/MAMP/htdocs/Test<?php /*echo $row['file_name']; */?>" target="_blank">Click here to view file</a></td>-->
                    </tr>


                <?php   }
            } else {
                echo "Please Upload A File!";
            }
            ?>

            </tbody>
        </table>
    </div>
    </div>
    <div id="extra"></div>
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