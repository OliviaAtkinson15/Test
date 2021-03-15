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
    include ("dbconnect.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product backlog</title>
    <link rel="stylesheet" href="pBacklog.css">
    <link rel="stylesheet" href="style.css">

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

            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="my_page.php">My Page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="team_page.php">Team Page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="try.php">Tasks</a>
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
                    <a class="nav-link" href="Chat.php">Sprint Retrospective</a>
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