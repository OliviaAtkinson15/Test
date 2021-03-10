<!--/**
 * Name: ILOANUGO ONYINYE
 * StudentId: 2009808
 * CourseCode: CMM 004
 * Course: Software Engineering Project
 * 
 */


/**  VIEW THE PRODUCT BACKLOG
 * * A FETCH SCRIPT THAT VIEWS THE PBI'S 
 * ON THE BROWSER.
 * 
 * 
 */-->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view pb</title>
</head>
<body>
    <header>

    </header>

    <main>
        <form action="" method="GET">
            <input type="submit" name="viewpbi" id="viewpbi" value="view PBI">
        </form> 
        
        <div class="vertical-menu">

            <?php
                //view pbi's

        //include ("dbconnect.php");
        if(isset($_GET['viewpbi'])){//if user clicks view show 
            $sql = "SELECT * FROM product_backlog;";

            $result = mysqli_query($db, $sql); //execute SQL query
            
            //fetch the result
            //check
            $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0) {
            while($row = mysqli_fetch_assoc($result)){
                print "<div>";
                print "<ul>";
                print "<li>";
                print "<div class='list-item' draggable='true' ondragstart = 'dragStart()event'>".$row['product_item']."</div>";
                print "</li>";
                print "</ul>";
                print "</div>";
                        
                
            }
            
        }

        }//$result->close();
            ?>
        </div>    
        
    </main>
    <script src="viewPB.js"></script>
</body>
</html>