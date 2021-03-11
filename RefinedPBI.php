<!--/**
 * Name: ILOANUGO ONYINYE
 * StudentId: 2009808
 * CourseCode: CMM 004
 * Course: Software Engineering Project
 * 
 */


/** A Script that fetches the updated product backlog
 * * 
 * And it deletes the product backlog
 * 
 * 
 */-->





<html>

                <!--<form action="" method="GET">
                    <input type="submit" name="view" id="view" value="view PBI's">
                </form> -->
                
                <div class="vertical-menu">

                
                  

    

    

    

    <?PHP
    //view pbi's
        //$view = $_GET["view"];
        //if(isset($_GET['view'])){//if user clicks view show 
            $sql = "SELECT * FROM product_backlog;";

            $result = mysqli_query($db, $sql); //execute SQL query

            //print "<div class='card'>\n";
            //print "<h2 class='backlogItem'></h2>";
            //print "<p class='userStory'></p>";
            //print "<h4 class='criteria'></h4>";
            //print "<h4 class='effort'></h4>";
            
            //fetch the result
            //check
            $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0) {
            while($row = mysqli_fetch_assoc($result)){
                print "<div class='list-item'>";
                print "<div class='card'>";
                //print "<form method='POST' action=''>";
                //print "<p><input type=hidden name=id value=<?php echo $row['product_backlog_id']; ?//>><p>";
                print "<h2 class='bitem'>".$row['product_item']."</h2>";
                print "<p class='userstory'> '<em>".$row['product_task']."</em> '</p>";
                print "<p class='criteria'><b>Acceptance Criteria:</b> ".$row['criteria']."</p>";
                print "<p class='effort'>".$row['effort']."</p>";
                print "<form action='' method='POST'>";
                print "<input type='hidden' name='id_to_delete' value='".$row['product_backlog_id']."'>";
                print "<input type='submit' name ='delete' id ='delete' value ='Delete'>";

                //print "<a href='pBacklog.php?id=".$row['product_backlog_id']."'>DELETE</a>";
                print "</form>";
                print "</div>";
                print "</div><br>";
                        
                //echo $row['product_task']. "<br>";
            }
            //print "</div>";
        }

        //}//$result->close();
    ?>
                </div>    
        
            
         

     
    
    
    <?php
    //delete link
        //include ("dbconnect.php");
        if(isset( $_POST['delete'])){
            //pass the id to the ariable below
            //mysqli_real_escape is used to avoid users tampering with the id on the browser.
            $id_to_delete = mysqli_real_escape_string($db, $_POST['id_to_delete']);
            //sql to delete data
            $sql = $db->query("DELETE FROM product_backlog WHERE product_backlog_id = $id_to_delete"); 
            //make this query and check if done
            if ($sql){
                //successs
                //echo "success";
               header("Refresh: 0");
            }else{
                //error failed
                echo 'query error: '.mysqli_error($db);
            }
        }
    ?>

</html>    