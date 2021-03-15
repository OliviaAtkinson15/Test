

<?PHP
include("dbconnect.php");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprint Planning</title>
    <link rel="stylesheet" href="pBacklog.css">
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
        $email = $_SESSION['email'];
        echo "<h5>$email</h5>";
        ?>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">My Page</a>
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
        $sql = "INSERT INTO tasks (task, task_start, task_end) VALUES ('$task', '$task_start', '$task_end')";
        //print $sql;
        mysqli_query($db, $sql);}
}


// delete task
if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($db,$_POST['id_to_delete']);
    $sql="DELETE FROM tasks WHERE uid=$id_to_delete";


    mysqli_query($db, $sql);


    //header('location: try.php');
}

?>


<body>
<h2>Sprint Planning</h2>
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
        </form>
    </div>

<main>
    <table>
        <thead>
        <tr>
            <th>N</th>
            <th>Tasks</th>
            <th>task start</th>
            <th>task end</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        <?php
        // select all tasks if page is visited or refreshed
        $tasks = mysqli_query($db, "SELECT * FROM tasks");

        $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
            <tr>
                <td> <?php echo $i; ?> </td>
                <td > <?php echo $row['task']; ?> </td>
                <td > <?php echo $row['task_start']; ?> </td>
                <td > <?php echo $row['task_end']; ?> </td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id_to_delete" value="<?php echo $row['uid']?>">
                        <input type="submit" id="delete" name="delete" value="delete" >
                    </form>
                </td>
            </tr>
            <?php $i++; } ?>

        </tbody>
    </table>
</main>

</body>
</html>