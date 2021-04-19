<!--/**
 * Name: Olivia
 * StudentId: 1305999
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

    <link rel="stylesheet" href="task_style.css">
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

<main>
   <div class="slist">
       <div class="card2">
           <h3>Sprint Backlog Items</h3>
        <?php
     // select all tasks if page is visited or refreshed
            $sprint = mysqli_query($db, "SELECT * FROM sprint_backlog");

            $i = 1; while ($row = mysqli_fetch_array($sprint)) { ?>


                        <ul>
                       <li> <?php echo $row['sprint']; ?></li>
                        </ul>
            <?php $i++; } ?>
                    </div>
                    </div>

       <table id="table">
           <thead>
           <tr>
               <th>N</th>
               <th>Tasks</th>
               <th>task start</th>
               <th>task end</th>
               <th>Assigned to</th>
               <th>Completed</th>

           </tr>
           </thead>

           <?php
           // select all tasks if page is visited or refreshed
           $tasks = mysqli_query($db, "SELECT * FROM tasks");

           $i = 1;while ($row = mysqli_fetch_array($tasks)) { ?>
           <tr>
               <td> <?php echo $i; ?> </td>
               <td > <?php echo $row['task']; ?> </td>
               <td > <?php echo $row['task_start']; ?> </td>
               <td > <?php echo $row['task_end']; ?> </td>
               <td >
                   <?php
                   $assignedto = $row['assigned_to'];


                   $try = $db->query("SELECT FirstName FROM team_users WHERE ID = '$assignedto'");
                   $row2 = mysqli_fetch_array($try);
                   echo $row2['FirstName'];
                   ?></td>

               <td>
                   <?php
                   if ($row['is_completed'] == "yes"){
echo "Yes";
                   }
                   else{
echo "No";
                   }
                   ?>
               </td>

               <td>
                   <!-- assign task to team members c 23/03/21-- By Onyinye Stella -->

                       <?php $i++;
                       }
                       ?>




               </td>

           </tr>

       </table>

</main>


</body>
</html>



