
<?PHP
include("dbconnect.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprint Planning</title>
    <link rel="stylesheet" href="task_style.css">
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
        session_start();
        $user = $_SESSION['user'];
        echo "<h5> Hello $user</h5>";
        ?>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="userPage.php">My Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="team_page.php">Team Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pBacklog.php">Product Backlog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="try.php">Sprint Planning</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="sprintreview2.php">Sprint Review</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Chat.php">Discussions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Logout</a>
            </li>

        </ul>
    </nav>
</header>


</header>


<?php include("dbconnect.php");
?>

<?php



// delete task
if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($db,$_POST['id_to_delete']);
    $sql="DELETE FROM tasks WHERE id=$id_to_delete";


    mysqli_query($db, $sql);


    //header('location: try.php');
}
if (isset($_POST['assign'])){
    $user = $_POST['to_user'];
    $assignID = mysqli_real_escape_string($db, $_POST['id_to_assign']);
    //echo $user ;
    //echo $assignID;
    //insert assigned to to task table
    $sqlA = mysqli_query($db, "UPDATE tasks SET assigned_to = $user WHERE id=$assignID;");

    if($sqlA){
        header("Refresh:0");
    }
    //retrieve name of the assigned to id
    //$sqlTT = mysqli_query($db,"SELECT * FROM tasks AS T, team_users AS U WHERE T.assigned_to = U.ID AND id = '$assignID'");
}



?>


<body>
<h2>Sprint Planning</h2>
<h3>Tasks</h3>
<div>

    <form method="post" id="task">
        <?php if (isset($errors)) { ?>
            <p><?php echo $errors; ?></p>
        <?php } ?>
        <label for="task">Enter Task:</label><br>
        <input type="text" id="task_input" name="task"><br>
        <label for="start">Start date:</label><br>
        <input type="date" id="start" name="task_start" value="" placeholder="dd-mm-yyyy"min="2021-01-01" max=""><br>
        <label for="end">End date:</label><br>
        <input type="date" id="end" name="task_end" value="" placeholder="dd-mm-yyyy" min="2021-01-01" max=""><br>


        <br>
        <button type="submit" name="submit" id="add_btn" >Add Task</button><br>
        <?php
        if (isset($_POST['submit'])) {
            if(empty($_POST["task"]) || empty($_POST["task_start"])|| empty($_POST["task_end"]))
            {
                echo "fields are required.";
            }else
            {
//assign local variables to the parameters passed in via the POST
                $task=$_POST['task'];
                $task_start=$_POST['task_start'];
                $task_end=$_POST['task_end'];
                if ($task_end<$task_start){
                    echo "End date must be later than start date";
                }
                else{
                    $sql = "INSERT INTO tasks (task, task_start, task_end, is_completed) VALUES ('$task', '$task_start', '$task_end', 'no')";
                    //print $sql;
                    mysqli_query($db, $sql);}}
        }
        ?>
    </form>

</div>


<main>

    <table id="table">
        <thead>
        <tr>
            <th>N</th>
            <th>Tasks</th>
            <th>task start</th>
            <th>task end</th>
            <th>Assigned to</th>
            <th>Action</th>
            <th>Action</th>

        </tr>
        </thead>

        <body>
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
                    <form method="POST">
                        <input type="hidden" name="id_to_delete" value="<?php echo $row['id']?>">
                        <input type="submit" id="delete" name="delete" value="delete" >
                    </form>
                </td>

                <td>
                    <!-- assign task to team members c 23/03/21-- By Onyinye Stella -->
                    <form method="POST">
                        <input type="hidden" name="id_to_assign" value="<?php echo $row['id']?>">
                        <select name="to_user" class="form-control">
                            <option selected disabled >...</option>;
                            <?php
                            $sqlT = mysqli_query($db, "SELECT * From team_users WHERE team_name LIKE '%c%'");
                            $row = mysqli_num_rows($sqlT);
                            while ($row = mysqli_fetch_array($sqlT)){
                                echo "<option value='". $row['ID'] ."'>" .$row['FirstName'] ."</option>" ;
                            }
                            ?>

                        </select>
                        <input type="submit" name="assign" id="assign" value="Assign">
                        <?php $i++;
                        }
                        ?>

                    </form>


                </td>

            </tr>

        </body>
    </table>
    </div>
    </div>
</div>
</main>

</body>
</html>