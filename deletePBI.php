/**
 * Name: ONYINYE ILOANUGO STELLA
 * StudentId: 2009808
 * CourseCode: CMM 004
 * Course: Software Engineering Project
 * 
 */


/** A Product Backlog Item DELETE SCRIPT
 * * 
 * 
 * 
 * 
 */


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
               header('Location: pBacklog.php');
            }else{
                //error failed
                echo 'query error: '.mysqli_error($db);
            }
        }
    ?>